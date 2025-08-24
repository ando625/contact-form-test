@extends('layouts.app')



@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="contact-title">Contact</h2>

<form action="/confirm" method="POST" class="contact-form" novalidate>
    @csrf
    

    <div class="form-row">
        <div class="form-group">
            <label for="first_name">お名前 <span class="required">※</span></label>
            <div class="input-wrapper">
                <input type="text" id="first_name" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="last_name">&nbsp;</label>
            <div class="input-wrapper">
                <input type="text" id="last_name" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label>性別 <span class="required">※</span></label>
        <div class="input-wrapper">
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="gender" value="男性" {{ old('gender', '男性') == '男性' ? 'checked' : '' }}>
                    <span class="radio-custom"></span> 男性
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}>
                    <span class="radio-custom"></span> 女性
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}>
                    <span class="radio-custom"></span> その他
                </label>
            </div>
            @error('gender')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="email">メールアドレス <span class="required">※</span></label>
        <div class="input-wrapper">
            <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label>電話番号 <span class="required">※</span></label>
        <div class="input-wrapper">
            <div class="phone-group">
                <input type="text" name="phone1" placeholder="080" value="{{ old('phone1') }}" maxlength="4">
                <span class="phone-separator">-</span>
                <input type="text" name="phone2" placeholder="1234" value="{{ old('phone2') }}" maxlength="4">
                <span class="phone-separator">-</span>
                <input type="text" name="phone3" placeholder="5678" value="{{ old('phone3') }}" maxlength="4">
            </div>
            @error('phone1') <div class="error-message">{{ $message }}</div> @enderror
            @error('phone2') <div class="error-message">{{ $message }}</div> @enderror
            @error('phone3') <div class="error-message">{{ $message }}</div> @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="address">住所 <span class="required">※</span></label>
        <div class="input-wrapper">
            <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
            @error('address')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="building">建物名</label>
        <div class="input-wrapper">
            <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            @error('building')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="inquiry_type">お問い合わせの種類 <span class="required">※</span></label>
        <div class="input-wrapper">
            <select id="inquiry_type" name="category_id">
                <option value="">選択してください</option>
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品について</option>
                <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>配送について</option>
                <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>返品について</option>
                <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>その他</option>
            </select>
            @error('inquiry_type')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-group">
        <label for="content">お問い合わせ内容 <span class="required">※</span></label>
        <div class="input-wrapper">
            <textarea id="content" name="content" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
            @error('content')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="form-submit">
        <button type="submit" class="submit-button">確認画面</button>
    </div>
</form>
@endsection