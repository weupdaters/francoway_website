<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset OTP</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f5f8fc; margin: 0; padding: 40px 20px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td style="background-color: #0B1E43; padding: 30px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; font-weight: 800;">
                    Franco<span style="color: #E31B23;">way</span>
                </h1>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 40px 30px; text-align: center;">
                <h2 style="color: #0B1E43; font-size: 22px; margin-top: 0; margin-bottom: 15px;">Password Reset Request</h2>
                <p style="color: #555555; font-size: 14px; line-height: 1.6; margin-bottom: 25px;">
                    Hello <strong>{{ $name }}</strong>,<br>
                    You requested a password reset for your Francoway Academy account. Use the 6-digit OTP code below to verify and reset your password:
                </p>

                <!-- OTP Code Display Box -->
                <div style="background-color: #fdf2f2; border: 2px dashed #E31B23; border-radius: 12px; padding: 20px; display: inline-block; margin-bottom: 25px;">
                    <span style="font-size: 36px; font-weight: 900; letter-spacing: 8px; color: #E31B23; font-family: monospace;">{{ $otp }}</span>
                </div>

                <p style="color: #777777; font-size: 13px; line-height: 1.5; margin-bottom: 0;">
                    This OTP code is valid for <strong>15 minutes</strong>. If you did not request a password reset, please ignore this email.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #fafafa; padding: 20px; text-align: center; border-top: 1px solid #eeeeee;">
                <p style="color: #999999; font-size: 12px; margin: 0;">
                    &copy; {{ date('Y') }} Francoway Academy. All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
