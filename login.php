<?php
ob_start();
// ここから、register.phpと同様
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: mypage.php");
}
include_once 'dbconnect.php';
// ここまで、register.phpと同様
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>想友祭2018 スタンプラリー > ログイン</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p" rel="stylesheet">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon" href="img/favicon.ico">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="スタンプラリー">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/nativeswitch.js"></script>
    </head>



    <body style="background-image:url('img/back.png');">
        
        <div id="container">
        
            

            <div id="contents">
                <?php
                if(isset($_POST['login'])) {

                    $email = $mysqli->real_escape_string($_POST['email']);
                    $password = $mysqli->real_escape_string($_POST['password']);

                    // クエリの実行
                    $query = "SELECT * FROM users WHERE email='$email'";
                    $result = $mysqli->query($query);
                    if (!$result) {
                        print('クエリーが失敗しました。' . $mysqli->error);
                        $mysqli->close();
                        exit();
                    }

                    // パスワード(暗号化済み）とユーザーIDの取り出し
                    while ($row = $result->fetch_assoc()) {
                        $db_hashed_pwd = $row['password'];
                        $user_id = $row['user_id'];
                    }

                    // データベースの切断
                    $result->close();

                    // ハッシュ化されたパスワードがマッチするかどうかを確認
                    if (password_verify($password, $db_hashed_pwd)) {
                        $_SESSION['user'] = $user_id;
                        header("Location: mypage.php");
                        exit;
                    } else { ?>
                        <div class="alert" role="alert">ログイン情報に誤りがあります（E001）</div>
                    <?php }
                } ?>
                <div class="login">
                    <img src="img/icon.png" alt="icon" width="60">
                    <h2>おかえりなさい!</h2>

                    <form method="post">
                    <input type="email"  class="form-control" name="email" placeholder="メールアドレス" required/>
                    <input type="password" class="form-control" name="password" placeholder="パスワード" required/>
                    <button type="submit" class="bt" style="background:#D9FFDD" name="login">ログイン</button>
                    </form>
                    <p class="text">レポートシステムのアカウントではありません</p>
                    <p><a href="register.php" class="link">アカウントを持っていない場合</a></p>
                    <p style="text-align:right;padding-right:10px;"><a href="help.html" class="link">お困りの方</a></p>
                </div>

            </div>

        </div>
    </body>
</html>