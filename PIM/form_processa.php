<?php
/**
 * Created by PhpStorm.
 * User: cserrao
 * Date: 17/03/2017
 * Time: 11:54
 */

echo 'Nome = '.$_POST['nome'].'<br>';
echo 'Morada = '.$_POST['morada'].'<br>';
echo 'Telefone = '.$_POST['telefone'].'<br>';
echo 'Email = '.$_POST['email'].'<br>';
print_r($_FILES['file']);

move_uploaded_file($_FILES['file']['tmp_name'], "./photos/".$_FILES['file']['name']);

