<!-- Footer -->
@php
$setting = App\Models\Setting::where('id', 1)->first();
@endphp
<footer class="footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3"><i class="bi bi-cart-check-fill"></i> FreshMart</h5>
                <p class="text-white-50">Your one-stop shop for fresh and organic groceries delivered right to your doorstep.</p>
                <div class="social-links">
                    @if($setting->footer_facebook != '')
                    <a href="{{ $setting->footer_facebook }}" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-facebook"></i>
                    </a>
                    @endif
                    @if($setting->footer_twitter != '')
                    <a href="{{ $setting->footer_twitter }}" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-twitter"></i>
                    </a>
                    @endif
                    @if($setting->footer_linkedin != '')
                    <a href="{{ $setting->footer_linkedin }}" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    @endif
                    @if($setting->footer_instagram != '')
                    <a href="{{ $setting->footer_instagram }}" class="btn btn-outline-light btn-sm rounded-circle me-2">
                        <i class="bi bi-instagram"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">Contact Us</a></li>
                    <li class="mb-2"><a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ route('terms') }}" class="text-white-50 text-decoration-none">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="{{ route('faq') }}" class="text-white-50 text-decoration-none">FAQs</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Categories</h5>
                <ul class="list-unstyled">
                    @php
                    $product_categories = \App\Models\ProductCategory::orderBy('name', 'asc')->get();
                    @endphp
                    @foreach($product_categories as $item)
                        <li class="mb-2"><a  class="text-white-50 text-decoration-none" href="{{ url('products/?category='.$item->id.'&min_price=&max_price=&rating=on&sort=') }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3">Contact Info</h5>
                <ul class="list-unstyled text-white-50">
                    @if($setting->footer_address != '')
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        {{ $setting->footer_address }}
                    </li>
                    @endif
                    @if($setting->footer_phone != '')
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        {{ $setting->footer_phone }}
                    </li>
                    @endif
                    @if($setting->footer_email != '')
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        {{ $setting->footer_email }}
                    </li>
                    @endif
                    @if($setting->footer_working_hours != '')
                    <li class="mb-2">
                        <i class="bi bi-clock me-2"></i>
                        {{ $setting->footer_working_hours }}
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-white">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="text-white-50 mb-0">
                    {{ $setting->footer_copyright }}
                </p>
            </div>
        </div>
    </div>
</footer>