<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>お問い合わせがありました</h2>

    <p><strong>名前：</strong>{{ $details['name'] }}</p>
    <p><strong>メールアドレス：</strong>{{ $details['email'] }}</p>
    <p><strong>お問い合わせ内容：</strong></p>
    <p>{{ $details['message'] }}</p>
</body>
</html>