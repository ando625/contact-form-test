@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h1 class="login-title">Login</h1>
    
    <div class="login-card">
        <form method="get" action="/admin" class="login-form">
            @csrf
            
            <!--テスト ログイン password123  test@example.com -->


            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-input @error('email') error @enderror" 
                       value="{{ old('email') }}"
                       placeholder="例: test@example.com">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-input @error('password') error @enderror"
                       placeholder="例: coachtech1106">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="login-button">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection