<?php
if(isset($_POST['email'])) {
    /* Ligar à BD */
    try {
        $db = new PDO("mysql:host=127.0.0.1;dbname=pim_lige;charset=utf8mb4", "root", "bitnami");
    } catch (Exception $e) {
        die("Ocorreu um erro na ligação à BD!!!");
    }

    // preparar a query
    $sql = $db->prepare("INSERT INTO user_pim (username, passwd) VALUES (?,?)");

    // executar a query

    if($sql->execute([$_POST['email'], sha1($_POST['passwd'])])) {
        header("Location: index.php?status=1");
    } else {
        header("Location: registo.php?status=0");
    }

} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>PIM</title>

        <!-- Bootstrap core CSS -->
        <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./signin.css" rel="stylesheet">

    </head>

    <body>

    <div class="container">

        <form class="form-signin" action="registo.php" method="post">
            <h2 class="form-signin-heading">Please register</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="passwd" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <input name="repasswd" type="password" id="inputPassword" class="form-control" placeholder="Re-type Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <?php
                if(isset($_REQUEST['status']) && $_REQUEST['status']==0) {
                    echo "<br><div class=\"alert alert-danger\" role=\"alert\">Ocorreu um erro no registo!</div>";
                }
            ?>
        </form>

    </div> <!-- /container -->

    </body>
    </html>

    <?php
}
?>
