<!-- Essential SEO Tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Website Layanan E-Gov</title>
<meta name="description" content="Website Resmi {{ $generalSetting->site_name }}">

<!-- Open Graph Tags (for social media like Facebook, LinkedIn) -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:title" content="{{ $generalSetting->site_name }}">
<meta property="og:description" content="Website Resmi {{ $generalSetting->site_name }}">
<meta property="og:image" content="{{ $logo }}">
<meta property="og:site_name" content="{{ $generalSetting->site_name }}">

<!-- Twitter Card Tags (for Twitter/X sharing) -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url('/') }}">
<meta property="twitter:title" content="{{ $generalSetting->site_name }}">
<meta property="twitter:description" content="{{ $generalSetting->site_name }}">
<meta property="twitter:image" content="{{ $logo }}">

<!-- Optional: Mobile Browser Theme -->
<meta name="theme-color" content="#000000">

<!-- CSRF Token (for Laravel, not SEO-related) -->
<meta name="csrf-token" content="{{ csrf_token() }}">