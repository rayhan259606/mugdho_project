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
            'address'        => 'nullable|string|max:255',
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
        $moduleType = $request->input('module_type');
        $productTable = 'products';
        if ($moduleType === 'antique') {
            $productTable = 'antique_products';
        } elseif ($moduleType === 'digital') {
            $productTable = 'digital_products';
        } elseif ($moduleType === 'gadget') {
            $productTable = 'gadgets';
        }

        $validator = Validator::make($request->all(), [
            'product_id'     => "required|exists:{$productTable},id",
            'name'           => 'required|string|max:255',
            'address'        => 'nullable|string|max:255',
            'phone'          => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'email'          => 'required|email|max:255',
            'payment_method' => 'nullable|string|in:bkash,nagad',
            'transaction_id' => 'required_with:payment_method|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $product = null;
            $orderData = [
                'uid'             => 'ORD-' . strtoupper(Str::random(10)),
                'user_id'         => auth()->id() ?? 1, 
                'name'            => $request->name,
                'address'         => $request->address,
                'phone'           => $request->phone,
                'email'           => $request->email,
                'payment_method'  => $request->payment_method ?? null,
                'transaction_id'  => $request->transaction_id ?? null,
                'shipping_charge' => 0,
                'status'          => 'pending',
            ];

            if ($moduleType === 'antique') {
                $product = \App\Models\AntiqueProduct::findOrFail($request->product_id);
                $orderData['antique_product_id'] = $product->id;
            } elseif ($moduleType === 'digital') {
                $product = \App\Models\DigitalProduct::findOrFail($request->product_id);
                $orderData['digital_product_id'] = $product->id;
            } elseif ($moduleType === 'gadget') {
                $product = \App\Models\Gadget::findOrFail($request->product_id);
                $orderData['gadget_id'] = $product->id;
            } else {
                $product = Product::findOrFail($request->product_id);
                $orderData['product_id'] = $product->id;
            }

            $orderData['price'] = $product->price - ($product->discount ?? 0);

            $paidTo = null;
            if (!empty($request->payment_method)) {
                $setting = Setting::first();
                if ($request->payment_method == 'bkash') {
                    $paidTo = $setting->bkash_number ?? null;
                } elseif ($request->payment_method == 'nagad') {
                    $paidTo = $setting->nagad_number ?? null;
                }
            }
            $orderData['paid_to'] = $paidTo;

            $order = Order::create($orderData);

            $mailData = [
                'product_title' => $product->title,
                'price'         => $order->price,
                'name'          => $request->name,
                'phone'         => $request->phone,
                'address'       => $request->address,
            ];

            $adminEmail = Setting::first()->email ?? env('MAIL_FROM_ADDRESS');
            try {
                Mail::to($adminEmail)->send(new OrderMail($mailData));
            } catch (Exception $mailError) {
                // Keep processing even if mail fails
            }

            $paymentDetails = null;
            if (!empty($order->payment_method) && !empty($order->paid_to)) {
                $paymentDetails = [
                    'method' => $order->payment_method == 'bkash' ? 'bKash' : 'Nagad',
                    'number' => $order->paid_to,
                    'trx_id' => $order->transaction_id
                ];
            }

            return redirect()->back()
                ->with('t-success', 'Thank you! Your order/inquiry has been submitted successfully.')
                ->with('payment_success_details', $paymentDetails);
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function serviceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
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
