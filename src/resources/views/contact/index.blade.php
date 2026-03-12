<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/confirm" method="post" novalidate>
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>

          <div class="form__group-content name-group">

            <div class="form__input--text">
              <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田" />
              <div class="form__error">
                @error('last_name')
                <p>{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="form__input--text">
              <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎" />
              <div class="form__error">
                @error('first_name')
                <p class="form__error">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="form__group">
  <div class="form__group-title">
    <span class="form__label--item">性別</span>
    <span class="form__label--required">※</span>
  </div>

  <div class="form__group-content gender-group">

    <label class="form__input--radio">
      <input type="radio" name="gender" value="1" {{ old('gender',1) == 1 ? 'checked' : '' }}>
      男性
    </label>

    <label class="form__input--radio">
      <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
      女性
    </label>

    <label class="form__input--radio">
      <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>
      その他
    </label>

  </div>
  <div class="form__error">
    @error('gender')
    <p>{{ $message }}</p>
    @enderror
</div>
</div> 
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" />
            </div>
            <div class="form__error">
              @error('email')
              <p>{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
  <div class="form__group-title">
    <span class="form__label--item">電話番号</span>
    <span class="form__label--required">※</span>
  </div>

  <div class="form__group-content">

    <div class="tel-group">
      <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="3" placeholder="080"/>
      <span class="tel-hyphen">-</span>
      <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="4" placeholder="1234"/>
      <span class="tel-hyphen">-</span>
      <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="4" placeholder="5678"/>
    </div>

    <div class="form__error">
      @error('tel1')
      <p>{{ $message }}</p>
      @enderror
    </div>

  </div>
</div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"/>
            </div>
            <div class="form__error">
              @error('address')
              <p>{{ $message }}</p>
              @enderror
              </div>
          </div>
        </div>
          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">建物名</span>
            </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>
          </div>
        </div>
          <div class="form__group">
            <div class="form__group-title">
              <span>お問い合わせの種類</span>
              <span class="form__label--required">※</span>
            </div>
          <div class="form__group-content">
            <select name="category_id" class="form__select" required>
                <option value="" disabled {{ old('category') ? '' : 'selected' }}>選択してください</option>
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
            </select>
              <div class="form__error">
                @error('category')
                <p>{{ $message }}</p>
                @enderror
              </div>
          </div>
        </div>
          <div class="form__group">
            <div class="form__group-title">
              <span class="form__label--item">お問い合わせ内容</span>
              <span class="form__label--required">※</span>
            </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
              @error('detail')
              <p>{{ $message }}</p>
              @enderror
          </div>
        </div>
      </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
      </form>
      </main>
  </body>

</html>
