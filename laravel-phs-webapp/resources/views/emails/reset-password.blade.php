<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1B365D;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1B365D;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Click the button below to reset your password:</p>
            <p style="text-align: center;">
                <a href="{{ $actionUrl }}" class="button">Reset Password</a>
            </p>
            <p>This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Regards,<br>PMA PHS Online Application System</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>© {{ date('Y') }} Philippine Military Academy. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 