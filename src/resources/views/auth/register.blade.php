@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1 class="register-title">Register</h1>
    
    <div class="register-card">
        <form method="POST" action="/register" class="register-form">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">お名前</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-input @error('name') error @enderror" 
                       value="{{ old('name') }}"
                       placeholder="例: 山田　太郎">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
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
                <button type="submit" class="register-button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection