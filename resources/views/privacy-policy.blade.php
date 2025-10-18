<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سياسة الخصوصية - تطبيق أسعار العملات في اليمن</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-gray: #f8f9fa;
            --medium-gray: #6c757d;
            --dark-gray: #343a40;
            --border-color: #dee2e6;
            --shadow: 0 2px 8px rgba(0,0,0,0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            margin: 0;
            padding: 15px;
            color: var(--dark-gray);
            background-color: #f5f6fa;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--light-gray);
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin: 0 0 10px 0;
            font-weight: 700;
        }

        .header .subtitle {
            color: var(--medium-gray);
            font-size: 14px;
            margin: 5px 0;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border: 2px solid var(--secondary-color);
            border-radius: var(--border-radius);
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .back-link:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateX(5px);
        }

        .back-link::before {
            content: "▶";
            font-size: 12px;
        }

        .content {
            color: var(--dark-gray);
            font-size: 16px;
        }

        .content h1 {
            color: var(--primary-color);
            font-size: 32px;
            margin: 30px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--secondary-color);
        }

        .content h2 {
            color: var(--primary-color);
            font-size: 24px;
            margin: 25px 0 15px 0;
            padding-right: 15px;
            border-right: 4px solid var(--secondary-color);
        }

        .content h3 {
            color: var(--dark-gray);
            font-size: 18px;
            margin: 20px 0 10px 0;
            font-weight: 600;
        }

        .content p {
            margin: 10px 0;
            line-height: 1.9;
        }

        .content strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        .content ul,
        .content ol {
            margin: 15px 0;
            padding-right: 25px;
        }

        .content li {
            margin: 8px 0;
            line-height: 1.8;
        }

        .content hr {
            border: none;
            border-top: 2px solid var(--light-gray);
            margin: 30px 0;
        }

        .content a {
            color: var(--secondary-color);
            text-decoration: none;
            border-bottom: 1px solid var(--secondary-color);
            transition: var(--transition);
        }

        .content a:hover {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .content blockquote {
            background: var(--light-gray);
            border-right: 4px solid var(--warning-color);
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .content code {
            background: var(--light-gray);
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: var(--danger-color);
        }

        .content pre {
            background: var(--dark-gray);
            color: white;
            padding: 15px;
            border-radius: var(--border-radius);
            overflow-x: auto;
            margin: 15px 0;
        }

        .content pre code {
            background: transparent;
            color: white;
            padding: 0;
        }

        /* Warning box style for disclaimer */
        .content p:has(strong:first-child):first-of-type {
            background: #fff3cd;
            border: 2px solid var(--warning-color);
            border-radius: var(--border-radius);
            padding: 15px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid var(--light-gray);
            text-align: center;
            color: var(--medium-gray);
            font-size: 14px;
        }

        .footer a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 0;
            }

            .container {
                border-radius: 0;
                padding: 20px;
                min-height: 100vh;
            }

            .content h1 {
                font-size: 26px;
            }

            .content h2 {
                font-size: 20px;
            }

            .content h3 {
                font-size: 16px;
            }

            .content {
                font-size: 15px;
            }
        }

        @media (min-width: 900px) {
            .container {
                padding: 40px 50px;
            }

            .content {
                font-size: 17px;
            }
        }

        /* Accessibility */
        .back-link:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                max-width: 100%;
            }

            .back-link {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">العودة إلى الصفحة الرئيسية</a>

        <header class="header">
            <h1>سياسة الخصوصية</h1>
            <p class="subtitle">تطبيق أسعار العملات في اليمن</p>
        </header>

        <div class="content">
            {!! $content !!}
        </div>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} تطبيق أسعار العملات في اليمن. جميع الحقوق محفوظة.</p>
            <p>
                <a href="/">الصفحة الرئيسية</a> |
                <a href="/privacy-policy">سياسة الخصوصية</a>
            </p>
        </footer>
    </div>
</body>
</html>
