<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أسعار العملات في اليمن</title>
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
            line-height: 1.6;
            margin: 0;
            padding: 15px;
            color: var(--dark-gray);
            background-color: #f5f6fa;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 26px;
            margin: 0 0 10px 0;
            font-weight: 700;
        }

        .header .subtitle {
            color: var(--medium-gray);
            font-size: 14px;
            margin: 0;
        }

        .tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 20px;
            padding: 0;
            border-bottom: 2px solid var(--light-gray);
        }

        .tab {
            flex: 1;
            min-width: 80px;
            padding: 12px 16px;
            cursor: pointer;
            background: var(--light-gray);
            border: 1px solid var(--border-color);
            border-bottom: none;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            font-weight: 500;
            text-align: center;
            transition: var(--transition);
            user-select: none;
            position: relative;
        }

        .tab:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .tab.active {
            background: white;
            border-color: var(--secondary-color);
            border-bottom: 2px solid white;
            margin-bottom: -2px;
            font-weight: 700;
            color: var(--secondary-color);
            z-index: 1;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: white;
        }

        .currency-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 0;
            margin-bottom: 20px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .currency-card.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .rate-item {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: var(--transition);
        }

        .rate-item:hover {
            background: var(--light-gray);
        }

        .rate-item:last-child {
            border-bottom: none;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }

        .rate-item:first-child {
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .currency-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .currency-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .currency-flag {
            width: 24px;
            height: 16px;
            background: var(--medium-gray);
            border-radius: 2px;
            display: inline-block;
        }

        .price-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 10px;
        }

        .price-box {
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .price-box.buy {
            background: rgba(39, 174, 96, 0.1);
            border-color: var(--success-color);
        }

        .price-box.sell {
            background: rgba(231, 76, 60, 0.1);
            border-color: var(--danger-color);
        }

        .price-label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .buy .price-label {
            color: var(--success-color);
        }

        .sell .price-label {
            color: var(--danger-color);
        }

        .price-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark-gray);
        }

        .rate-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--medium-gray);
            margin-top: 10px;
        }

        .date-badge {
            background: var(--secondary-color);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .today-badge {
            background: var(--success-color);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Pagination Styles */
        .pagination-container {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .pagination-nav {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .pagination-link, .pagination-disabled {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            transition: var(--transition);
            min-width: 140px;
            text-align: center;
        }

        .pagination-link {
            background: white;
            color: var(--primary-color);
            cursor: pointer;
        }

        .pagination-link:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .pagination-disabled {
            background: var(--light-gray);
            color: var(--medium-gray);
            cursor: not-allowed;
            border-color: var(--border-color);
        }

        .arrow::before {
            margin-left: 8px;
        }

        .arrow-left::before {
            content: "▶";
            margin-left: 8px;
        }

        .arrow-right::after {
            content: "◀";
            margin-right: 8px;
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 40px;
            color: var(--medium-gray);
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--secondary-color);
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }

            .tabs {
                flex-direction: column;
            }

            .tab {
                border-radius: var(--border-radius);
                border-bottom: 1px solid var(--border-color);
                margin-bottom: 5px;
            }

            .tab.active {
                border-bottom: 1px solid var(--secondary-color);
                margin-bottom: 5px;
            }

            .pagination-nav {
                flex-direction: column;
                gap: 10px;
            }

            .pagination-link, .pagination-disabled {
                width: 100%;
            }
        }

        @media (min-width: 600px) {
            .container {
                max-width: 600px;
                padding: 30px;
            }

            .header h1 {
                font-size: 32px;
            }

            .price-row {
                gap: 20px;
            }

            .price-value {
                font-size: 18px;
            }
        }

        /* Footer Styles */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .footer-link {
            color: var(--medium-gray);
            text-decoration: none;
            font-size: 13px;
            transition: var(--transition);
            padding: 5px 10px;
            border-radius: 4px;
        }

        .footer-link:hover {
            color: var(--secondary-color);
            background: var(--light-gray);
        }

        .footer-text {
            color: var(--medium-gray);
            font-size: 12px;
            margin: 5px 0;
        }

        /* Accessibility */
        .tab:focus,
        .pagination-link:focus,
        .footer-link:focus {
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
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>أسعار العملات في اليمن</h1>
            <p class="subtitle">أحدث أسعار الصرف لليوم</p>
        </header>

        <div class="tabs" role="tablist">
            @foreach ($rates as $index => $rate)
                <button class="tab {{ $loop->first ? 'active' : '' }}" 
                        role="tab"
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                        aria-controls="city-{{ $index }}"
                        onclick="showTab(event, 'city-{{ $index }}', {{ $index }})">
                    {{ $rate['city'] }}
                </button>
            @endforeach
        </div>

        @foreach ($rates as $index => $cityRates)
            <div id="city-{{ $index }}" 
                 class="currency-card {{ $loop->first ? 'active' : '' }}"
                 role="tabpanel"
                 aria-labelledby="tab-{{ $index }}">
                
                @forelse ($cityRates['rates'] as $rate)
                    <div class="rate-item">
                        <div class="currency-header">
                            <span class="currency-name">{{ $rate['currency'] }}</span>
                        </div>
                        
                        <div class="price-row">
                            <div class="price-box buy">
                                <div class="price-label">شراء</div>
                                <div class="price-value">{{ number_format($rate['buy_price']) }}</div>
                            </div>
                            <div class="price-box sell">
                                <div class="price-label">بيع</div>
                                <div class="price-value">{{ number_format($rate['sell_price']) }}</div>
                            </div>
                        </div>
                        
                        <div class="rate-meta">
                            <span>{{ $rate['day'] }}</span>
                            <span class="date-badge {{ isset($rate['is_today']) && $rate['is_today'] ? 'today-badge' : '' }}">
                                {{ $rate['date'] }}
                                @if(isset($rate['is_today']) && $rate['is_today'])
                                    - اليوم
                                @endif
                            </span>
                            <small>{{ $rate['last_update'] }}</small>
                        </div>
                    </div>
                @empty
                    <div class="loading">
                        لا توجد بيانات متاحة
                    </div>
                @endforelse
            </div>
        @endforeach

       {{ $rates->links() }}

        <footer class="footer">
            <div class="footer-links">
                <a href="/privacy-policy" class="footer-link">سياسة الخصوصية</a>
                <span class="footer-text">|</span>
                <a href="/" class="footer-link">الصفحة الرئيسية</a>
            </div>
            <p class="footer-text">&copy; {{ date('Y') }} تطبيق أسعار العملات في اليمن</p>
        </footer>
    </div>

    <script>
        function showTab(event, tabId, index) {
            // Remove active class from all cards and tabs
            document.querySelectorAll('.currency-card').forEach(card => {
                card.classList.remove('active');
            });
            
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });

            // Show selected card and activate tab
            const selectedCard = document.getElementById(tabId);
            const selectedTab = event.currentTarget;
            
            if (selectedCard) {
                selectedCard.classList.add('active');
            }
            
            selectedTab.classList.add('active');
            selectedTab.setAttribute('aria-selected', 'true');

            // Optional: Save active tab to localStorage
            localStorage.setItem('activeTab', index);
        }

        // Restore active tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTab = localStorage.getItem('activeTab');
            if (savedTab) {
                const tabButton = document.querySelector(`.tab:nth-child(${parseInt(savedTab) + 1})`);
                if (tabButton) {
                    tabButton.click();
                }
            }
        });

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                const activeTab = document.querySelector('.tab.active');
                if (!activeTab) return;

                const tabs = Array.from(document.querySelectorAll('.tab'));
                const currentIndex = tabs.indexOf(activeTab);
                let nextIndex;

                if (e.key === 'ArrowRight') {
                    nextIndex = currentIndex > 0 ? currentIndex - 1 : tabs.length - 1;
                } else {
                    nextIndex = currentIndex < tabs.length - 1 ? currentIndex + 1 : 0;
                }

                tabs[nextIndex].click();
                tabs[nextIndex].focus();
            }
        });
    </script>
</body>
</html>