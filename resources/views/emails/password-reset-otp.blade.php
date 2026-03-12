<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Ganti Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
        }
        .otp-box {
            background: #f8f9fa;
            border: 2px dashed #3b82f6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #1d4ed8;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Kode OTP Ganti Password</h1>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $userName }}</strong>,</p>
            
            <p>Anda telah meminta untuk mengubah password akun Anda. Gunakan kode OTP berikut untuk melanjutkan proses:</p>
            
            <div class="otp-box">
                <div style="color: #6c757d; font-size: 14px; margin-bottom: 10px;">Kode OTP Anda</div>
                <div class="otp-code">{{ $otp }}</div>
                <div style="color: #6c757d; font-size: 12px; margin-top: 10px;">Berlaku selama 10 menit</div>
            </div>
            
            <div class="info-box">
                <p style="margin: 0; font-size: 14px; color: #004085;">
                    <strong>ℹ️ Informasi:</strong><br>
                    Masukkan kode ini pada halaman ganti password untuk melanjutkan.
                </p>
            </div>
            
            <div class="warning">
                <p>
                    <strong>⚠️ Peringatan Keamanan:</strong><br>
                    • Jangan bagikan kode ini kepada siapapun<br>
                    • Tim kami tidak akan pernah meminta kode OTP Anda<br>
                    • Jika Anda tidak meminta perubahan password, abaikan email ini
                </p>
            </div>
            
            <p style="margin-top: 30px; color: #6c757d; font-size: 14px;">
                Jika Anda mengalami kesulitan, silakan hubungi tim support kami.
            </p>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Sistem Manajemen Aset. All rights reserved.</p>
        </div>
    </div>
</body>
</html>