<?php
session_start();

/* Ligar à BD */
try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=pim_lige;charset=utf8mb4", "root", "bitnami");
} catch (Exception $e) {
    die("Ocorreu um erro na ligação à BD!!!");
}

// preparar a query
$sql = $db->prepare("INSERT INTO contacto (nome, morada, telefone, email, photo, id_contacto) VALUES (?,?,?,?,?,?)");

//print_r($_REQUEST);
//die();
// executar a query

if($sql->execute([$_REQUEST['nome'], $_REQUEST['morada'], $_REQUEST['telefone'], $_REQUEST['email'], '', $_SESSION['uid']])) {
    header("Location: pim.php?status=1");
} else {
    header("Location: pim.php?status=0");
}
?>