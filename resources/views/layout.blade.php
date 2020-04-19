<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('/vendor/preview/favicon.ico') }}">
<meta name="robots" content="noindex, nofollow">
<title>Preview{{ config('app.name') ? ' - ' . config('app.name') : '' }}</title>
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
<link href="{{ asset('/vendor/preview/app.css') }}" rel="stylesheet" type="text/css">
<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}
</style>
</head>
<body class="text-center">
<form class="form-signin" method="POST" action="{{ config('preview.path') }}" novalidate>
    <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Authentication Required</h1>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="secret_key" class="sr-only">Secret Key</label>
    <input type="password" id="secret_key" class="form-control" placeholder="Secret Key" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Authenticate</button>
</form>
</body>
</html>
