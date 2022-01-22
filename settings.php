
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
        <title>想友祭2018 スタンプラリー > アカウント設定</title>
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
                    <div class="box" style="background:white">
                    <h3>アカウント設定</h3>
                    <ul class="settingsUL">
                        <li style="width:150"><div class="profile" style="background-image:url('<?php echo $profile_photos; ?>')"></div></li>
                        <li style="position:absolute;margin-top:11"><p class="userid" style="line-height:1.2;"><?php echo $username; ?></p>
                    <p class="text"><?php echo $email; ?><br><?php echo $complete_per; ?>% のコンプリート</p></li>
                    </ul>
                    <!---->
                    
                    <p class="text" style="font-weight:bold">プロフィール画像を変更</p>
                    <p class="text">プロフィール写真を変更することができます。<br /><span style="color:red">画像がセットされていない状態で適用ボタンを押さないで下さい</span></p>
                    <form method="post" action="upload.php" method="post" enctype="multipart/form-data">
                    <input style="padding:14;background: rgb(249, 249, 249);" type="file" name="upfile" size="20" id="upload">
                    <button class="bt" style="background:#EFEFEF;width:70px;color:#707070;margin-top:5px" name="delete_profile" type="submit">適用</button>
                    </form>
                    <form method="post">
                    <button class="bt" style="background:#fdcece;width:230px;color:#ED3B3B" name="delete_profile">プロフィール画像の削除</button></form>
                    <?php
                        if(isset($_POST['delete_profile'])) {
                            $query = "UPDATE users SET profile_photos = 'img/default.png' WHERE user_id=".$_SESSION['user']."";;
                            $result = $mysqli->query($query);
                        }
                    ?>
　　　　　　　　　　　　<h3>法的に基づく情報</h3>
                    <p class="text"><a href="terms.html" class="link">利用規約</a><br /><a href="privacy.html" class="link">プライバシーポリシー</a><br /><a href="copyright.html" class="link">各ライブラリの使用に関する著作権表示</a><br /></p>
                    <h3>著作権情報</h3>
                    <p class="text">Copyright &copy; 2018 Yuta Nakane All Rights Reserved.<br />
                    Assets & Designs created by Yuta Nakane.</p>
                    <p class="text">著作権所持。無断転載を禁じます。<br />
                        <span style="color:red">スクリーンショットなどを公にSNS上へ公開・共有しないで下さい。</span>
                    </p>
                </div>
                </div>

            </div>

        </div>
    </body>
</html>