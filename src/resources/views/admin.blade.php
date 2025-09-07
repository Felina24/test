@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-extra')
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit">logout</button>
    </form>
@endsection

@section('content')
    <h2 class="page-title">Admin</h2>

    <div class="content">
        <form class="search-form" method="GET" action="{{ route('admin.index') }}">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

            <select name="gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit" class="btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
        </form>

        <div class="pagination">
            <button class="btn-export">エクスポート</button>
            <ul class="pagination-list">
                {{-- 前のページ --}}
                @if($contacts->onFirstPage())
                    <li class="page-item disabled"><span>&laquo;</span></li>
                @else
                    <li class="page-item"><a href="{{ $contacts->previousPageUrl() }}">&laquo;</a></li>
                @endif

                {{-- ページ番号 --}}
                @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                    @if ($i == $contacts->currentPage())
                        <li class="page-item active"><span>{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a href="{{ $contacts->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                {{-- 次のページ --}}
                @if($contacts->hasMorePages())
                    <li class="page-item"><a href="{{ $contacts->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $contact)
                <tr data-id="{{ $contact->id }}">
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '未分類' }}</td>
                    <td>
                        <button type="button" onclick="openModal({{ $contact->id }})" class="btn-detail">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p><strong>お名前:</strong> <span id="modalName"></span></p>
        <p><strong>性別:</strong> <span id="modalGender"></span></p>
        <p><strong>メールアドレス:</strong> <span id="modalEmail"></span></p>
        <p><strong>電話番号:</strong> <span id="modalTel"></span></p>
        <p><strong>住所:</strong> <span id="modalAddress"></span></p>
        <p><strong>建物名:</strong> <span id="modalBuilding"></span></p>
        <p><strong>お問い合わせ内容:</strong> <span id="modalDetail"></span></p>
        <p><strong>カテゴリ:</strong> <span id="modalCategory"></span></p>

        <button id="btnDelete" class="btn-delete">削除</button>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function openModal(id) {
    fetch(`/admin/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalName').textContent = data.last_name + ' ' + data.first_name;
            document.getElementById('modalGender').textContent = data.gender == 1 ? '男性' : (data.gender == 2 ? '女性' : 'その他');
            document.getElementById('modalEmail').textContent = data.email;
            document.getElementById('modalTel').textContent = data.tel ?? '';
            document.getElementById('modalAddress').textContent = data.adress ?? '';
            document.getElementById('modalBuilding').textContent = data.building ?? '';
            document.getElementById('modalDetail').textContent = data.detail ?? '';
            document.getElementById('modalCategory').textContent = data.category?.content ?? '未分類';

            const deleteBtn = document.getElementById('btnDelete');
            deleteBtn.onclick = function() { deleteContact(id); };

            document.getElementById('detailModal').style.display = 'block';
        });
}

function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
}

function deleteContact(id) {
    if (!confirm('本当に削除しますか？')) return;

    fetch(`/admin/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('削除失敗');
        return response.json();
    })
    .then(data => {
        closeModal();
        const row = document.querySelector(`tr[data-id='${id}']`);
        if (row) row.remove();
        alert(data.message);
    })
    .catch(error => {
        alert(error);
        console.error(error);
    });
}

window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) closeModal();
}
</script>