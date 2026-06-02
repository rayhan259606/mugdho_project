<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:50',
            'phone'     => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:100',
            'subject'   => 'nullable|string|max:100',
            'message'   => 'required|string|max:1000'
        ]);

        $email = $request->input('email') ?? ($request->input('phone') ? $request->input('phone') . '@sourcing.com' : 'sourcing@stackmaster.com');
        $subject = $request->input('subject') ?? ($request->input('phone') ? 'Sourcing Inquiry (Phone: ' . $request->input('phone') . ')' : 'Sourcing Inquiry');

        try {
            Contact::create([
                'name' => $request->name,
                'email' => $email,
                'subject' => $subject,
                'message' => $request->message,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong. Please try again.')->withInput();
        }

        return redirect()->back()->with('t-success', 'Your inquiry has been submitted successfully!');
    }
}
