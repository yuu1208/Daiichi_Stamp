
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
    $userid = $row['user_id'];
	$username = $row['username'];
    $email = $row['email'];
    $profile_photos = $row['profile_photos'];
    $complete_per = $row['complete_per'];
    $stamp01_stat = $row['stamp01_stat'];
    $stamp02_stat = $row['stamp02_stat'];
    $stamp03_stat = $row['stamp03_stat'];
    $stamp04_stat = $row['stamp04_stat'];
    $stamp05_stat = $row['stamp05_stat'];
    $stamp06_stat = $row['stamp06_stat'];
}

// データベースの切断
$result->close();

?>
<?php
if ($stamp01_stat == 1) {
    $sta01 = "1";
} elseif ($stamp01_stat == 0) {
    $sta01 = "blank";
}
if ($stamp02_stat == 1) {
    $sta02 = "2";
} elseif ($stamp02_stat == 0) {
    $sta02 = "blank";
}
if ($stamp03_stat == 1) {
    $sta03 = "3";
} elseif ($stamp03_stat == 0) {
    $sta03 = "blank";
}
if ($stamp04_stat == 1) {
    $sta04 = "4";
} elseif ($stamp04_stat == 0) {
    $sta04 = "blank";
}
if ($stamp05_stat == 1) {
    $sta05 = "5";
} elseif ($stamp05_stat == 0) {
    $sta05 = "blank";
}
if ($stamp06_stat == 1) {
    $sta06 = "6";
} elseif ($stamp06_stat == 0) {
    $sta06 = "blank";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>想友祭2018 スタンプラリー > マイページ</title>
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
                <h3>ゲットしたスタンプ</h3>

                <ul class="stamplist">
                
                <li style="background-image:url('stamp/<?php echo $sta01 ?>.png');"></li>
                <li style="background-image:url('stamp/<?php echo $sta02 ?>.png');"></li>
                <li style="background-image:url('stamp/<?php echo $sta03 ?>.png');"></li>
                <li style="background-image:url('stamp/<?php echo $sta04 ?>.png');"></li>
                <li style="background-image:url('stamp/<?php echo $sta05 ?>.png');"></li>
                <li style="background-image:url('stamp/<?php echo $sta06 ?>.png');"></li>
                </ul>

                <h3>お知らせ</h3>
                <p class="text">・分かりづらい場所にもあったりします！頑張って探してみよう！<br />
                ・場所によってはちょっとしたクイズが出題されることも！<br />
                ・<s>ねっ、簡単でしょ〜!?</s></p>

                <h3>注意事項</h3>
                <p class="text">・歩きながらの使用は大変危険ですのでおやめ下さい。<br />
                <span style="color:red">・スクリーンショットなどを公にSNS上へ公開・共有しないで下さい。</span></p>
                </div>

                </div>

            </div>

        </div>
    </body>
</html>