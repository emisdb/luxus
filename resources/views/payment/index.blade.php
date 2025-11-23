@extends('lux.layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-credit-card mr-2"></i>
                        Payment Processing
                    </h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle mr-2"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(request('canceled'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert mr-2"></i>
                            Payment was canceled. Please try again if you wish to proceed.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="payment-form-wrapper">
                                <form action="{{ route('payment.pay') }}" method="POST" id="paymentForm">
                                    @csrf
                                    
                                    <!-- Payment Method Selection -->
                                    <div class="form-group mb-4">
                                        <label class="form-label font-weight-bold">
                                            <i class="mdi mdi-payment mr-2"></i>
                                            Select Payment Method
                                        </label>
                                        <div class="payment-method-selector">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="payment-option-card" data-method="mollie">
                                                        <input type="radio" name="payment_method" id="mollie" value="mollie" checked>
                                                        <label for="mollie" class="payment-option-label">
                                                            <div class="payment-icon">
                                                                <i class="mdi mdi-credit-card-multiple" style="font-size: 48px; color: #c6d9fd;"></i>
                                                            </div>
                                                            <div class="payment-name">Mollie</div>
                                                            <div class="payment-description">Secure payment via Mollie</div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="payment-option-card" data-method="stripe">
                                                        <input type="radio" name="payment_method" id="stripe" value="stripe">
                                                        <label for="stripe" class="payment-option-label">
                                                            <div class="payment-icon">
                                                                <i class="mdi mdi-credit-card" style="font-size: 48px; color: #635bff;"></i>
                                                            </div>
                                                            <div class="payment-name">Stripe</div>
                                                            <div class="payment-description">Secure payment via Stripe</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Amount Input -->
                                    <div class="form-group mb-4">
                                        <label for="amount" class="form-label font-weight-bold">
                                            <i class="mdi mdi-cash-multiple mr-2"></i>
                                            Payment Amount (EUR)
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="mdi mdi-currency-eur"></i>
                                                </span>
                                            </div>
                                            <input 
                                                type="number" 
                                                class="form-control form-control-lg" 
                                                id="amount" 
                                                name="amount" 
                                                min="10" 
                                                max="100" 
                                                step="0.01" 
                                                placeholder="Enter amount (10-100 EUR)"
                                                required
                                                value="{{ old('amount') }}"
                                            >
                                        </div>
                                        <small class="form-text text-muted">
                                            <i class="mdi mdi-information-outline mr-1"></i>
                                            Minimum: €10.00 | Maximum: €100.00
                                        </small>
                                    </div>

                                    <!-- Payment Summary -->
                                    <div class="payment-summary mb-4">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title mb-3">
                                                    <i class="mdi mdi-receipt mr-2"></i>
                                                    Payment Summary
                                                </h6>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Amount:</span>
                                                    <strong id="summaryAmount">€0.00</strong>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Payment Method:</span>
                                                    <strong id="summaryMethod">Mollie</strong>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <span class="font-weight-bold">Total:</span>
                                                    <strong class="text-primary" id="summaryTotal">€0.00</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            <i class="mdi mdi-lock mr-2"></i>
                                            Proceed to Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-form-wrapper {
    padding: 20px 0;
}

.payment-method-selector {
    margin-top: 10px;
}

.payment-option-card {
    position: relative;
    height: 100%;
}

.payment-option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.payment-option-label {
    display: block;
    padding: 25px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    background: #fff;
    height: 100%;
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.payment-option-label:hover {
    border-color: #635bff;
    background: #f8f9ff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 91, 255, 0.15);
}

.payment-option-card input[type="radio"]:checked + .payment-option-label {
    border-color: #635bff;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    box-shadow: 0 4px 20px rgba(99, 91, 255, 0.25);
}

.payment-icon {
    margin-bottom: 15px;
}

.payment-name {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.payment-description {
    font-size: 13px;
    color: #666;
}

.payment-summary {
    margin-top: 30px;
}

.payment-summary .card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
}

.form-control-lg {
    font-size: 1.1rem;
    padding: 12px 16px;
}

.btn-lg {
    padding: 14px 28px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 91, 255, 0.3);
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}

@media (max-width: 768px) {
    .payment-option-label {
        min-height: 150px;
        padding: 20px 15px;
    }
    
    .payment-icon i {
        font-size: 36px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const summaryAmount = document.getElementById('summaryAmount');
    const summaryTotal = document.getElementById('summaryTotal');
    const summaryMethod = document.getElementById('summaryMethod');

    // Update summary on amount change
    amountInput.addEventListener('input', function() {
        const amount = parseFloat(this.value) || 0;
        summaryAmount.textContent = '€' + amount.toFixed(2);
        summaryTotal.textContent = '€' + amount.toFixed(2);
    });

    // Update summary on payment method change
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            const methodName = this.value === 'mollie' ? 'Mollie' : 'Stripe';
            summaryMethod.textContent = methodName;
        });
    });

    // Visual feedback for payment method selection
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            document.querySelectorAll('.payment-option-card').forEach(card => {
                card.classList.remove('active');
            });
            const card = this.closest('.payment-option-card');
            if (card) {
                card.classList.add('active');
            }
        });
    });

    // Set initial summary
    const initialAmount = parseFloat(amountInput.value) || 0;
    summaryAmount.textContent = '€' + initialAmount.toFixed(2);
    summaryTotal.textContent = '€' + initialAmount.toFixed(2);
});
</script>
@endsection
