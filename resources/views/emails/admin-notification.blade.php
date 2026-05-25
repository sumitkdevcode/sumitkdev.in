<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry from Portfolio</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
            display: block;
            margin-top: 15px;
        }

        .value {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .message-box {
            background: #fafafa;
            border: 1px solid #eee;
            padding: 15px;
            margin-top: 10px;
            white-space: pre-wrap;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">New Contact Message</h2>
        </div>

        <span class="label">Name</span>
        <div class="value">{{ $messageData['name'] }}</div>

        <span class="label">Email</span>
        <div class="value"><a href="mailto:{{ $messageData['email'] }}">{{ $messageData['email'] }}</a></div>

        <span class="label">Subject</span>
        <div class="value">{{ $messageData['subject'] ?? 'N/A' }}</div>

        <span class="label">Message</span>
        <div class="message-box">{{ $messageData['message'] }}</div>

        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ url('/admin/contacts') }}"
                style="background: #000; color: #fff; padding: 10px 20px; text-decoration: none; font-weight: bold; font-size: 13px;">VIEW
                IN ADMIN PANEL</a>
        </div>
    </div>
</body>

</html>