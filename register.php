<?php
session_start();
if( isset($_SESSION['user']) != "") {
    // ログイン済みの場合はリダイレクト
    header("Location: mypage.php");
}

// DBとの接続
include_once 'dbconnect.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>想友祭2018 スタンプラリー > 新規登録</title>
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
                // signupがPOSTされたときに下記を実行
                if(isset($_POST['signup'])) {

                    $username = $mysqli->real_escape_string($_POST['username']);
                    $email = $mysqli->real_escape_string($_POST['email']);
                    $password = $mysqli->real_escape_string($_POST['password']);
                    $password = password_hash($password, PASSWORD_BCRYPT);

                    // POSTされた情報をDBに格納する
                    $query = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";

                    if($mysqli->query($query)) {  ?>
                    
                        <div class="alert alert-success" role="alert">登録が完了しました！</div>
                        <?php } else { ?>
                        <div class="alert alert-danger" role="alert">既に登録されています（E002）</div>
                        <?php
                    }
                } ?>

                <div class="login" style="padding: 30 10 15 10;">
                    <img src="img/icon.png" alt="icon" width="60">
                    <h2>ようこそ!</h2>

                    <form method="post">
                    <input type="text"  class="form-control" name="username" placeholder="ユーザー名" required/>
                    <input type="email"  class="form-control" name="email" placeholder="メールアドレス" required/>
                    <input type="password" class="form-control" name="password" placeholder="パスワード" required/>

                    <button type="submit" class="bt" name="signup" style="background:#D9FFFC">新規登録</button>
                    </form>
                    <p class="text">レポートシステムのIDやパスワードは使用しないで下さい。</p>
                    <p><a href="login.php" class="link">アカウントを持っている場合</a></p>
                    <p style="text-align:right;padding-right:10px;"><a href="help.html" class="link">お困りの方</a></p>
                </div>

            </div>

        </div>
    </body>
</html>