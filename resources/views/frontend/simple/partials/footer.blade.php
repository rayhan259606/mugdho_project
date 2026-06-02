<footer class="site-footer">
    <div class="container">
        <div class="row g-4 g-lg-5">
            
            <!-- কলাম ১: কোম্পানির নাম ও কন্ট্যাক্ট ইনফো -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="footer-block">
                    <h4 class="footer-brand-name">
                        {{ $systemSetting->name ?? env('APP_NAME') }}
                    </h4>
                    <p class="footer-description">
                        We deliver premium digital assets, authenticated technical tools, and expert solutions designed to scale your operational workflow seamlessly.
                    </p>
                    
                    <div class="footer-contact-info">
                        <div class="contact-line">
                            <i class="fe fe-map-pin contact-icon"></i>
                            <span class="contact-text">{{ $systemSetting->address ?? 'Dhaka, Bangladesh' }}</span>
                        </div>
                        <div class="contact-line">
                            <i class="fe fe-phone contact-icon"></i>
                            <span class="contact-text">{{ $systemSetting->phone ?? '+880 1XXX XXXXXX' }}</span>
                        </div>
                        <div class="contact-line">
                            <i class="fe fe-mail contact-icon"></i>
                            <span class="contact-text text-truncate">{{ $systemSetting->email ?? 'info@example.com' }}</span>
                        </div>
                    </div>

                    <!-- সোশ্যাল মিডিয়া লিংক (ক্লিন ও সিম্পল) -->
                    <div class="footer-social-links">
                        @foreach($socials as $social)
                            @php 
                                $iconName = strtolower($social->name);
                                if($iconName == 'facebook') $iconName = 'facebook-f';
                                if($iconName == 'twitter' || $iconName == 'x') $iconName = 'twitter';
                            @endphp
                            <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" class="social-link-item" title="{{ $social->name }}">
                                <i class="fab fa-{{ $iconName }} fa-fw"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- কলাম ২: কুইক লিংক (পর্যাপ্ত গ্যাপসহ) -->
            <div class="col-12 col-md-6 col-lg-4 ps-lg-5">
                <div class="footer-block">
                    <h6 class="footer-section-title">Quick Links</h6>
                    <ul class="list-unstyled footer-navigation-links">
                        <li><a href="{{ route('home') }}">Home Masterpiece</a></li>
                        <li><a href="{{ route('module.msm') }}">MSM Course</a></li>
                        <li><a href="{{ route('module.gadgets') }}">Gadgets Hub</a></li>
                        <li><a href="{{ url('/page/privacy-policy') }}">Privacy Matrix</a></li>
                        <li><a href="{{ url('/page/terms-conditions') }}">Terms Matrix</a></li>
                        <li><a href="{{ route('post.index') }}">Insights Blog</a></li>
                    </ul>
                </div>
            </div>

            <!-- কলাম ৩: নিউজলেটার ফর্ম -->
            <div class="col-12 col-md-12 col-lg-4">
                <div class="footer-block">
                    <h6 class="footer-section-title text-start">Stay Updated</h6>
                    <p class="footer-description mb-4">
                        Subscribe to our newsletter to receive exclusive offers, new product drops, and corporate updates.
                    </p>
                    
                    <form action="{{ route('subscriber.data.store') }}" method="POST" class="simple-newsletter-form">
                        @csrf
                        <div class="custom-input-group">
                            <input type="email" name="email" class="form-input-clean" placeholder="Your Email Address" required>
                            <button type="submit" class="form-btn-clean">Join</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <hr class="footer-simple-divider">

        <!-- ফুটার বটম (সম্পূর্ণ রেসপন্সিভ) -->
        <div class="row align-items-center footer-bottom-row g-3 justify-content-center text-center">
    
    <div class="col-12">
        <p class="copyright-text mb-0">
            &copy; {{ date('Y') }}
            <span class="text-white fw-bold">
                {{ $systemSetting->name ?? env('APP_NAME') }}
            </span>.
            All rights reserved.
            Developed by
            <a href="" class="visonsoft-link" target="_blank">
                FC Tech Solutions
            </a>
        </p>
    </div>

</div>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* সলিড কালার গাইডলাইন - হাই কন্ট্রাস্ট */
    .site-footer {
        background-color: #0f172a !important; /* সম্পূর্ণ সলিড ম্যাট ডার্ক ব্যাকগ্রাউন্ড */
        color: #94a3b8 !important; /* হাই-কন্ট্রাস্ট রিডেবল টেক্সট কালার */
        font-family: 'Inter', sans-serif;
        padding-top: 80px;
        padding-bottom: 40px;
        border-top: 1px solid #1e293b;
    }

    /* টেক্সট ও টাইটেল স্টাইলিং (স্পষ্ট এবং গ্যাপযুক্ত) */
    .footer-brand-name {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 24px;
        letter-spacing: -0.5px;
        margin-bottom: 16px;
    }

    .footer-description {
        color: #94a3b8 !important;
        font-size: 14px;
        line-height: 1.6; /* লাইনের মাঝের স্পেস বাড়ানো হয়েছে */
        margin-bottom: 24px;
    }

    .footer-section-title {
        color: #ffffff !important;
        font-weight: 600;
        font-size: 15px;
        text-uppercase: none;
        letter-spacing: 0.5px;
        margin-bottom: 24px;
    }

    /* কন্ট্যাক্ট লিস্ট (আইকন এবং লেখা আলাদা ও স্পষ্ট) */
    .footer-contact-info {
        margin-bottom: 24px;
    }

    .contact-line {
        display: flex;
        align-items: center;
        margin-bottom: 14px; /* প্রতি লাইনের মাঝে পর্যাপ্ত গ্যাপ */
    }

    .contact-icon {
        color: #38bdf8 !important; /* স্পষ্ট স্কাই ব্লু কালার, যা ডার্ক ব্যাকগ্রাউন্ডে ফুটে ওঠে */
        font-size: 16px;
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    .contact-text {
        color: #cbd5e1 !important; /* লাইট গ্রে কালার সহজে পড়ার জন্য */
        font-size: 14px;
        font-weight: 500;
    }

    /* সোজা ও সিম্পল কুইক লিংক লিস্ট */
    .footer-navigation-links li {
        margin-bottom: 14px; /* প্রতিটা লিংকের মাঝে বড় স্পেসিফিকেশন গ্যাপ */
    }

    .footer-navigation-links a {
        color: #94a3b8 !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.2s ease, padding-left 0.2s ease;
    }

    .footer-navigation-links a:hover {
        color: #ffffff !important; /* হোভার করলে পুরোপুরি সাদা হয়ে যাবে */
        padding-left: 4px;
    }

    /* সোজা সোশ্যাল আইকন */
    .footer-social-links {
        display: flex;
        gap: 12px;
    }

    .social-link-item {
        width: 38px;
        height: 38px;
        background-color: #1e293b;
        color: #cbd5e1 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .social-link-item:hover {
        background-color: #3b82f6;
        color: #ffffff !important;
    }

    /* সিম্পল ও মিনিমাল নিউজলেটার ফর্ম */
    .custom-input-group {
        display: flex;
        width: 100%;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #334155;
    }

    .form-input-clean {
        flex: 1;
        background-color: #1e293b !important;
        border: none !important;
        padding: 12px 16px;
        font-size: 14px;
        color: #ffffff !important;
    }

    .form-input-clean::placeholder {
        color: #64748b;
    }

    .form-input-clean:focus {
        outline: none;
        background-color: #1e293b !important;
    }

    .form-btn-clean {
        background-color: #2563eb;
        color: #ffffff;
        border: none;
        padding: 0 20px;
        font-weight: 600;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    .form-btn-clean:hover {
        background-color: #1d4ed8;
    }

    /* ডিভাইডার ও ফুটার বটম */
    .footer-simple-divider {
        border-color: #1e293b !important;
        margin: 40px 0 24px 0;
        opacity: 1;
    }

    .copyright-text {
        font-size: 13px;
        color: #64748b !important;
        line-height: 1.5;
    }

    .visonsoft-link {
        color: #3b82f6 !important;
        font-weight: 600;
    }
    .visonsoft-link:hover {
        text-decoration: underline !important;
    }

    .payment-cards-img {
        max-width: 100%;
        height: auto;
    }

    /* সম্পূর্ণ রেসপন্সিভ ব্রেকপয়েন্ট (মোবাইল ও ট্যাবলেটের জন্য) */
    @media (max-width: 991px) {
        .site-footer {
            padding-top: 50px;
            padding-bottom: 30px;
        }
        .ps-lg-5 {
            padding-left: 12px !important;
        }
        .footer-block {
            margin-bottom: 10px;
        }
    }

    @media (max-width: 767px) {
        .footer-brand-name, .footer-section-title {
            text-align: center;
            margin-bottom: 16px;
        }
        .footer-description {
            text-align: center;
        }
        .contact-line {
            justify-content: center;
        }
        .footer-social-links {
            justify-content: center;
            margin-bottom: 20px;
        }
        .footer-navigation-links {
            text-align: center;
        }
        .custom-input-group {
            max-width: 100%;
        }
    }
</style>