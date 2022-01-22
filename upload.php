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
    <?php
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], "img/user_profile/" .date("Ymd-His") . $_FILES["upfile"]["name"])) {
chmod("img/user_profile/" . date("Ymd-His") . $_FILES["upfile"]["name"], 0644);
echo "リダイレクトしています...";

$profile_p = date("Ymd-His"). $_FILES["upfile"]["name"];

$query = "UPDATE users SET profile_photos = 'img/user_profile/$profile_p' WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);
} else {
echo '<script type="text/javascript">alert("アップロードできませんでした。\nOKをタップすると戻ります。\n\n 画像取得エラー（E006）");location.href = "settings.php"; </script>';
}
} else {
echo '<script type="text/javascript">alert("ファイルが選択されていません。\nOKをタップすると戻ります。\n\n 画像取得エラー（E006）");location.href = "settings.php"; </script>';
}
?>


<html>
    <head>
    <meta http-equiv="refresh" content="1;URL=settings.php">
    <meta charset="utf-8">
    <title>想友祭2018 スタンプラリー > 画像変更</title>
    </head>
    <body><?php
    $query = "UPDATE users SET profile_photos = 'img/user_profile/$profile_p' WHERE user_id=".$_SESSION['user']."";
    $result = $mysqli->query($query);
    ?>
    </body>
</html>