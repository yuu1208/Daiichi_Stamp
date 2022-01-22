
<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
	header("Location: mypage.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

$result = $mysqli->query($query);
if (!$result) {
	echo '<script type="text/javascript">alert("エラーが発生しました。\n一度最初の画面に戻り、再度ログインして下さい。\n\n ログイン認証エラー（E004）");location.href = "index.html"; </script>';
	$mysqli->close();
	exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
	$username = $row['username'];
    $email = $row['email'];
    $complete_per = $row['complete_per'];
    $profile_photos = $row['profile_photos'];
}
 
// データベースの切断
$result->close();

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>想友祭2018 スタンプラリー > 遊びかた</title>
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
    <body>
        
        <div id="container">
        
            <div id="header">
                <p><a href="index.html">想友祭2018スタンプラリー<br /><span>さぁ、学校を探検しよう！</span></a></p>
            </div>

            <div id="contents">

                <div class="aside">
                    <div class="userbox">
                    <div class="profile" style="background-image:url('<?php echo $profile_photos; ?>')"></div>
                        <p class="userid" id="aside_profile"><?php echo $username; ?></p>
                        <p class="complete">コンプリート率: <?php echo $complete_per; ?>%</p>
                    </div>

                    <div class="nav">
                        <ul>
                            <li><a href="mypage.php" class="navlink">マイページ</a></li>
                            <li><a href="howto.php" class="navlink">このゲームの遊び方</a></li>
                            <li><a href="maps.php" class="navlink">校内マップ</a></li>
                            <li><a href="settings.php" class="navlink">アカウント設定</a></li>
                            <li><a href="logout.php?logout" class="navlink">ログアウト</a></li>
                        </ul>
                    </div>
                </div>

                <div class="cont">

                <div class="box">
                <h3>このゲームの遊びかた</h3>
                <p class="text">1. まず校内を探し、QRコード（スタンプ）を見つけます！<br />
                2. QRコードを見つけたら読み取ります。<br />
                3. クイズに答えます。正解するとスタンプがゲットできます！</p>

                <p class="text">QRコードが見つからない場合、校内マップを見てみたり、他の友だちにも聞いてみよう！</p>

                <h3>QRコードの読み取りかた</h3>
                <p class="text"><span style="font-family:Mplus-1c-bold">iPadの場合</span><br />
                標準のカメラアプリを起動し、QRコードを写すと画面上に表示される通知をタップします。</p>

                <p class="text"><span style="font-family:Mplus-1c-bold">その他タブレットの場合</span><br>
                QRコード対応のカメラアプリを起動し写します。URL(リンク)が表示されたらタップします。</p>

                <h3>iPadの場合はラクラク起動！</h3>
                <p class="text">iPadでプレイしてる方は、毎回Safariなどのブラウザを開かなくても、アイコンを作るだけで簡単に起動できます！手順も簡単！</p>
                <ol>
                    <li><p class="text">右上の共有マーク<img src="img/share.png" alt="share" width="20">をタップ</p></li>
                    <li><p class="text">下の段を右から左へスクロールし、「ホーム画面に追加」をタップ</p></li>
                    <li><p class="text">右上の「追加」をタップして完了！あとはアイコンを押して起動するだけ！</p></li>
                </ol>

                <h3>エラーが発生した場合</h3>
                <p class="text"><a href="help.html" class="link">こちら</a>のヘルプをご覧になって対処してみて下さい。</p>

                <h3>注意事項</h3>
                <p class="text">・歩きながらの使用は大変危険ですのでおやめ下さい。<br />
                <span style="color:red">・スクリーンショットなどを公にSNS上へ公開・共有しないで下さい。</span></p>
                </div>

                </div>

            </div>

        </div>
    </body>
</html>