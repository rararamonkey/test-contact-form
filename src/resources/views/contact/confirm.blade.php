<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>Confirm</title>
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>

<body>

<header class="header">
<div class="header__inner">
<a class="header__logo" href="/">
FashionablyLate
</a>
</div>
</header>

<main>

<div class="confirm__content">

<div class="confirm__heading">
<h2>Confirm</h2>
</div>

<form method="post" action="/contacts">
@csrf

<table class="confirm-table">

<tr>
<th>お名前</th>
<td>
{{ $contact['last_name'] }} {{ $contact['first_name'] }}

<input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
<input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
</td>
</tr>

<tr>
<th>性別</th>
<td>

@if($contact['gender']==1)
男性
@elseif($contact['gender']==2)
女性
@else
その他
@endif

<input type="hidden" name="gender" value="{{ $contact['gender'] }}">

</td>
</tr>

<tr>
<th>メールアドレス</th>
<td>

{{ $contact['email'] }}

<input type="hidden" name="email" value="{{ $contact['email'] }}">

</td>
</tr>

<tr>
<th>電話番号</th>
<td>

{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}

<input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
<input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
<input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">

</td>
</tr>

<tr>
<th>住所</th>
<td>

{{ $contact['address'] }}

<input type="hidden" name="address" value="{{ $contact['address'] }}">

</td>
</tr>

<tr>
<th>建物名</th>
<td>

{{ $contact['building'] }}

<input type="hidden" name="building" value="{{ $contact['building'] }}">

</td>
</tr>

<tr>
<th>お問い合わせの種類</th>
<td>

@if($contact['category'] == 1)
商品のお届けについて
@elseif($contact['category'] == 2)
商品の交換について
@elseif($contact['category'] == 3)
商品トラブル
@elseif($contact['category'] == 4)
ショップへのお問い合わせ
@elseif($contact['category'] == 5)
その他
@endif

<input type="hidden" name="category" value="{{ $contact['category'] }}">

</td>
</tr>

<tr>
<th>お問い合わせ内容</th>
<td>

{{ $contact['message'] }}

<input type="hidden" name="message" value="{{ $contact['message'] }}">

</td>
</tr>

</table>

<div class="confirm__button">

<button type="submit" class="confirm__button-submit">送信</button>

  <button type="submit"
          formaction="/contacts"
          formmethod="get"
          class="confirm__button-fix">
          修正
  </button>
</div>
</form>


</div>

</div>

</main>

</body>
</html>