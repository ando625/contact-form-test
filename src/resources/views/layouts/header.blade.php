<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @yield('css')
</head>
<body>
    <!--会員登録用ヘッダー -->
    <header class="header">
        <div class="container">
            <a href="/login" class="site-title">FashionablyLate</a>
            <a href="/login" class="register-btn">login</a>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
</body>
</html>