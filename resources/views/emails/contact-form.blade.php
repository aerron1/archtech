{{-- resources/views/emails/contact-form.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archtech Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #016563 0%, #04a28a 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0; font-size: 24px;">Archtech Industries</h1>
        <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0;">Archtech Contact Form</p>
    </div>

    <div style="background-color: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #eaeaea;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <h2 style="color: #016563; margin-top: 0;">Contact Details</h2>

            <div style="margin-bottom: 15px;">
                <strong style="color: #016563; display: inline-block; width: 80px;">Name:</strong>
                <span>{{ $data['name'] }}</span>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #016563; display: inline-block; width: 80px;">Email:</strong>
                <a href="mailto:{{ $data['email'] }}" style="color: #04a28a; text-decoration: none;">
                    {{ $data['email'] }}
                </a>
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="color: #016563; display: inline-block; width: 80px;">Subject:</strong>
                <span>{{ $data['subject'] }}</span>
            </div>

            <div style="margin-top: 25px; padding-top: 20px; border-top: 2px solid #eee;">
                <strong style="color: #016563; display: block; margin-bottom: 10px;">Message:</strong>
                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #04a28a;">
                    {{ nl2br(e($data['message'])) }}
                </div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #eee; text-align: center;">
                <p style="color: #666; font-size: 14px; margin-bottom: 5px;">
                    <strong>Submission Time:</strong> {{ now()->format('F j, Y \a\t g:i A') }}
                </p>
                {{-- <p style="color: #666; font-size: 14px; margin: 0;">
                    <strong>IP Address:</strong> {{ request()->ip() }}
                </p> --}}
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eaeaea;">
            <p style="color: #666; font-size: 12px; margin: 0;">
                This email was sent from the contact form on Archtech Industries website.
                <br>
                Please do not reply directly to this email.
            </p>
        </div>
    </div>
</body>
</html>
