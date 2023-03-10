<?php
    session_start();
    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $subject = $_SESSION['subject'];
        $body = $_SESSION['body'];

        // echo "<pre>";
        // var_dump($_SESSION);
        // echo "</pre>";
    }

    $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
    $_token =htmlspecialchars($_SESSION['token'], ENT_QUOTES);
?>
<!docutype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title> 確認画面 - お問い合わせ</title>
        </head> 
        <body>
            <form action="form2_completion.php"  method="post">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <table>
                    <tr>
                        <th>お名前</th>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td><?php echo $subject; ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td><?php echo nl2br($body); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="送信する">
                        </td>
                    </tr>
                </table>
            </form>
                <p>
                    <!-- $_GETにactionというキーができる -->
                    <a href="form2.php? action=edit">入力画面へ戻る</a>
                </p>
        </body>
    </html>