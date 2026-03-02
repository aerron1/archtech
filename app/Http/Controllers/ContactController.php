<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        try {
            // Save to database
            $submission = ContactSubmission::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'is_read' => false
            ]);

            // Send email
            Mail::to('aerron.archtechphil@gmail.com')
                ->send(new ContactFormMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will contact you soon.',
                'alert_type' => 'success',
                'alert_title' => 'Message Sent!',
                'alert_message' => 'Your message has been sent successfully. We will get back to you soon.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            \Log::error('Contact form data: ', $validated);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.',
                'alert_type' => 'error',
                'alert_title' => 'Sending Failed!',
                'alert_message' => 'Failed to send your message. Please try again later or contact us directly.'
            ], 500);
        }
    }
}
