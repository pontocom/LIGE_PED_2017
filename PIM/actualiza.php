<?php
/* Ligar à BD */
try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=pim_lige;charset=utf8mb4", "root", "bitnami");
} catch (Exception $e) {
    die("Ocorreu um erro na ligação à BD!!!");
}

// preparar a query
$sql = $db->prepare("UPDATE contacto SET nome=?, morada=?, telefone=?, email=? WHERE id=?");

// executar a query

if($sql->execute([$_REQUEST['nome'], $_REQUEST['morada'], $_REQUEST['telefone'], $_REQUEST['email'], $_REQUEST['id']])) {
    header("Location: pim.php?status_actualizar=1");
} else {
    header("Location: pim.php?status_actualizar=0");
}
?>