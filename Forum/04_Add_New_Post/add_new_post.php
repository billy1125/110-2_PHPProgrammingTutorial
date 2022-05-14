<?php
//檢查有沒有名稱是"LoginOK"的Cookie，也檢查值是不是OK，沒有就直接把使用者帶到登入首頁
if (!isset($_COOKIE["LoginOK"]) || $_COOKIE["LoginOK"] != "OK") {
    header("location:login.php"); //直接跳到登入頁面
} else {
    session_start();
    require("functions.php");
    // 檢查有沒有post_id的GET，這要用來查詢特定的回文清單
    if (isset($_POST["title"]) && isset($_POST["user_id"]) && isset($_POST["message"])) {
        if ($_POST["title"] != "" && $_POST["user_id"] && $_POST["message"] != "") {
            if (Add_New_Post($_POST["title"], $_POST["user_id"], $_POST["message"]))
                header("location:index.php");
        } else {
            echo "請輸入標題與文章內容！";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡易討論板</title>
    <style>
        td {
            white-space: pre-line;
        }
    </style>
</head>

<body>
    <h1>發表新主題</h1>
    <hr>
    <p><a href='index.php'>回文章列表</a></p>
    <form name="login" method="post" action="add_new_post.php">
        標題：<textarea cols="50" rows="1" name="title" value=""></textarea><br>
        內文：<br>
        <textarea cols="100" rows="15" name="message" value="" /></textarea><br>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
        <input type="submit" value="發表新主題" />
    </form>

</body>

</html>