@extends('users.layouts.app')

@section('title', 'Secure Checkout | ' . ($settings['site_name'] ?? 'Francoway'))

@section('content')
<div class="checkout-wrapper py-5">
    <div class="container">
        
        <!-- Header -->
        <div class="checkout-header mb-5">
            <h1 class="fw-black text-dark text-uppercase tracking-wider">
                Secure <span class="text-danger">Checkout</span>
            </h1>
            <p class="text-muted small font-medium">Complete your enrollment details below to start learning immediately.</p>
        </div>

        <form id="checkout-form" action="{{ route('users.purchase', $course->id) }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <!-- Left Panel: Billing & Payment -->
                <div class="col-lg-7">
                    
                    <!-- Step 1: Account Info -->
                    <div class="card checkout-card border-0 mb-4 shadow-sm p-4">
                        <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-4">
                            <span class="step-badge">1</span>
                            <h5 class="fw-bold mb-0 text-dark">Account Information</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Full Name</label>
                                <div class="form-display">{{ auth()->user()->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Email Address</label>
                                <div class="form-display">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Payment Method Select -->
                    <div class="card checkout-card border-0 shadow-sm p-4">
                        <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-4">
                            <span class="step-badge">2</span>
                            <h5 class="fw-bold mb-0 text-dark">Select Payment Method</h5>
                        </div>

                        <!-- Payment Tabs -->
                        <div class="row g-3 mb-4">
                            <div class="col-4">
                                <label class="payment-tab-label w-100 cursor-pointer">
                                    <input type="radio" name="payment_method" value="upi" checked class="peer-check d-none" onchange="togglePaymentView('upi')">
                                    <div class="payment-tab-card text-center py-3 rounded-3 border">
                                        <div class="fs-3 mb-1">📱</div>
                                        <div class="small fw-bold text-dark">UPI / QR</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="payment-tab-label w-100 cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" class="peer-check d-none" onchange="togglePaymentView('card')">
                                    <div class="payment-tab-card text-center py-3 rounded-3 border">
                                        <div class="fs-3 mb-1">💳</div>
                                        <div class="small fw-bold text-dark">Card</div>
                                    </div>
                                </label>
                            </div>
                            <div class="col-4">
                                <label class="payment-tab-label w-100 cursor-pointer">
                                    <input type="radio" name="payment_method" value="netbanking" class="peer-check d-none" onchange="togglePaymentView('netbanking')">
                                    <div class="payment-tab-card text-center py-3 rounded-3 border">
                                        <div class="fs-3 mb-1">🏦</div>
                                        <div class="small fw-bold text-dark">Banking</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Details View Area -->
                        <div class="payment-details-area">
                            <!-- UPI QR Details -->
                            <div id="payment-view-upi" class="text-center py-3">
                                <p class="text-muted small fw-semibold mb-3">Scan the QR code below using any UPI App (GPay, PhonePe, Paytm, etc.) to simulate your payment.</p>
                                <div class="qr-container p-3 border rounded-3 bg-white d-inline-block shadow-sm mb-4">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode('upi://pay?pa=francoway@ybl&pn=FrancoWay&am=' . ($course->price ?? 1) . '&tn=Enrollment') }}" alt="UPI QR Code" class="img-fluid select-none" style="max-height: 160px;">
                                </div>
                                <div class="max-w-xs mx-auto text-start" style="max-width: 300px; margin: 0 auto;">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-2">OR Enter UPI ID</label>
                                    <input type="text" name="upi_id" placeholder="username@upi" class="form-control py-2.5 rounded-3">
                                </div>
                            </div>

                            <!-- Card Details -->
                            <div id="payment-view-card" class="d-none">
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Name on Card</label>
                                    <input type="text" name="card_name" placeholder="John Doe" class="form-control py-2.5 rounded-3">
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Card Number</label>
                                    <input type="text" name="card_number" placeholder="4111 2222 3333 4444" class="form-control py-2.5 rounded-3">
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Expiry</label>
                                        <input type="text" placeholder="MM/YY" class="form-control py-2.5 rounded-3">
                                    </div>
                                    <div class="col-6">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block">CVV</label>
                                        <input type="password" placeholder="123" class="form-control py-2.5 rounded-3">
                                    </div>
                                </div>
                            </div>

                            <!-- Net Banking Details -->
                            <div id="payment-view-netbanking" class="d-none">
                                <div class="mb-3">
                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Choose Bank</label>
                                    <select class="form-select py-2.5 rounded-3">
                                        <option value="sbi">State Bank of India</option>
                                        <option value="hdfc">HDFC Bank</option>
                                        <option value="icici">ICICI Bank</option>
                                        <option value="axis">Axis Bank</option>
                                        <option value="pnb">Punjab National Bank</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Panel: Summary -->
                <div class="col-lg-5">
                    <div class="card checkout-card border-0 shadow-sm p-4">
                        <h5 class="fw-bold text-dark border-bottom pb-3 mb-4">Order Summary</h5>
                        
                        @php
                            $titleLower = strtolower($course->title);
                            $bgImage = 'course_bg_a1.png';
                            if (strpos($titleLower, 'a1') !== false) {
                                $bgImage = 'course_bg_a1.png';
                            } elseif (strpos($titleLower, 'a2') !== false) {
                                $bgImage = 'course_bg_a2.png';
                            } elseif (strpos($titleLower, 'b1') !== false) {
                                $bgImage = 'course_bg_b1.png';
                            } elseif (strpos($titleLower, 'b2') !== false) {
                                $bgImage = 'course_bg_b2.png';
                            } elseif (strpos($titleLower, 'c1') !== false) {
                                $bgImage = 'course_bg_c1.png';
                            } elseif (strpos($titleLower, 'delf') !== false || strpos($titleLower, 'dalf') !== false || strpos($titleLower, 'prep') !== false) {
                                $bgImage = 'course_bg_delf.png';
                            }
                            $courseImage = $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/' . $bgImage);
                        @endphp

                        <div class="d-flex gap-3 align-items-center mb-4">
                            <img src="{{ $courseImage }}" class="rounded-3 border object-cover" style="width: 100px; height: 70px;">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 leading-tight">{{ $course->title }}</h6>
                                <span class="badge bg-danger-subtle text-danger text-uppercase px-2 py-1 rounded">12-Month Access</span>
                            </div>
                        </div>

                        <!-- Pricing Table -->
                        <div class="pricing-breakdown border-top pt-3 mb-4">
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Subtotal</span>
                                <span>₹{{ number_format($course->price, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Taxes / SGST</span>
                                <span>₹0.00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline border-top pt-3">
                                <span class="fw-bold text-dark">Total Amount</span>
                                <span class="fs-3 fw-black text-danger font-heading">₹{{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>

                        <!-- Button -->
                        <button type="submit" class="btn btn-primary btn-checkout py-3 w-100 rounded-3 text-uppercase fw-black letter-spacing mb-3">
                            Complete Enrollment
                        </button>

                        <div class="d-flex align-items-center justify-content-center gap-2 text-muted small fw-bold text-uppercase select-none">
                            <i class="fas fa-shield-alt text-success"></i> SSL Secure Sandbox Payment
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
    .checkout-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
    }
    .fw-black {
        font-weight: 900;
    }
    .letter-spacing {
        letter-spacing: 1px;
    }
    .step-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: rgba(227, 27, 35, 0.1);
        color: #E31B23;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }
    .checkout-card {
        border-radius: 16px !important;
        background-color: #ffffff;
    }
    .form-display {
        padding: 12px 16px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-weight: 600;
        color: #334155;
        font-size: 14px;
    }
    .payment-tab-label {
        display: block;
    }
    .payment-tab-card {
        background-color: #ffffff;
        border-color: #e2e8f0 !important;
        transition: all 0.25s ease;
    }
    .payment-tab-card:hover {
        border-color: #E31B23 !important;
    }
    .peer-check:checked + .payment-tab-card {
        border-color: #E31B23 !important;
        background-color: rgba(227, 27, 35, 0.04) !important;
    }
    .form-control, .form-select {
        border-color: #cbd5e1 !important;
        background-color: #f8fafc !important;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #E31B23 !important;
        box-shadow: 0 0 0 3px rgba(227, 27, 35, 0.15) !important;
        background-color: #ffffff !important;
    }
    .btn-checkout {
        background-color: #0b1e43 !important;
        border-color: #0b1e43 !important;
        transition: all 0.3s ease;
    }
    .btn-checkout:hover {
        background-color: #E31B23 !important;
        border-color: #E31B23 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(227, 27, 35, 0.2);
    }
    .font-heading {
        font-family: 'Outfit', 'Inter', sans-serif;
    }
</style>

@push('scripts')
<script>
    function togglePaymentView(method) {
        document.getElementById('payment-view-upi').classList.add('d-none');
        document.getElementById('payment-view-card').classList.add('d-none');
        document.getElementById('payment-view-netbanking').classList.add('d-none');

        document.getElementById('payment-view-' + method).classList.remove('d-none');
    }
</script>
@endpush
@endsection
