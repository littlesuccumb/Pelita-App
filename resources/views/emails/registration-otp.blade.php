<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 40px 30px;
        }
        .otp-box {
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Cimahi Techno Park</h1>
            <p style="margin: 10px 0 0;">Kode Verifikasi Registrasi</p>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $name }}</strong>,</p>
            
            <p>Terima kasih telah mendaftar di Cimahi Techno Park. Untuk melanjutkan proses registrasi, gunakan kode OTP berikut:</p>
            
            <div class="otp-box">
                <p style="margin: 0; color: #6c757d; font-size: 14px;">Kode OTP Anda:</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 0; color: #6c757d; font-size: 12px;">Berlaku selama 10 menit</p>
            </div>
            
            <div class="warning">
                <strong>⚠️ Penting:</strong>
                <ul style="margin: 10px 0 0; padding-left: 20px;">
                    <li>Jangan bagikan kode ini kepada siapapun</li>
                    <li>Kode akan kedaluwarsa dalam 10 menit</li>
                    <li>Jika Anda tidak merasa mendaftar, abaikan email ini</li>
                </ul>
            </div>
            
            <p style="color: #6c757d; margin-top: 30px;">
                Salam,<br>
                <strong>Tim Cimahi Techno Park</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Cimahi Techno Park. All rights reserved.</p>
        </div>
    </div>
</body>
</html>