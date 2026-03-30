@php
$setting = App\Models\Setting::where('id',1)->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshMart - Your Online Grocery Store</title>
    <meta name="description" content="FreshMart is your one-stop online grocery store offering fresh fruits, vegetables, seafood, meats, grains, and more. Enjoy fast delivery and excellent customer service.">

    <link rel="icon" type="image/png" href="{{ asset('uploads/'.$setting->favicon) }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @include('front.layouts.styles')
</head>
<body>
    
    @include('front.layouts.top_bar')

    @include('front.layouts.nav')

    @yield('page_main_content')

    @include('front.layouts.newsletter')

    @include('front.layouts.footer')

    @include('front.layouts.scripts')
    
    @yield('scripts')
    
</body>
</html>