<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>Tattoo Express</title>
    
    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link href="{{ asset('public/front_end') }}/css/bootstrap.css" rel="stylesheet">
    <link href="{{ asset('public/front_end') }}/css/fontawesome-all.css" rel="stylesheet">
	<link href="{{ asset('public/front_end') }}/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/toastr/toastr.min.css') }}" />
    <style>
    #toast-container {
        margin-top: 60px !important;
    }
    </style>
	@stack('page_css')
	<!-- Favicon  -->
    <link rel="icon" href="{{ asset('public/front_end') }}/images/favicon.png">
</head>