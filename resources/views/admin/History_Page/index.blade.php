@extends('admin.layouts.app')

@section('title', 'Course Assignment History')

@section('content')

    <div class="main-content-container overflow-hidden">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
            <h3 class="mb-0">Course Assignment History</h3>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                            <i class="ri-home-8-line text-primary me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <span class="text-secondary">Assignments</span>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- FILTERS --}}
        <form method="GET" class="row g-3 mb-4 bg-white p-4 rounded-16 border border-light shadow-sm align-items-end">
            <div class="col-md-3">
                <label class="premium-form-label mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control premium-input"
                    placeholder="Search user or course...">
            </div>

            <div class="col-md-2">
                <label class="premium-form-label mb-2">Payment Status</label>
                <select name="payment_status" class="form-select premium-input">
                    <option value="">All Payment Status</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="free" {{ request('payment_status') == 'free' ? 'selected' : '' }}>Free</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="premium-form-label mb-2">Payment Method</label>
                <select name="payment_method" class="form-select premium-input">
                    <option value="">All Methods</option>
                    <option value="gpay" {{ request('payment_method') == 'gpay' ? 'selected' : '' }}>GPay</option>
                    <option value="razorpay" {{ request('payment_method') == 'razorpay' ? 'selected' : '' }}>Razorpay</option>
                    <option value="phonepe" {{ request('payment_method') == 'phonepe' ? 'selected' : '' }}>PhonePe</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="manual" {{ request('payment_method') == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="premium-form-label mb-2">Status</label>
                <select name="subscription_status" class="form-select premium-input">
                    <option value="">All Status</option>
                    <option value="active" {{ request('subscription_status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ request('subscription_status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ request('subscription_status') == 'cancelled' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-50 justify-content-center" style="height: 48px !important;">
                    <i class="ri-filter-2-line"></i> Filter
                </button>
                <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary w-50 justify-content-center" style="height: 48px !important; display: inline-flex !important; align-items: center; justify-content: center;">
                    <i class="ri-refresh-line"></i> Reset
                </a>
            </div>
        </form>

        {{-- Main Card --}}
        <div class="card bg-white rounded-10 border-0 mb-4">

            {{-- Top Bar --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20 border-bottom">
                <h4 class="mb-0">Assignments List</h4>

                <a href="{{ route('admin.course-assign.create') }}" class="btn btn-primary">
                    + Assign Course
                </a>
            </div>

            {{-- Table --}}
            <div class="table-responsive p-20">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Course</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Payment Method</th>
                            <th>Paid By</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Days Left</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($assignments as $a)
                            @php
                                $startDate = !empty($a->start_date)
                                    ? \Carbon\Carbon::parse($a->start_date)->startOfDay()
                                    : null;

                                $expiryDate = !empty($a->expiry_date)
                                    ? \Carbon\Carbon::parse($a->expiry_date)->startOfDay()
                                    : null;

                                $daysLeft = null;

                                if ($expiryDate) {
                                    $daysLeft = now()->startOfDay()->diffInDays($expiryDate, false);
                                }
                            @endphp

                            <tr class="{{ $daysLeft !== null && $daysLeft < 0 ? 'table-danger' : '' }}">
                                <td>#{{ $a->id }}</td>

                                {{-- USER --}}
                                <td>
                                    <strong>{{ $a->user_name ?? (optional($a->user)->name ?? 'N/A') }}</strong>
                                </td>

                                {{-- COURSE --}}
                                <td>
                                    {{ $a->course_title ?? (optional($a->course)->title ?? 'N/A') }}
                                </td>

                                {{-- PRICE --}}
                                <td>
                                    ₹{{ number_format($a->total_amount ?? $a->price ?? 0, 2) }}
                                </td>

                                {{-- PAYMENT STATUS --}}
                                <td>
                                    @if ($a->payment_status === 'paid')
                                        <span class="badge bg-success-subtle text-success">Paid</span>
                                    @elseif($a->payment_status === 'pending')
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    @elseif($a->payment_status === 'failed')
                                        <span class="badge bg-danger-subtle text-danger">Failed</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">Free</span>
                                    @endif
                                </td>

                                {{-- PAYMENT METHOD --}}
                                @php
    $payment = $a->payments->last();
    $method = strtolower(trim($payment->payment_method ?? ''));
    $paidBy = strtolower(trim($payment->paid_by ?? ''));
@endphp

<td>
    @if ($method === 'gpay')
        <span class="badge bg-primary-subtle text-primary">GPay</span>

    @elseif ($method === 'razorpay')
        <span class="badge bg-dark-subtle text-dark">Razorpay</span>

    @elseif ($method === 'phonepe')
        <span class="badge bg-info-subtle text-info">PhonePe</span>

    @elseif ($method === 'cash')
        <span class="badge bg-success-subtle text-success">Cash</span>

    @elseif ($method === 'bank_transfer')
        <span class="badge bg-warning-subtle text-warning">Bank Transfer</span>

    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>

<td>
    @if ($paidBy === 'admin')
        <span class="badge bg-info-subtle text-info">Admin</span>

    @elseif ($paidBy === 'user')
        <span class="badge bg-success-subtle text-success">User</span>

    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>

                                {{-- PAYMENT DATE --}}
                                <td>
                                    {{ !empty($a->paid_at)
                                        ? \Carbon\Carbon::parse($a->paid_at)->format('d M Y')
                                        : ($a->created_at
                                            ? $a->created_at->format('d M Y')
                                            : 'N/A') }}
                                </td>            

                                    {{-- STATUS TOGGLE --}}
                                    <td>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        @if (strtolower($a->subscription_status ?? '') === 'active')
                                            <span class="badge bg-success-subtle text-success px-2 py-1 fs-12 d-inline-flex align-items-center">
                                                <i class="ri-checkbox-circle-fill me-1"></i> Active
                                            </span>
                                            <form action="{{ route('admin.course-assign.inactive', $a->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger p-0 rounded-circle border-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px; background: transparent;" title="Deactivate">
                                                    <i class="ri-close-circle-fill fs-5"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-12 d-inline-flex align-items-center">
                                                <i class="ri-close-circle-line me-1"></i> Inactive
                                            </span>
                                            <form action="{{ route('admin.course-assign.active', $a->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success p-0 rounded-circle border-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px; background: transparent;" title="Activate">
                                                    <i class="ri-checkbox-circle-line fs-5"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                                {{-- DURATION --}}
                                <td>
                                    @if ($a->duration_value && $a->duration_type)
                                        {{ $a->duration_value }} {{ ucfirst($a->duration_type) }}
                                    @else
                                        <span class="text-primary">Unlimited</span>
                                    @endif
                                </td>

                                {{-- DAYS LEFT --}}
                                <td>
                                    @if ($daysLeft !== null)
                                        @if ($daysLeft > 0)
                                            <span class="text-success fw-bold">{{ (int) $daysLeft }} days</span>
                                        @elseif($daysLeft == 0)
                                            <span class="text-warning fw-bold">1 day</span>
                                        @else
                                            <span class="text-danger fw-bold">Expired</span>
                                        @endif
                                    @else
                                        <span class="text-primary fw-bold">∞</span>
                                    @endif
                                </td>

                                {{-- ACTION --}}
                                <td>
                                    <div class="d-flex justify-content-center gap-3 flex-wrap">

                                        <a href="{{ route('admin.assignments.show', $a->id) }}" class="text-success"
                                            method="POST" title="Add Payment" style="font-size:18px;">
                                            <i class="fas fa-credit-card"></i>
                                        </a>

                                        <a href="{{ route('admin.assignments.show', $a->id) }}" class="text-info"
                                            title="Edit" style="font-size:18px;">
                                            <i class="fas fa-pen"></i>
                                        </a>



                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-5">
                                    <p class="text-muted mb-0">No Assignments Found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center p-20 border-top">
                <span class="fs-14 text-muted">
                    Showing {{ $assignments->firstItem() ?? 0 }}
                    to {{ $assignments->lastItem() ?? 0 }}
                    of {{ $assignments->total() }} entries
                </span>

                {{ $assignments->links() }}
            </div>

        </div>
    </div>

@endsection
