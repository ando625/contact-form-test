@extends('layouts.logout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="header-divider"></div>

<div class="admin-container">
    <h1 class="admin-title">Admin</h1>
    
    <!-- 検索フォーム -->
    <form method="GET" action="" class="search-form">
        <div class="search-row">
            <input type="text" name="name" placeholder="名前やメールアドレスを入力してください" 
                   value="{{ request('name') }}" class="search-input name-input">
            
            <select name="gender" class="search-select">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
            
            <select name="inquiry_type" class="search-select">
                <option value="">お問い合わせの種類</option>
                <option value="商品のお届けについて" {{ request('inquiry_type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ request('inquiry_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ request('inquiry_type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ request('inquiry_type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ request('inquiry_type') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
            
            <div class="date-input-container">
                <input type="date" name="date" value="{{ request('date') }}" class="search-date">
            </div>
            
            <div class="button-group">
                <button type="submit" class="search-btn">検索</button>
                <button type="button" class="reset-btn" onclick="resetForm()">リセット</button>
            </div>
        </div>
    </form>
    
    <!-- エクスポートボタンとページネーション -->
    <div class="export-pagination-container">
        <div class="export-section">
            <form method="POST" action="/admin/export">
                @csrf
                <input type="hidden" name="name" value="{{ request('name') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="inquiry_type" value="{{ request('inquiry_type') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <button type="submit" class="export-btn">エクスポート</button>
            </form>
        </div>
        
        <div class="pagination-section">
            <div class="pagination-wrapper">
                @if($contacts->currentPage() > 1)
                    <a href="{{ $contacts->previousPageUrl() }}" class="pagination-arrow">&lt;</a>
                @else
                    <span class="pagination-arrow disabled">&lt;</span>
                @endif
                
                <div class="pagination-numbers">
                    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                        @if($i == $contacts->currentPage())
                            <span class="pagination-number active">{{ $i }}</span>
                        @else
                            <a href="{{ $contacts->url($i) }}" class="pagination-number">{{ $i }}</a>
                        @endif
                    @endfor
                </div>
                
                @if($contacts->hasMorePages())
                    <a href="{{ $contacts->nextPageUrl() }}" class="pagination-arrow">&gt;</a>
                @else
                    <span class="pagination-arrow disabled">&gt;</span>
                @endif
            </div>
        </div>
    </div>
    
    <!-- テーブル -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr class="table-header">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr class="table-row">
                    <td class="name-cell">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td class="gender-cell">
                        @if($contact->gender == 1)
                            男性
                        @elseif($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td class="email-cell">{{ $contact->email }}</td>
                    <td class="inquiry-cell">{{ $contact->category->content ?? 'N/A' }}</td>
                    <td class="action-cell">
                        <button type="button"
                                class="detail-btn"
                                data-contact='@json($contact)'
                                onclick="showDetail(this)">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- 詳細モーダル -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="detailContent"></div>
        <div class="modal-actions">
            <!-- ここをBladeフォームに置き換え -->
            <form id="deleteForm" method="POST" action="" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.querySelector('.search-form').reset();
    window.location.href = "{{ route('admin.index') }}";
}

// モーダル詳細表示
function showDetail(button) {
    const contact = JSON.parse(button.dataset.contact);
    
    const genderText = contact.gender == 1 ? '男性' : (contact.gender == 2 ? '女性' : 'その他');
    const inquiryText = contact.category?.content ?? 'N/A';
    const detailText = contact.detail.replace(/\n/g, '<br>'); // 改行対応
    
    const detailHTML = `
        <div class="detail-info">
            <div class="detail-row"><label>お名前</label><span>${contact.last_name} ${contact.first_name}</span></div>
            <div class="detail-row"><label>性別</label><span>${genderText}</span></div>
            <div class="detail-row"><label>メールアドレス</label><span>${contact.email}</span></div>
            <div class="detail-row"><label>電話番号</label><span>${contact.tel}</span></div>
            <div class="detail-row"><label>住所</label><span>${contact.address}</span></div>
            <div class="detail-row"><label>建物名</label><span>${contact.building}</span></div>
            <div class="detail-row"><label>お問い合わせの種類</label><span>${inquiryText}</span></div>
            <div class="detail-row"><label>お問い合わせ内容</label><span class="detail-content">${detailText}</span></div>
        </div>
    `;
    
    document.getElementById('detailContent').innerHTML = detailHTML;

    // 削除フォームのactionにIDをセット
    document.getElementById('deleteForm').action = `/admin/contact/${contact.id}`;

    document.getElementById('detailModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}
</script>
@endsection