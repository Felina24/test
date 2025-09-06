<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
  <div class="screen">
    <div class="div">

        <header class="header">
            <h1 class="logo">FashionablyLate</h1>
        </header>

      <h2 class="contact">Contact</h2>

      <div class="form-wrapper">
        <form action="/confirm" method="post" class="contact-form" novalidate>
          @csrf

          <div class="form-group">
            <label>お名前 <span class="required">※</span></label>
            <div class="input-area">
              <div class="name-fields">
                <input type="text" name="last_name" placeholder="例: 山田"
                  value="{{ old('last_name', $form['last_name'] ?? '') }}" required>
                <input type="text" name="first_name" placeholder="例: 太郎"
                  value="{{ old('first_name', $form['first_name'] ?? '') }}" required>
              </div>
              @error('last_name') <div class="error">{{ $message }}</div> @enderror
              @error('first_name') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>性別 <span class="required">※</span></label>
            <div class="input-area">
              <div class="gender-options">
                <label><input type="radio" name="gender" value="male"
                  {{ (old('gender', $form['gender'] ?? 'male') == 'male') ? 'checked' : '' }}> 男性</label>
                <label><input type="radio" name="gender" value="female"
                  {{ (old('gender', $form['gender'] ?? '') == 'female') ? 'checked' : '' }}> 女性</label>
                <label><input type="radio" name="gender" value="other"
                  {{ (old('gender', $form['gender'] ?? '') == 'other') ? 'checked' : '' }}> その他</label>
              </div>
              @error('gender') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>メールアドレス <span class="required">※</span></label>
            <div class="input-area">
              <input type="email" name="email" placeholder="例: test@example.com"
                value="{{ old('email', $form['email'] ?? '') }}" required>
              @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>電話番号 <span class="required">※</span></label>
            <div class="input-area">
              <div class="tel-fields">
                <input type="text" name="tel[0]" maxlength="4" placeholder="080"
                  value="{{ old('tel.0', $form['tel'][0] ?? '') }}" required>
                <span>-</span>
                <input type="text" name="tel[1]" maxlength="4" placeholder="1234"
                  value="{{ old('tel.1', $form['tel'][1] ?? '') }}" required>
                <span>-</span>
                <input type="text" name="tel[2]" maxlength="4" placeholder="5678"
                  value="{{ old('tel.2', $form['tel'][2] ?? '') }}" required>
              </div>
              @error('tel.0') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>住所 <span class="required">※</span></label>
            <div class="input-area">
              <input type="text" name="adress" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ old('adress', $form['adress'] ?? '') }}" required>
              @error('adress') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>建物名</label>
            <div class="input-area">
              <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101"
                value="{{ old('building', $form['building'] ?? '') }}">
              @error('building') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>お問い合わせの種類 <span class="required">※</span></label>
            <div class="input-area">
              <select name="category_id" required>
                <option value="">選択してください</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}"
                    {{ old('category_id', $form['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                  </option>
                @endforeach
              </select>
              @error('category_id') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="form-group">
            <label>お問い合わせ内容 <span class="required">※</span></label>
            <div class="input-area">
              <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください" required>{{ old('detail', $form['detail'] ?? '') }}</textarea>
              @error('detail') <div class="error">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="submit-button">
            <button type="submit">確認画面</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</body>
</html>
