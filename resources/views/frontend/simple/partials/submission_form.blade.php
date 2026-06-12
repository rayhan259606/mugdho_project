@php
    $form_title = $form_title ?? 'Secure Your Seat Today';
    $form_subtitle = $form_subtitle ?? 'Fill up the form below to enroll or make an inquiry.';
    $type = $type ?? 'course'; // course, product, service
    $submit_label = $submit_label ?? ($type === 'service' ? 'Submit Request' : ($type === 'product' ? 'Confirm Order' : 'Submit Enrollment'));
@endphp

<div class="card border-0 modern-glass-card rounded-32 p-4 p-md-5 shadow-premium">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-slate-900 mb-2">{{ $form_title }}</h2>
        <p class="text-slate-600 small">{{ $form_subtitle }}</p>
    </div>

    @if(session('t-success') || session('success'))
        <div class="alert alert-success p-4 rounded-24 border-0 shadow-premium mb-4" role="alert" style="background-color: #d1fae5; border: 1px solid #a7f3d0 !important;">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; flex-shrink: 0; background-color: #10b981 !important;">
                    <i class="fe fe-check fs-4"></i>
                </div>
                <div class="text-start">
                    <h4 class="fw-bold text-emerald-900 mb-0" style="color: #065f46;">Thank You!</h4>
                    <p class="text-emerald-800 small mb-0" style="color: #047857;">{{ session('t-success') ?? session('success') }}</p>
                </div>
            </div>

            @if(session('payment_success_details'))
                @php $details = session('payment_success_details'); @endphp
                <div class="bg-white bg-opacity-75 p-3 rounded-16 border border-success border-opacity-20 mt-3 text-start">
                    <div class="row g-2 small">
                        <div class="col-6 text-muted">Payment Method:</div>
                        <div class="col-6 fw-bold text-slate-900">{{ $details['method'] }}</div>
                        <div class="col-6 text-muted">Paid To:</div>
                        <div class="col-6 fw-bold text-slate-900">{{ $details['number'] }}</div>
                        @if(!empty($details['trx_id']))
                            <div class="col-6 text-muted">Transaction ID:</div>
                            <div class="col-6 fw-bold text-slate-900">{{ $details['trx_id'] }}</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif

    @if(session('t-error') || session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3 mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
            <strong>Error!</strong> {{ session('t-error') ?? session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-16 p-3 mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b; border-color: #fecaca;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form action="{{ $action }}" method="POST">
        @csrf
        
        <div class="row g-3">
            {{-- Item selection or context --}}
            @if(isset($items) && $items->isNotEmpty())
                {{-- Dropdown for multiple items (e.g. course selection on landing page) --}}
                <div class="col-12 text-start">
                    <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-layers me-1 text-primary"></i> Select Module</label>
                    <select name="course_id" class="form-select custom-input text-slate-800" required>
                        @foreach($items as $itemOption)
                            <option value="{{ $itemOption->id }}" {{ (isset($selected_id) && $selected_id == $itemOption->id) ? 'selected' : '' }}>{{ $itemOption->title }}</option>
                        @endforeach
                    </select>
                </div>
            @elseif(isset($item))
                {{-- Read-only info or hidden inputs for a single item details view --}}
                @if($type === 'course')
                    <input type="hidden" name="course_id" value="{{ $item->id }}">
                    <div class="col-12 text-start">
                        <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-layers me-1 text-primary"></i> Enrolling In</label>
                        <input type="text" class="form-control custom-input" value="{{ $item->title }}" disabled>
                    </div>
                @elseif($type === 'product')
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    @if(isset($module_type))
                        <input type="hidden" name="module_type" value="{{ $module_type }}">
                    @endif
                    <div class="col-12 text-start">
                        <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-shopping-cart me-1 text-primary"></i> Selected Product</label>
                        <input type="text" class="form-control custom-input" value="{{ $item->title }}" disabled>
                    </div>
                @elseif($type === 'service')
                    <input type="hidden" name="service_id" value="{{ $item->id }}">
                    <div class="col-12 text-start">
                        <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-briefcase me-1 text-primary"></i> Requested Service</label>
                        <input type="text" class="form-control custom-input" value="{{ $item->title }}" disabled>
                    </div>
                @endif
            @endif

            {{-- Core form fields --}}
            <div class="col-12 text-start">
                <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-user me-1 text-primary"></i> Your Name</label>
                <input type="text" name="name" class="form-control custom-input" placeholder="Full Name" value="{{ old('name') }}" required>
            </div>
            <div class="col-12 text-start">
                <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-map-pin me-1 text-primary"></i> Address</label>
                <input type="text" name="address" class="form-control custom-input" placeholder="Your Address" value="{{ old('address') }}" required>
            </div>
            <div class="col-md-6 text-start">
                <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-phone me-1 text-primary"></i> Phone</label>
                <input type="text" name="phone" class="form-control custom-input" placeholder="01XXXXXXXXX" value="{{ old('phone') }}" required>
            </div>
            @if($type !== 'service')
                <div class="col-md-6 text-start">
                    <label class="form-label text-slate-700 fw-semibold small"><i class="fe fe-mail me-1 text-primary"></i> Email</label>
                    <input type="email" name="email" class="form-control custom-input" placeholder="email@example.com" value="{{ old('email') }}" required>
                </div>
            @endif

            {{-- Payment Fields (Only for courses and products) --}}
            @if($type !== 'service')
                @php
                    $systemSetting = App\Models\Setting::first();
                    $bkashNumber = $systemSetting->bkash_number ?? null;
                    $nagadNumber = $systemSetting->nagad_number ?? null;
                @endphp
                @if($bkashNumber || $nagadNumber)
                    <div class="col-12 mt-4 text-start">
                        <label class="form-label text-slate-700 fw-semibold small d-block mb-2"><i class="fe fe-credit-card me-1 text-primary"></i> Select Payment Method & Pay</label>
                        <div class="d-flex gap-3 mb-3">
                            @if($bkashNumber)
                                <div class="payment-method-card flex-fill text-center p-3 rounded-20 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-bkash" onclick="selectPayment('bkash', '{{ $bkashNumber }}')">
                                    <img src="{{ asset('default/bkash.svg') }}" alt="bKash" class="payment-logo mb-2 animate__animated animate__fadeIn" style="height: 32px; object-fit: contain;">
                                    <div class="small fw-bold text-slate-800">bKash</div>
                                </div>
                            @endif
                            @if($nagadNumber)
                                <div class="payment-method-card flex-fill text-center p-3 rounded-20 border cursor-pointer d-flex flex-column align-items-center justify-content-center" id="method-nagad" onclick="selectPayment('nagad', '{{ $nagadNumber }}')">
                                    <img src="{{ asset('default/nagad.svg') }}" alt="Nagad" class="payment-logo mb-2 animate__animated animate__fadeIn" style="height: 38px; object-fit: contain; margin-top: -3px;">
                                    <div class="small fw-bold text-slate-800">Nagad</div>
                                </div>
                            @endif
                        </div>

                        <input type="hidden" name="payment_method" id="selected_payment_method" value="">

                        <!-- Payment Instructions -->
                        <div id="payment-instruction-box" class="bg-light p-3 rounded-20 border mb-3 d-none animate__animated animate__fadeIn">
                            <p class="small text-slate-700 mb-2">Please Send Money to this Personal Number:</p>
                            <div class="d-flex align-items-center justify-content-between bg-white p-2 px-3 rounded-16 border">
                                <span id="payment-number" class="fw-bold text-slate-900 fs-5"></span>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fs-12" id="copy-btn" onclick="copyNumber()">Copy</button>
                            </div>
                            <div class="text-success mt-2 small d-none" id="copy-success">
                                <i class="fe fe-check-circle me-1"></i> Number copied to clipboard!
                            </div>
                        </div>

                        <!-- Transaction ID Field -->
                        <div id="transaction-id-group" class="form-group d-none animate__animated animate__fadeIn">
                            <label for="transaction_id" class="form-label text-slate-700 fw-semibold small">Transaction ID (TrxID)</label>
                            <input type="text" name="transaction_id" id="transaction_id" class="form-control custom-input" placeholder="e.g. 8N70XDPQ9S" value="{{ old('transaction_id') }}">
                        </div>
                    </div>
                @endif
            @endif

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-gradient-primary w-100 rounded-pill py-3 fw-bold text-white shadow-premium hover-scale">
                    {{ $submit_label }} <i class="fe fe-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>

@push('script')
<script>
    if (typeof selectPayment !== 'function') {
        function selectPayment(method, number) {
            // Reset active state
            document.querySelectorAll('.payment-method-card').forEach(function(card) {
                card.classList.remove('active');
            });

            // Set active state for selected
            const cardEl = document.getElementById('method-' + method);
            if (cardEl) {
                cardEl.classList.add('active');
            }

            // Set hidden input value
            const pmInput = document.getElementById('selected_payment_method');
            if (pmInput) {
                pmInput.value = method;
            }

            // Show payment instruction box
            const pNum = document.getElementById('payment-number');
            if (pNum) {
                pNum.innerText = number;
            }
            const pBox = document.getElementById('payment-instruction-box');
            if (pBox) {
                pBox.classList.remove('d-none');
            }

            // Show transaction input group and make input required
            const trxGroup = document.getElementById('transaction-id-group');
            if (trxGroup) {
                trxGroup.classList.remove('d-none');
            }
            const trxInput = document.getElementById('transaction_id');
            if (trxInput) {
                trxInput.setAttribute('required', 'required');
            }
            
            // Reset copy success label
            const copySuccess = document.getElementById('copy-success');
            if (copySuccess) {
                copySuccess.classList.add('d-none');
            }
        }
    }

    if (typeof copyNumber !== 'function') {
        function copyNumber() {
            var numEl = document.getElementById('payment-number');
            if (!numEl) return;
            var num = numEl.innerText;
            navigator.clipboard.writeText(num).then(function() {
                var copySuccess = document.getElementById('copy-success');
                if (copySuccess) {
                    copySuccess.classList.remove('d-none');
                    setTimeout(function() {
                        copySuccess.classList.add('d-none');
                    }, 3000);
                }
            });
        }
    }
</script>
@endpush

@push('style')
<style>
    /* Premium Glassmorphism Form Card Style Integration */
    .modern-glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.7) !important;
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08) !important;
    }
    
    .custom-input {
        background-color: rgba(248, 250, 252, 0.8) !important;
        border: 1px solid #d1d5db !important;
        padding: 0.8rem 1.1rem !important;
        border-radius: 16px !important;
        font-size: 0.95rem;
        transition: all 0.25s ease;
    }
    .custom-input:focus {
        background-color: #ffffff !important;
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
        color: var(--slate-900);
    }

    .payment-method-card {
        transition: all 0.25s ease;
        background-color: rgba(248, 250, 252, 0.8);
        border: 2px solid #e2e8f0 !important;
        cursor: pointer;
    }
    .payment-method-card:hover {
        border-color: #cbd5e1 !important;
        transform: translateY(-2px);
    }
    .payment-method-card.active {
        border-color: #4f46e5 !important;
        background-color: rgba(99, 102, 241, 0.05) !important;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.12) !important;
    }

    .shadow-premium {
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04) !important;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        color: white;
    }

    .hover-scale {
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
    }
    .hover-scale:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.25) !important;
    }

    @media (max-width: 575.98px) {
        .rounded-32 { border-radius: 24px !important; }
        .modern-glass-card { padding: 1.5rem !important; }
        .payment-method-card {
            padding: 1rem !important;
            border-radius: 16px !important;
        }
        .payment-logo {
            height: 28px !important;
        }
    }
</style>
@endpush
