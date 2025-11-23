@extends('lux.layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="payment-status-error">
                        <div class="status-icon mb-4">
                            <i class="mdi mdi-alert-circle" style="font-size: 80px; color: #dc3545;"></i>
                        </div>
                        <h2 class="mb-3 text-danger">Payment Error</h2>
                        <p class="text-muted mb-4">
                            We encountered an issue processing your payment. Please review the details below and try again.
                        </p>
                        
                        @if(isset($message))
                            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                <i class="mdi mdi-alert-circle mr-2"></i>
                                <strong>Error Details:</strong><br>
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="payment-help mt-4">
                            <div class="card bg-light">
                                <div class="card-body text-left">
                                    <h6 class="card-title mb-3">
                                        <i class="mdi mdi-help-circle-outline mr-2"></i>
                                        What can you do?
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="mdi mdi-check-circle text-success mr-2"></i>
                                            Verify your payment details are correct
                                        </li>
                                        <li class="mb-2">
                                            <i class="mdi mdi-check-circle text-success mr-2"></i>
                                            Ensure you have sufficient funds
                                        </li>
                                        <li class="mb-2">
                                            <i class="mdi mdi-check-circle text-success mr-2"></i>
                                            Try using a different payment method
                                        </li>
                                        <li class="mb-0">
                                            <i class="mdi mdi-check-circle text-success mr-2"></i>
                                            Contact support if the problem persists
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('payment.index') }}" class="btn btn-primary btn-lg mr-3">
                            <i class="mdi mdi-refresh mr-2"></i>
                            Try Again
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
.payment-status-error {
    animation: fadeIn 0.5s ease-in;
}

.status-icon {
    animation: shake 0.5s ease-in-out;
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

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-10px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(10px);
    }
}

.payment-help .card {
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
