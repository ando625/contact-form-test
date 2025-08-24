<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logout.css') }}">
    @yield('css')
</head>
<body>
    
    <header class="header">
        <div class="container">
            <a href="/login" class="site-title">FashionablyLate</a>
            <form action="/logout" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="register-btn">logout</button>
            </form>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
</body>
</html>

