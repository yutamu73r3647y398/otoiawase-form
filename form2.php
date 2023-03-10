<?php
    session_start();

    // $_POSTの中身を表示
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $errors = array();

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        // htmlspecialcharsの設定
        $name = htmlspecialchars($name,ENT_QUOTES);
        $email = htmlspecialchars($email,ENT_QUOTES);
        $subject = htmlspecialchars($subject,ENT_QUOTES);
        $body = htmlspecialchars($body,ENT_QUOTES);


        // それぞれの配列に入力がなかった場合、$errorsを代入する
        if($name === ""){
            $errors['name'] = "お名前が入力されていましぇぇぇぇん";
        }
        if($email === ""){
            $errors['email'] = "mailadressが入力されていましぇぇぇぇん";
        }
        if($body === ""){
            $errors['body'] = "お問い合わせ内容が入力されていましぇぇぇぇん";
        }

        // &errors連想配列のキーの数が０であればtrue
        if(count($errors) === 0) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['subject'] = $subject;
            $_SESSION['body'] = $body;

            header('Location:http://localhost:8888/php_form_2/form2_confirm.php');

            exit();
        }
    }   
    if(isset($_GET['action']) && $_GET['action'] === 'edit'){
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $subject = $_SESSION['subject'];
        $body = $_SESSION['body'];
    }

    // echo "<pre>";
    // var_dump($errors);
    // echo "</pre>";
?>
<!docutype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ</title>
    </head>
    <body>
    <?php
            echo "<ul>";
            foreach($errors as $value) {
                echo "<li>";
                echo $value;
                echo "</li>";
            }
            echo "</ul>";
        ?>

        <!-- 確認画面に遷移 -->
        <form action="form2.php" method="post">
            <table>
                <tr>
                    <!-- 入力情報を遷移先に残す -->
                    <th>お名前</th>
                    <td><input type="text" name="name" 
                        value="<?php if(isset($name)){
                            echo $name;} ?>">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td><input type="text" name="email"
                        value="<?php if(isset($email)){
                            echo $name;} ?>">
                    </td>
                </tr>

                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        <select name="subject">
                            <option value="お仕事に関するお問い合わせ"
                                <?php 
                                    if(isset($subject) && $subject === "お仕事に関するお問い合わせ"){
                                        echo "selected" ;
                                    }
                                ?>
                            >お仕事に関するお問い合わせ
                            </option>
                            <option value="その他のお問い合わせ"
                                <?php
                                    if(isset($subject) && $subject === "その他のお問い合わせ"){
                                        echo "selected" ;
                                    }
                                ?>
                            >その他のお問い合わせ</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        <textarea name="body" cols="40" rows="10">
                            <?php if(isset($body)){
                                echo $body;
                            }
                            ?>
                        </textarea>
                    </td>
                </tr>
                    
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="確認画面へ"></td>
                </tr>
            </table>
        </form>
    </body>
    
</html>

