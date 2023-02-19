<?php 
session_start();

// 下記のif分の　&& ($_POST['token'] === $_SESSION['token'])の条件を削除している
// 実質、ワンタイムチケは作動していない
if(isset($_POST['token'], $_SESSION['token']) ){
    unset($_SESSION['token']);

    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $subject = $_SESSION['subject'];
    $body = $_SESSION['body'];

    $dsn = 'mysql:dbname=contact_form2;host=localhost;charset=utf8';
    $user = 'root';
    $passward = 'root';

    $dbh = new PDO($dsn, $user, $passward);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = 'INSERT INTO inquiries (name, email, subject, body) VALUES(?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $subject, PDO::PARAM_STR);
    $stmt->bindValue(4, $body, PDO::PARAM_STR);

    $stmt->execute();

    // var_dump($dbh);

    $dbh = null;

    $_SESSION = array();

    if(ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"],$params["httponly"]
        );
    }
    session_destroy();
    // echo "きちんとしたアクセスっす";
}else{
    header('Location: http://localhost:8888/php_form_2/form2.php');
    exit();
}
?>
 <!doctype html>
 <html>
    <head>
        <meta charset="utf-8">
        <title>
            完了画面 - お問い合わせ
        </title>
        <head>
            <body>
                <p>
                    お問い合わせありがとうございます。
                </p>
            </body>
        </head>
    </head>
 </html>
