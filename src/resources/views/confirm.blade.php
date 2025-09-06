<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirm - FashionablyLate</title>
    <link rel="stylesheet" href="css/confirm.css" />
</head>

<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
    </header>

    <main class="main">
        <h2 class="page-title">Confirm</h2>
        <div class="confirm-box">
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $form['last_name'] }} {{ $form['first_name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>{{ $genders[$form['gender']] ?? '' }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $form['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ implode('-', $form['tel']) }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $form['adress'] }}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $form['building'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $categories[$form['category_id']] ?? '' }}</td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{!! nl2br(e($form['detail'])) !!}</td>
                </tr>
            </table>

          <div class="button-group">
            <form action="/send" method="post" class="inline-form">
            @csrf
            @foreach ($form as $key => $value)
                @if(is_array($value))
                    @foreach($value as $i => $v)
                        <input type="hidden" name="{{ $key }}[{{ $i }}]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <button class="submit-buttons" type="submit">送信</button>
            </form>

            <form action="/" method="get" class="inline-form">
            <button class="submit-buttons" type="submit">修正</button>
            </form>
            
          </div>

        </div>
    </main>
</body>

</html>
