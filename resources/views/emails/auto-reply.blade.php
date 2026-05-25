<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Sumit Kumar</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            padding: 40px;
        }

        .header {
            border-bottom: 2px solid #000000;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .content {
            font-size: 16px;
        }

        .message-summary {
            background: #f3f4f6;
            padding: 20px;
            border-left: 4px solid #000000;
            margin: 20px 0;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #666666;
            text-align: center;
        }

        .btn {
            display: inline-block;
            background: #000000;
            color: #ffffff !important;
            padding: 12px 25px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.1em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sumit Kumar</h1>
        </div>
        <div class="content">
            <p>Hi {{ $messageData['name'] }},</p>
            <p>Thank you for reaching out! I've received your message regarding
                "<strong>{{ $messageData['subject'] ?? 'Inquiry' }}</strong>".</p>
            <p>I appreciate you taking the time to write. I'll review your message and get back to you as soon as
                possible, usually within 24-48 hours.</p>

            <div class="message-summary">
                <p style="margin-top: 0; font-weight: 600;">Your Message:</p>
                <p style="font-style: italic; margin-bottom: 0;">"{{ $messageData['message'] }}"</p>
            </div>

            <p>In the meantime, feel free to explore my latest work or connect with me on social media.</p>

            <a href="{{ config('app.url') }}" class="btn">View Portfolio</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sumit Kumar. All rights reserved.</p>
            <p>Lucknow, India | <a href="mailto:contact@sumitkdev.in" style="color: #666;">contact@sumitkdev.in</a></p>
        </div>
    </div>
</body>

</html>