@extends('lux.layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body text-center py-5">
                    @if(isset($status) && $status === 'success')
                        <div class="payment-status-success">
                            <div class="status-icon mb-4">
                                <i class="mdi mdi-check-circle" style="font-size: 80px; color: #28a745;"></i>
                            </div>
                            <h2 class="mb-3 text-success">Payment Successful!</h2>
                            <p class="text-muted mb-4">
                                Your payment has been processed successfully. Thank you for your transaction.
                            </p>
                            <div class="payment-details mt-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">
                                            <i class="mdi mdi-information-outline mr-2"></i>
                                            Payment Details
                                        </h6>
                                        <div class="text-left">
                                            <p class="mb-2">
                                                <strong>Status:</strong> 
                                                <span class="badge badge-success">Completed</span>
                                            </p>
                                            <p class="mb-2">
                                                <strong>Transaction ID:</strong> 
                                                <span class="text-muted">{{ request('session_id') ?? 'N/A' }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Date:</strong> 
                                                <span class="text-muted">{{ now()->format('Y-m-d H:i:s') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="payment-status-pending">
                            <div class="status-icon mb-4">
                                <i class="mdi mdi-clock-outline" style="font-size: 80px; color: #ffc107;"></i>
                            </div>
                            <h2 class="mb-3 text-warning">Payment Pending</h2>
                            <p class="text-muted mb-4">
                                Your payment is being processed. Please wait for confirmation.
                            </p>
                        </div>
                    @endif

                    <div class="mt-5">
                        <a href="{{ route('payment.index') }}" class="btn btn-primary btn-lg mr-3">
                            <i class="mdi mdi-plus-circle mr-2"></i>
                            New Payment
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="mdi mdi-home mr-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-status-success,
.payment-status-pending {
    animation: fadeIn 0.5s ease-in;
}

.status-icon {
    animation: scaleIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        transform: scale(0.5);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.payment-details .card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
}

.btn-lg {
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
</style>
@endsection
