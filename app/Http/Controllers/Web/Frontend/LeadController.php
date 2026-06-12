<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\Order;
use App\Models\Product;
use App\Models\ServiceRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\EnrollmentMail;
use App\Mail\OrderMail;
use App\Mail\ServiceRequestMail;
use App\Models\Course;
use App\Models\Service;
use App\Models\Setting;

class LeadController extends Controller
{
    public function enroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id'      => 'required|exists:courses,id',
            'name'           => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'phone'          => ['required', 'regex:/^01[3-9]\d{8}$/'], // Bangladesh 11 digit validation
            'email'          => 'required|email|max:255',
            'payment_method' => 'nullable|string|in:bkash,nagad',
            'transaction_id' => 'required_with:payment_method|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();
            
            if (!empty($request->payment_method)) {
                $setting = Setting::first();
                if ($request->payment_method == 'bkash') {
                    $validatedData['paid_to'] = $setting->bkash_number ?? null;
                } elseif ($request->payment_method == 'nagad') {
                    $validatedData['paid_to'] = $setting->nagad_number ?? null;
                }
            }

            $enrollment = CourseEnrollment::create($validatedData);
            $course = Course::find($request->course_id);
            
            $mailData = [
                'course_title' => $course->title,
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
            ];

            $adminEmail = Setting::first()->email ?? env('MAIL_FROM_ADDRESS');
            
            // Send to Admin
            try {
                Mail::to($adminEmail)->send(new EnrollmentMail($mailData));
                // Send to User
                Mail::to($request->email)->send(new EnrollmentMail($mailData));
            } catch (Exception $mailError) {
                // Keep processing even if mail fails
            }
            
            $successMsg = 'Thank you! Your enrollment request has been submitted successfully.';
            $paymentDetails = null;
            if (!empty($enrollment->payment_method) && !empty($enrollment->paid_to)) {
                $paymentDetails = [
                    'method' => $enrollment->payment_method == 'bkash' ? 'bKash' : 'Nagad',
                    'number' => $enrollment->paid_to,
                    'trx_id' => $enrollment->transaction_id
                ];
            }

            return redirect()->back()
                ->with('t-success', $successMsg)
                ->with('payment_success_details', $paymentDetails);
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^01[3-9]\d{8}$/'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $product = Product::findOrFail($request->product_id);
            
            $order = Order::create([
                'uid' => 'ORD-' . strtoupper(Str::random(10)),
                'user_id' => auth()->id() ?? 1, 
                'product_id' => $product->id,
                'price' => $product->price - ($product->discount ?? 0),
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'shipping_charge' => 0, // This can be dynamic later
                'status' => 'pending',
            ]);

            $mailData = [
                'product_title' => $product->title,
                'price' => $order->price,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            $adminEmail = Setting::first()->email ?? env('MAIL_FROM_ADDRESS');
            Mail::to($adminEmail)->send(new OrderMail($mailData));

            return redirect()->back()->with('t-success', 'Order placed successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function serviceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^01[3-9]\d{8}$/'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $serviceRequest = ServiceRequest::create($validator->validated());
            $service = Service::find($request->service_id);

            $mailData = [
                'service_title' => $service->title,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            $adminEmail = Setting::first()->email ?? env('MAIL_FROM_ADDRESS');
            Mail::to($adminEmail)->send(new ServiceRequestMail($mailData));

            return redirect()->back()->with('t-success', 'Service request sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }
}
