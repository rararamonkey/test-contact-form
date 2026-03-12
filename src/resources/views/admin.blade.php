@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<h1>Admin</h1>

<form action="/search" method="get">

<input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="名前やメールアドレスを入力してください">

<select name="gender">
<option value="">性別</option>
<option value="1" {{ ($gender ?? '') == 1 ? 'selected' : '' }}>男性</option>
<option value="2" {{ ($gender ?? '') == 2 ? 'selected' : '' }}>女性</option>
<option value="3" {{ ($gender ?? '') == 3 ? 'selected' : '' }}>その他</option>
</select>

<select name="category_id">
<option value="">お問い合わせ種類</option>

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ ($category_id ?? '') == $category->id ? 'selected' : '' }}>
{{ $category->content }}
</option>

@endforeach

</select>


<input type="date" name="date" value="{{ $date ?? '' }}">

<button type="submit">検索</button>
<a href="/admin" class="reset-btn">リセット</a>
</form>


<div class="admin-top">

<a href="{{ route('export', request()->query()) }}" class="export-btn">
エクスポート
</a>

<div class="pagination-area">
{{ $contacts->links('pagination::bootstrap-4') }}
</div>

</div>

<table class="admin-table">

<tr>
<th>お名前</th>
<th>性別</th>
<th>メールアドレス</th>
<th>お問い合わせ種類</th>
<th>お問い合わせ内容</th>
<th>詳細</th>
</tr>

@foreach($contacts as $contact)

<tr>

<td>
{{ $contact->last_name }} {{ $contact->first_name }}
</td>

<td>
@if($contact->gender == 1)
男性
@elseif($contact->gender == 2)
女性
@else
その他
@endif
</td>

<td>{{ $contact->email }}</td>
<td>{{ $contact->category->content }}</td>
<td>{{ Str::limit($contact->detail, 40) }}</td>
<td>
<button type="button" onclick='openModal(@json($contact))'>詳細</button>
</td></tr>

@endforeach

</table>

<div id="modal" class="modal">
<div class="modal-content">
<span class="modal-close" onclick="closeModal()">×</span>


<p>名前 <span id="modal-name"></span></p>
<p>性別 <span id="modal-gender"></span></p>
<p>メール <span id="modal-email"></span></p>
<p>電話番号 <span id="modal-tel"></span></p>
<p>住所 <span id="modal-address"></span></p>
<p>建物名 <span id="modal-building"></span></p>
<p>お問い合わせ種類 <span id="modal-category"></span></p>
<p>お問い合わせ内容 <span id="modal-detail"></span></p>

<form id="delete-form" method="POST">
@csrf
@method('DELETE')
<button type="submit">削除</button>
</form>
</div>
</div>
<script>

function closeModal(){
document.getElementById("modal").classList.remove("active");
}

function openModal(contact){

document.getElementById("modal").classList.add("active");

document.getElementById("modal-name").innerText =
contact.last_name + " " + contact.first_name;

document.getElementById("modal-email").innerText =
contact.email;

document.getElementById("modal-detail").innerText =
contact.detail;

document.getElementById("modal-tel").innerText =
contact.tel;

document.getElementById("modal-address").innerText =
contact.address;

document.getElementById("modal-building").innerText =
contact.building;

document.getElementById("modal-category").innerText =
contact.category.content;

let gender = "";

if(contact.gender == 1){
gender = "男性";
}else if(contact.gender == 2){
gender = "女性";
}else{
gender = "その他";
}

document.getElementById("modal-gender").innerText = gender;

document.getElementById("delete-form").action =
"/delete/" + contact.id;

}

</script>
@endsection