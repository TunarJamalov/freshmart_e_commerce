<!-- Top Bar -->
@php
$setting = \App\Models\Setting::where('id',1)->first();
@endphp
<div class="top-bar bg-success text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if($setting->top_bar_phone != '')
                <span><i class="bi bi-telephone"></i> {{ $setting->top_bar_phone }}</span>
                @endif
                @if($setting->top_bar_email != '')
                <span class="ms-3"><i class="bi bi-envelope"></i> {{ $setting->top_bar_email }}</span>
                @endif
            </div>
            <div class="col-md-6 text-end">
                @if(Auth::guard('web')->check())
                <span class="ms-3"><i class="bi bi-speedometer2"></i> <a href="{{ route('user_dashboard') }}" class="text-white text-decoration-none">Dashboard</a></span>
                @else
                <span class="ms-3"><i class="bi bi-box-arrow-in-right"></i> <a href="{{ route('user_login') }}" class="text-white text-decoration-none">Login</a></span>
                <span class="ms-3"><i class="bi bi-person"></i> <a href="{{ route('user_registration') }}" class="text-white text-decoration-none">Register</a></span>
                @endif
            </div>
        </div>
    </div>
</div>