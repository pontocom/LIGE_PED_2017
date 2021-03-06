<?php
session_start();


if(isset($_REQUEST['email']) && $_REQUEST['email']!="") {
    // efectuar a ligação ao servidor de BD
    try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=pim_lige;charset=utf8mb4', 'root', 'bitnami');
    } catch (PDOException $e) {
        die("Não foi possível ligar ao servidor de BD!!!" + $e);
    }

// construir a query de INSERT que guarda o registo na BD

    $sql = $db->prepare("SELECT * FROM user_pim WHERE username=? AND passwd=?");

    $sql->execute([$_REQUEST['email'], sha1($_POST['passwd'])]);
    $rs = $sql->fetchAll(PDO::FETCH_ASSOC);

    if(empty($rs)) {
        header("Location: index.php?status=2");
    } else {
        $_SESSION['uid'] = $rs[0]["id"];
        $_SESSION['session_status'] = 'on';
        $_SESSION['uname'] = $rs[0]["username"];
        header("Location: pim.php");
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

        <form class="form-signin" action="index.php" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required
                   autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="passwd" type="password" id="inputPassword" class="form-control" placeholder="Password"
                   required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <br>Se ainda não está registado, pode fazê-lo <a href="registo.php">aqui</a>.
            <?php
            if (isset($_REQUEST['status']) && $_REQUEST['status'] == 1) {
                echo "<br><div class=\"alert alert-success\" role=\"alert\">Registo bem sucedido. Por favor, faça login!</div>";
            }
            if (isset($_REQUEST['status']) && $_REQUEST['status'] == 2) {
                echo "<br><div class=\"alert alert-danger\" role=\"alert\">Credenciais erradas!!!</div>";
            }
            ?>
        </form>


    </div> <!-- /container -->

    </body>
    </html>
    <?php
}
?>