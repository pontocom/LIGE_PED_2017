<?php
session_start();
if($_SESSION['session_status']!="on") {
    header("Location: index.php");
} else {
    // efectuar a ligação ao servidor de BD
    try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=pim_lige;charset=utf8mb4', 'root', 'bitnami');
    } catch (PDOException $e) {
        die("Não foi possível ligar ao servidor de BD!!!" + $e);
    }

    // construir a query de SELECT que guarda o registo na BD

    $sql = $db->prepare("SELECT * FROM contacto WHERE id = ?");

    $sql->execute([$_REQUEST['id']]);
    $rs = $sql->fetchAll(PDO::FETCH_ASSOC);


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

        <title>Starter Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./starter-template.css" rel="stylesheet">

    </head>

    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">PIM Gestão de Contactos - LIGE</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="pim.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="starter-template">
            <h1><?php echo $_SESSION['uname']; ?></h1>
            <p class="lead">Gestão de Contactos</p>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="pim.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" name="nome" placeholder="Nome" readonly value="<?php echo $rs[0]["nome"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Morada</label>
                        <textarea class="form-control" rows="3" name="morada" readonly><?php echo $rs[0]["morada"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefone</label>
                        <input class="form-control" name="telefone" placeholder="Telefone" readonly value="<?php echo $rs[0]["telefone"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" name="email" placeholder="Email" readonly value="<?php echo $rs[0]["email"]; ?>">
                    </div>
                    <button type="submit" class="btn btn-default">Ok</button>
                </form>

            </div>
            <div class="col-md-3">
            </div>
        </div>


    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    <?php
}
?>
