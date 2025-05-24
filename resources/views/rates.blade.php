<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أسعار العملات في اليمن</title>
    <style>
        /* Mobile-first styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 15px;
            color: #333;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .tabs {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-bottom: none;
            border-radius: 5px 5px 0 0;
            margin-left: 5px;
            font-weight: light;
        }

        .tab.active {
            background: #fff;
            border-bottom: 1px solid #fff;
            margin-bottom: -1px;
            font-weight: bold;
            text-decoration: underline;
            text-decoration-style: wavy;
            text-underline-offset: 5px;
        }

        .currency-card {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: none;
        }

        .currency-card.active {
            display: block;
        }

        .currency-info {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }

        .currency-info strong {
            font-weight: bold;
        }

        .date-info {
            text-align: center;
            margin-top: 15px;
            font-style: italic;
            color: #666;
        }

        /* Tablet and larger screens */
        @media (min-width: 600px) {
            h1 {
                font-size: 28px;
            }
            
            .currency-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>أسعار العملات في اليمن</h1>
    
        <div class="tabs">
            @foreach ($supportedCities as $city)
                <div class="tab {{ $loop->first ? 'active' : '' }}" onclick="showTab(event, '{{ $city->id }}')">
                     <span class="">{{ $city->label }} </span>
                </div>
            @endforeach
        </div>
    
        @foreach ($rates as $cityId => $cityRates)

            @php
                $city = $supportedCities->firstWhere('id', $cityId);
            @endphp
            <div id="{{ $cityId }}" class="currency-card {{ $loop->first ? 'active' : '' }}">
                @foreach ($cityRates as $rate)
                    <div style="margin-bottom: {{ $loop->last ? '0' : '10px' }}; border-bottom: {{ $loop->last ? 'none' : '1px dashed #ccc' }}; padding-bottom: 10px;">
                        <div class="currency-info">
                            <strong>العملة:</strong>
                            <span>{{ $rate->currency->name }}</span>
                        </div>
                        <div class="currency-info">
                            <strong>سعر الشراء:</strong>
                            <span>{{ $rate->buy_price }} ريال يمني</span>
                        </div>
                        <div class="currency-info">
                            <strong>سعر البيع:</strong>
                            <span>{{ $rate->sell_price }} ريال يمني</span>
                        </div>
                        <div class="currency-info">
                            <strong>التاريخ:</strong>
                            <span>{{ $rate->date->format('Y-m-d') }}</span>
                        </div>
                        <div class="currency-info">
                            <strong>اليوم:</strong>
                            <span>{{ $rate->date->locale('ar')->isoFormat('dddd') }}</span>
                        </div>

                        <div class="date-info">
                            آخر تحديث: {{ $rate->updated_at?->diffForHumans() }}
                        </div>
                    </div>
                @endforeach
    
          
            </div>
        @endforeach
    </div>
    
    <script>
        function showTab(event, tabId) {
            // Hide all cards
            document.querySelectorAll('.currency-card').forEach(card => {
                card.classList.remove('active');
            });
    
            // Show selected
            document.getElementById(tabId).classList.add('active');
    
            // Update tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>