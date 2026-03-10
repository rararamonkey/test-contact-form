@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<h1>Admin</h1>

<form action="/admin" method="get">

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

<a href="/admin">
<button type="button">リセット</button>
</a>

</form>

<table border="1">

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
<td>{{ $contact->detail }}</td>
<td>
<button type="button" onclick='openModal(@json($contact))'>詳細</button>
</td></tr>

@endforeach

</table>
{{ $contacts->links() }}

<div id="modal" class="modal">
    <h2>お問い合わせ詳細</h2>

<p>名前: <span id="modal-name"></span></p>
<p>メール: <span id="modal-email"></span></p>
<p>内容: <span id="modal-detail"></span></p>

<form id="delete-form" method="POST">
@csrf
@method('DELETE')

<button type="submit">削除</button>

</form>
<button onclick="closeModal()">閉じる</button>

</div>
<script>

function openModal(contact){

document.getElementById("modal").style.display = "block";

document.getElementById("modal-name").innerText =
contact.last_name + " " + contact.first_name;

document.getElementById("modal-email").innerText =
contact.email;

document.getElementById("modal-detail").innerText =
contact.detail;

document.getElementById("delete-form").action =
"/admin/delete/" + contact.id;

}

function closeModal(){
document.getElementById("modal").style.display = "none";
}

</script>