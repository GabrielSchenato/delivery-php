<?php
include '../config/conn.php';
if (isset($_SESSION['LOGADO'])) { //verifica se a sessão já não estava aberta e destrói a sessão

session_start();
$_SESSION = array();
session_unset();
session_destroy();

}

$user = isset($_POST['usuario']) ? trim($_POST['usuario']) : "";
$pass = isset($_POST['password']) ? trim($_POST['password']) : "";


if ((!empty($user)) and ( !empty($pass))) {

$filtro = array('usuario' => $user);
    $rs = $pdo->prepare("SELECT id, nome, email, funcao, usuario, senha FROM tb_usuarios WHERE usuario = :usuario LIMIT 1");
    if ($rs->execute($filtro)) {
        if ($rs->rowCount() > 0) {
            $row = $rs->fetch(PDO::FETCH_OBJ);
            if(password_verify($pass, $row->senha)){
                session_start();
                $_SESSION['LOGADO'] = 'verdade';
                $_SESSION['id'] = $row->id;
                $_SESSION['nome'] = $row->nome;
                $_SESSION['email'] = $row->email;
                $_SESSION['funcao'] = $row->funcao;
                $_SESSION['usuario'] = $row->usuario;
                header("location: ../home/dashboard.php");
            }else{
                header("location: ../index.php");
        }
    }else{
        header("location: ../index.php");
    }
}

}else{
    header("location: ../index.php");
}