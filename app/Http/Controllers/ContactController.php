<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\SenderMail;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        try {
            // Validate the form data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|min:10',
                'g-recaptcha-response' => 'required|string',
            ]);

            // Verify reCAPTCHA with Google
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $validated['g-recaptcha-response'],
                'remoteip' => $request->ip(),
            ]);

            $recaptchaData = $response->json();

            // Check if verification was successful
            if (!$recaptchaData['success']) {
                $errorCodes = implode(', ', $recaptchaData['error-codes'] ?? ['unknown']);
                
                // Special handling for localhost
                if (app()->environment('local')) {
                    Log::warning('reCAPTCHA localhost warning: ' . $errorCodes);
                    // For local testing, you might want to bypass or still show error
                }

                return response()->json([
                    'success' => false,
                    'message' => 'reCAPTCHA verification failed. Please try again.',
                    'debug' => app()->environment('local') ? $errorCodes : null
                ], 422);
            }

            // For v3, check the score (optional)
            if (($recaptchaData['score'] ?? 0) < 0.5) {
                return response()->json([
                    'success' => false,
                    'message' => 'Suspicious activity detected. Please try again.',
                ], 422);
            }

            // Check the action matches
            if (($recaptchaData['action'] ?? '') !== 'submit') {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid form submission.',
                ], 422);
            }

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

            // Send emails
            Mail::to('aerrontapican1@gmail.com')->send(new ContactFormMail($validated));
            Mail::to($request->email)->send(new SenderMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will contact you soon.'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ], 500);
        }
    }
}