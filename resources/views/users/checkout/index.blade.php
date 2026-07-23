@php
    $taxEnabled = ($settings['checkout_tax_enabled'] ?? 0) == 1;
    $taxPercent = floatval($settings['checkout_tax_percent'] ?? 0);
    $taxLabel = $settings['checkout_tax_label'] ?? 'Taxes / SGST';
    $taxAmount = $taxEnabled ? (($course->price * $taxPercent) / 100) : 0;
    $totalAmount = $course->price + $taxAmount;

    $payUpiEnabled = ($settings['checkout_pay_upi_enabled'] ?? 1) == 1;
    $payCardEnabled = ($settings['checkout_pay_card_enabled'] ?? 1) == 1;
    $payNetbankingEnabled = ($settings['checkout_pay_netbanking_enabled'] ?? 1) == 1;

    // Check which payment method should be checked by default
    $defaultMethod = 'upi';
    if (!$payUpiEnabled) {
        if ($payCardEnabled) {
            $defaultMethod = 'card';
        } elseif ($payNetbankingEnabled) {
            $defaultMethod = 'netbanking';
        } else {
            $defaultMethod = 'none';
        }
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | {{ $settings['site_name'] ?? 'FrancoWay' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #071530;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Standalone Navbar Header */
        .checkout-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #eff3f9;
            padding: 16px 0;
            box-shadow: 0 2px 10px rgba(7, 21, 48, 0.02);
        }

        .checkout-logo {
            font-weight: 900;
            font-size: 22px;
            color: #071530;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkout-logo span {
            color: #E53935;
        }

        .btn-back-dashboard {
            font-weight: 700;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back-dashboard:hover {
            color: #071530;
        }

        /* Step badge */
        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(229, 57, 53, 0.1);
            color: #E53935;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Cards */
        .checkout-card {
            border-radius: 20px !important;
            background-color: #ffffff;
            border: 1px solid #eff3f9 !important;
            box-shadow: 0 10px 30px rgba(7, 21, 48, 0.02) !important;
        }

        .form-display {
            padding: 12px 18px;
            background-color: #fafafa;
            border: 1.5px solid #eff3f9;
            border-radius: 12px;
            font-weight: 600;
            color: #071530;
            font-size: 14.5px;
        }

        /* Payment selection */
        .payment-tab-card {
            background-color: #ffffff;
            border: 1.5px solid #eff3f9 !important;
            border-radius: 14px !important;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }

        .payment-tab-card:hover {
            border-color: rgba(7, 21, 48, 0.2) !important;
            transform: translateY(-1px);
        }

        .peer-check:checked + .payment-tab-card {
            border-color: #071530 !important;
            background-color: rgba(7, 21, 48, 0.02) !important;
            box-shadow: 0 0 0 3px rgba(7, 21, 48, 0.04) !important;
        }

        /* Inputs */
        .form-control, .form-select {
            height: 48px !important;
            border-radius: 12px !important;
            border: 1.5px solid #eff3f9 !important;
            background-color: #fafafa !important;
            font-size: 15px !important;
            color: #071530 !important;
            padding: 0 18px !important;
            transition: all 0.2s ease !important;
        }

        .form-control:hover, .form-select:hover {
            border-color: rgba(7, 21, 48, 0.25) !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: #071530 !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(7, 21, 48, 0.04) !important;
            outline: none !important;
        }

        /* Checkout button */
        .btn-checkout {
            height: 52px !important;
            background-color: #071530 !important;
            border: none !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 15px !important;
            border-radius: 14px !important;
            letter-spacing: 0.5px !important;
            box-shadow: 0 4px 14px rgba(7, 21, 48, 0.12) !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
        }

        .btn-checkout:hover {
            background-color: #E53935 !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px rgba(229, 57, 53, 0.22) !important;
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="checkout-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="checkout-logo">
                <i class="ri-navigation-line text-danger"></i> Franco<span>Way</span>
            </a>
            <a href="/dashboard" class="btn-back-dashboard">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow-1 py-5">
        <div class="container">
            
            <!-- Page Title -->
            <div class="checkout-header mb-5">
                <h1 class="fw-black text-dark text-uppercase tracking-wider m-0" style="font-weight: 900; font-size: 32px;">
                    Secure <span class="text-danger">Checkout</span>
                </h1>
                <p class="text-muted small font-medium mt-1">Complete your enrollment details below to start learning immediately.</p>
            </div>

            <!-- Checkout Form -->
            <form id="checkout-form" action="{{ route('users.purchase', $course->id) }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    
                    <!-- Left Column: Billing & Payment -->
                    <div class="col-lg-7">
                        
                        <!-- Step 1: Account Information -->
                        <div class="card checkout-card border-0 mb-4 shadow-sm p-4">
                            <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-4">
                                <span class="step-badge">1</span>
                                <h5 class="fw-bold mb-0 text-dark" style="font-size: 16px;">Account Information</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="letter-spacing: 0.5px; font-size: 11px;">Full Name</label>
                                    <div class="form-display">{{ auth()->user()->name }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="letter-spacing: 0.5px; font-size: 11px;">Email Address</label>
                                    <div class="form-display">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Select Payment Method -->
                        <div class="card checkout-card border-0 shadow-sm p-4">
                            <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-4">
                                <span class="step-badge">2</span>
                                <h5 class="fw-bold mb-0 text-dark" style="font-size: 16px;">Select Payment Method</h5>
                            </div>

                            @if(!$payUpiEnabled && !$payCardEnabled && !$payNetbankingEnabled)
                                <div class="alert alert-warning border-0 p-3 rounded-12">
                                    No payment methods are currently available. Please contact administrator.
                                </div>
                            @else
                                <!-- Payment Tabs -->
                                <div class="row g-3 mb-4">
                                    @if($payUpiEnabled)
                                    <div class="col-4">
                                        <label class="payment-tab-label w-100 cursor-pointer mb-0">
                                            <input type="radio" name="payment_method" value="upi" {{ $defaultMethod === 'upi' ? 'checked' : '' }} class="peer-check d-none" onchange="togglePaymentView('upi')">
                                            <div class="payment-tab-card text-center py-3 rounded-3 border">
                                                <div class="fs-3 mb-1">📱</div>
                                                <div class="small fw-bold text-dark">UPI / QR</div>
                                            </div>
                                        </label>
                                    </div>
                                    @endif

                                    @if($payCardEnabled)
                                    <div class="col-4">
                                        <label class="payment-tab-label w-100 cursor-pointer mb-0">
                                            <input type="radio" name="payment_method" value="card" {{ $defaultMethod === 'card' ? 'checked' : '' }} class="peer-check d-none" onchange="togglePaymentView('card')">
                                            <div class="payment-tab-card text-center py-3 rounded-3 border">
                                                <div class="fs-3 mb-1">💳</div>
                                                <div class="small fw-bold text-dark">Card</div>
                                            </div>
                                        </label>
                                    </div>
                                    @endif

                                    @if($payNetbankingEnabled)
                                    <div class="col-4">
                                        <label class="payment-tab-label w-100 cursor-pointer mb-0">
                                            <input type="radio" name="payment_method" value="netbanking" {{ $defaultMethod === 'netbanking' ? 'checked' : '' }} class="peer-check d-none" onchange="togglePaymentView('netbanking')">
                                            <div class="payment-tab-card text-center py-3 rounded-3 border">
                                                <div class="fs-3 mb-1">🏦</div>
                                                <div class="small fw-bold text-dark">Banking</div>
                                            </div>
                                        </label>
                                    </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Payment Details View Area -->
                            <div class="payment-details-area">
                                
                                <!-- UPI QR Details -->
                                @if($payUpiEnabled)
                                <div id="payment-view-upi" class="{{ $defaultMethod === 'upi' ? '' : 'd-none' }} text-center py-2">
                                    <p class="text-muted small fw-semibold mb-3">Scan the QR code below using any UPI App (GPay, PhonePe, Paytm, etc.) to simulate your payment.</p>
                                    
                                    @if(($settings['checkout_upi_qr_enabled'] ?? 1) == 1)
                                    <div class="qr-container p-3 border rounded-3 bg-white d-inline-block shadow-sm mb-4">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode('upi://pay?pa=' . ($settings['checkout_upi_id'] ?? 'francoway@ybl') . '&pn=' . ($settings['site_name'] ?? 'FrancoWay') . '&am=' . $totalAmount . '&tn=Enrollment') }}" alt="UPI QR Code" class="img-fluid select-none" style="max-height: 160px;">
                                    </div>
                                    @endif

                                    <div class="max-w-xs mx-auto text-start" style="max-width: 320px; margin: 0 auto;">
                                        <label class="text-muted small fw-bold text-uppercase d-block mb-2" style="font-size: 11px; letter-spacing: 0.5px;">OR Enter UPI ID</label>
                                        <input type="text" name="upi_id" placeholder="username@upi" class="form-control rounded-3" value="{{ old('upi_id', auth()->user()->email) }}">
                                    </div>
                                </div>
                                @endif

                                <!-- Card Details -->
                                @if($payCardEnabled)
                                <div id="payment-view-card" class="{{ $defaultMethod === 'card' ? '' : 'd-none' }}">
                                    <div class="mb-3">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">Name on Card</label>
                                        <input type="text" name="card_name" placeholder="John Doe" class="form-control rounded-3" value="{{ old('card_name', auth()->user()->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">Card Number</label>
                                        <input type="text" name="card_number" placeholder="4111 2222 3333 4444" class="form-control rounded-3" value="{{ old('card_number') }}">
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">Expiry</label>
                                            <input type="text" placeholder="MM/YY" class="form-control rounded-3">
                                        </div>
                                        <div class="col-6">
                                            <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">CVV</label>
                                            <input type="password" placeholder="123" class="form-control rounded-3">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Net Banking Details -->
                                @if($payNetbankingEnabled)
                                <div id="payment-view-netbanking" class="{{ $defaultMethod === 'netbanking' ? '' : 'd-none' }}">
                                    <div class="mb-3">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.5px;">Choose Bank</label>
                                        <select class="form-select rounded-3">
                                            <option value="sbi">State Bank of India</option>
                                            <option value="hdfc">HDFC Bank</option>
                                            <option value="icici">ICICI Bank</option>
                                            <option value="axis">Axis Bank</option>
                                            <option value="pnb">Punjab National Bank</option>
                                        </select>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="col-lg-5">
                        <div class="card checkout-card border-0 shadow-sm p-4">
                            <h5 class="fw-bold text-dark border-bottom pb-3 mb-4" style="font-size: 16px;">Order Summary</h5>
                            
                            @php
                                $noImageBanner = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23f8fafc;stop-opacity:1"/><stop offset="100%" style="stop-color:%23e2e8f0;stop-opacity:1"/></linearGradient></defs><rect width="100%" height="100%" fill="url(%23bg)"/><g transform="translate(400, 220)" text-anchor="middle"><path d="M-24,-40 L24,-40 C32,-40 38,-34 38,-26 L38,26 C38,34 32,40 24,40 L-24,40 C-32,40 -38,34 -38,26 L-38,-26 C-38,-34 -32,-40 -24,-40 Z" fill="none" stroke="%2364748b" stroke-width="4" stroke-linejoin="round"/><circle cx="0" cy="0" r="14" fill="none" stroke="%2364748b" stroke-width="4"/><circle cx="20" cy="-22" r="4" fill="%2364748b"/><text x="0" y="85" fill="%23071530" font-family="Outfit, sans-serif" font-size="24" font-weight="800" letter-spacing="1">NO IMAGE AVAILABLE</text><text x="0" y="115" fill="%2364748b" font-family="Outfit, sans-serif" font-size="16" font-weight="500">FrancoWay Learning Portal</text></g></svg>';
                                $courseImage = $course->thumbnail ? asset('storage/' . $course->thumbnail) : $noImageBanner;
                            @endphp

                            <div class="d-flex gap-3 align-items-center mb-4">
                                <img src="{{ $courseImage }}" class="rounded-3 border" style="width: 100px; height: 70px; object-fit: cover;" onerror="this.src='{{ $noImageBanner }}'">
                                <div>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 15px; line-height: 1.3;">{{ $course->title }}</h6>
                                    <span class="badge bg-danger-subtle text-danger text-uppercase px-2 py-1 rounded" style="font-size: 10px; font-weight: 700;">12-Month Access</span>
                                </div>
                            </div>

                            <!-- Pricing Breakdown -->
                            <div class="pricing-breakdown border-top pt-3 mb-4">
                                <div class="d-flex justify-content-between mb-2 text-muted small fw-semibold">
                                    <span>Subtotal</span>
                                    <span>₹{{ number_format($course->price, 2) }}</span>
                                </div>
                                
                                @if($taxEnabled)
                                <div class="d-flex justify-content-between mb-3 text-muted small fw-semibold">
                                    <span>{{ $taxLabel }} ({{ $taxPercent }}%)</span>
                                    <span>₹{{ number_format($taxAmount, 2) }}</span>
                                </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-baseline border-top pt-3">
                                    <span class="fw-bold text-dark" style="font-size: 15px;">Total Amount</span>
                                    <span class="fs-3 fw-bold text-danger">₹{{ number_format($totalAmount, 2) }}</span>
                                </div>
                            </div>

                            <!-- Button -->
                            @if($payUpiEnabled || $payCardEnabled || $payNetbankingEnabled)
                            <button type="submit" class="btn btn-checkout py-3 w-100 mb-3 text-uppercase">
                                <i class="fas fa-lock"></i> Complete Enrollment
                            </button>
                            @endif

                            <div class="d-flex align-items-center justify-content-center gap-2 text-muted small fw-bold text-uppercase select-none" style="font-size: 10.5px; letter-spacing: 0.5px;">
                                <i class="fas fa-shield-alt text-success"></i> SSL Secure Sandbox Payment
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container text-center">
            <p class="text-muted small mb-0">&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'FrancoWay' }} learning portal. Secure sandbox gateway.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePaymentView(method) {
            const upiView = document.getElementById('payment-view-upi');
            const cardView = document.getElementById('payment-view-card');
            const bankingView = document.getElementById('payment-view-netbanking');

            if(upiView) upiView.classList.add('d-none');
            if(cardView) cardView.classList.add('d-none');
            if(bankingView) bankingView.classList.add('d-none');

            const activeView = document.getElementById('payment-view-' + method);
            if(activeView) activeView.classList.remove('d-none');
        }
    </script>
</body>
</html>
