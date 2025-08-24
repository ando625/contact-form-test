@extends('layouts.app')



@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection



@section('content')
<div class="confirm-container">
    <h2 class="confirm-title">Confirm</h2>

    <div class="confirm-content">
        <table class="confirm-table">
            <tr>
                <td class="confirm-label">お名前</td>
                <td class="confirm-value">{{ $contact['full_name'] ?? $contact['last_name'] . '　' . $contact['first_name'] }}</td>
            </tr>
            <tr>
                <td class="confirm-label">性別</td>
                <td class="confirm-value">{{ $contact['gender_text'] }}</td>
            </tr>
            <tr>
                <td class="confirm-label">メールアドレス</td>
                <td class="confirm-value">{{ $contact['email'] }}</td>
            </tr>
            <tr>
                <td class="confirm-label">電話番号</td>
                <td class="confirm-value">{{ $contact['tel'] }}</td>
            </tr>
            <tr>
                <td class="confirm-label">住所</td>
                <td class="confirm-value">{{ $contact['address'] }}</td>
            </tr>
            @if(!empty($contact['building']))
            <tr>
                <td class="confirm-label">建物名</td>
                <td class="confirm-value">{{ $contact['building'] }}</td>
            </tr>
            @endif
            <tr>
                <td class="confirm-label">お問い合わせの種類</td>
                <td class="confirm-value">{{ $contact['category_name'] }}</td>
            </tr>
            <tr>
                <td class="confirm-label">お問い合わせ内容</td>
                <td class="confirm-value content-text">{{ $contact['content'] }}</td>
            </tr>
        </table>

        <div class="confirm-buttons">
            <form method="post" action="/contacts" style="display: inline-block;">
                @csrf
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                <input type="hidden" name="phone1" value="{{ $contact['phone1'] }}">
                <input type="hidden" name="phone2" value="{{ $contact['phone2'] }}">
                <input type="hidden" name="phone3" value="{{ $contact['phone3'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] }}">
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                <input type="hidden" name="content" value="{{ $contact['content'] }}">
                <button type="submit" class="submit-btn">送信</button>
            </form>

            <form method="post" action="{{ route('contact.back') }}" style="display: inline-block;">
                @csrf
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                <input type="hidden" name="phone1" value="{{ $contact['phone1'] }}">
                <input type="hidden" name="phone2" value="{{ $contact['phone2'] }}">
                <input type="hidden" name="phone3" value="{{ $contact['phone3'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] }}">
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                <input type="hidden" name="content" value="{{ $contact['content'] }}">

                <button class="back-btn" type="submit">修正</button>
            </form>
        </div>
    </div>
</div>
@endsection