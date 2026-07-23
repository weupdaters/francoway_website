@extends('admin.layouts.app')

@section('title', 'Assignment Details')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">
        <h3 class="mb-0">Assignment Details</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.assignments.index') }}" class="text-decoration-none">
                        Assignments
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    View Details
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">
            <div class="card bg-white p-4 rounded shadow-sm mb-4">

                <h4 class="mb-4">User & Course Info</h4>

                <p><strong>User:</strong> {{ optional($assignment->user)->name ?? 'User Deleted' }}</p>
                <p><strong>Course:</strong> {{ optional($assignment->course)->title ?? 'Course Deleted' }}</p>

                <hr>

                <p><strong>Total Amount:</strong> ₹{{ $assignment->total_amount }}</p>
                <p class="text-success"><strong>Paid Amount:</strong> ₹{{ $assignment->paid_amount }}</p>
                <p class="text-danger"><strong>Remaining:</strong> ₹{{ $assignment->remaining_amount }}</p>

                <hr>

                {{-- Payment History --}}
                <h5 class="mb-3">Payment History</h5>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Paid By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignment->payments as $p)
                                <tr>
                                    <td class="text-success">₹{{ $p->amount }}</td>
                                    <td>{{ ucfirst($p->payment_method ?? 'N/A') }}</td>
                                    <td>{{ ucfirst($p->paid_by ?? 'N/A') }}</td>
                                    <td>{{ $p->paid_at ? \Carbon\Carbon::parse($p->paid_at)->format('d M Y') : $p->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Payments Yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">
            <div class="card bg-white p-4 rounded shadow-sm mb-4">

                <h4 class="mb-4">Payment Action</h4>

                {{-- STATUS --}}
                <div class="mb-3">
                    <strong>Status:</strong><br>

                    @if ($assignment->payment_status == 'paid')
                        <span class="badge bg-success">Paid</span>
                    @elseif($assignment->payment_status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @else
                        <span class="badge bg-danger">Unpaid</span>
                    @endif
                </div>

                {{-- ADD PAYMENT FORM --}}
                <form method="POST" action="{{ route('admin.assignments.add-payment', $assignment->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="">Select</option>
                            <option value="gpay">GPay</option>
                            <option value="razorpay">Razorpay</option>
                            <option value="phonepe">PhonePe</option>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100">Add Payment</button>
                </form>

                {{-- BACK --}}
                <div class="mt-3">
                    <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary w-100">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection