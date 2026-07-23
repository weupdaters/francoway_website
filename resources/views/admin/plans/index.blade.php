@extends('admin.layouts.app')

@section('title','Subscription Plans')

@section('content')

<div class="main-content-container overflow-hidden">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 mt-1">

        <h3 class="mb-0">Subscription Plans</h3>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none">

                        <i class="ri-home-8-line fs-15 text-primary me-1"></i>
                        <span class="text-body fs-14">Dashboard</span>

                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Plans
                </li>

            </ol>
        </nav>

    </div>


    <div class="card bg-white rounded-10 border border-white mb-4">

        {{-- TOP BAR --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">

            <h4>All Plans</h4>

            <a href="{{ route('admin.plans.create') }}"
               class="btn btn-primary">

               + Add Plan

            </a>

        </div>


        {{-- TABLE --}}
        <div class="default-table-area mx-minus-1 style-two">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Plan Name</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($plans as $plan)

                        <tr>

                            <td>#{{ $plan->id }}</td>

                            <td>{{ $plan->plan_name }}</td>

                            <td>
                                {{ $plan->duration_value }}
                                {{ ucfirst($plan->duration_type) }}
                            </td>

                            <td>₹ {{ $plan->price }}</td>

                            <td>

                                @if($plan->status == 1)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('admin.plans.edit',$plan->id) }}"
                                       class="bg-transparent border-0">
                                        <img src="https://img.icons8.com/color/48/edit.png" style="width: 18px; height: 18px; object-fit: contain;" alt="edit">
                                    </a>


                                    <form action="{{ route('admin.plans.destroy',$plan->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-transparent border-0"
                                                onclick="return confirm('Delete this plan?')">
                                            <img src="https://img.icons8.com/color/48/trash.png" style="width: 18px; height: 18px; object-fit: contain;" alt="delete">
                                        </button>

                                    </form>


                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No Plans Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center p-20">

                <span class="fs-15">

                    Showing {{ $plans->firstItem() }}
                    to {{ $plans->lastItem() }}
                    of {{ $plans->total() }}

                </span>

                {{ $plans->links() }}

            </div>

        </div>

    </div>

</div>

@endsection