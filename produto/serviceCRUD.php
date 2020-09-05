<?php
session_start();

include '../config/conn.php';
include '../config/functions.php';
include '../login/validaLogin.php';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
    
$errors         = array();      // array para validação de erros
$data           = array();      // array de retorno de dados

// validação das variáveis ======================================================
    // se nenhuma dessas variáveis existir, for vazia, adiciona um erro no nosso $errors array

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
$foto = $_FILES['foto'];

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (!$action == "deletar"){
// validação do nome ===================================
if (empty(trim($nome))) {
    $errors['nome'] = 'Nome é obrigatório.';
}
//======================================================

// validação da descricao ==================================
if (empty(trim($descricao))) {
    $errors['descricao'] = 'Descrição é obrigatória.';
}
//==========================================================

// validação do valor ==================================
if (empty(trim($valor))) {
    $errors['valor'] = 'Valor é obrigatório.';
}
//==========================================================


if(!$action == "editar"){
// validação da foto ================================
$tipos=array(
    'image/gif',
    'image/jpeg',
    'image/png',
);
if (empty($foto)) {
    $errors['foto'] = 'Foto é obrigatória.';
} elseif (!in_array($foto["type"], $tipos)) {
    $errors['foto'] = 'Formatos aceitos: jpeg, png e gif.';
}
}
}
//======================================================

// retorna as respostas ===========================================================

    // se tem algum erro no nosso array de erros, retorna um boolean de sucesso ou falso
    if ( ! empty($errors)) {

        // se tiver itens com erro em nosso array, retorna esses erros para o front end
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
if($action == "editar"){
if($foto['size']  == 0 ){$data['teste'] = 1;
    $sql = "UPDATE tb_produtos SET nome = :nome, descricao = :descricao, valor = :valor WHERE id = :id";
}else if ($foto['tmp_name']){
    $sql = "UPDATE tb_produtos SET nome = :nome, descricao = :descricao, valor = :valor, foto = :foto WHERE id = :id";
    //converte imagem
    $binary = file_get_contents( $foto['tmp_name'] );
    $foto = base64_encode($binary);
}

$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':id', $id );
$stmt->bindParam( ':nome', $nome );
$stmt->bindParam( ':descricao', $descricao );
$stmt->bindParam( ':valor', $valor );
if(!$foto['size']  == 0){
$stmt->bindParam( ':foto', $foto );
}

$result = $stmt->execute();
        if($result){
        $data['success'] = true;
        }else{
             $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';   
             $data['success'] = false;
             $data['errors']  = $errors;
        }
        
    }else if ($action == "deletar"){     
        
$sql = "DELETE FROM tb_produtos WHERE id = :id";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':id', $id );

$result = $stmt->execute();
        if($result){
        $data['success'] = true;
        }else{
             $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';   
             $data['success'] = false;
             $data['errors']  = $errors;
        } 
        
    }else{
       
$sql = "INSERT INTO tb_produtos (nome, descricao, valor, foto) VALUES(:nome, :descricao, :valor, :foto)";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':nome', $nome );
$stmt->bindParam( ':descricao', $descricao );
$valor = converterMoedaMysql($valor);
$stmt->bindParam( ':valor', $valor );

//converte imagem
$binary = file_get_contents( $foto['tmp_name'] );
$foto = base64_encode($binary);

$stmt->bindParam( ':foto', $foto );


$result = $stmt->execute();
        if($result){
        $data['success'] = true;
        }else{
             $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';   
             $data['success'] = false;
             $data['errors']  = $errors;
        }
        
    }
    }
    
$result = $pdo->query("SELECT * FROM tb_produtos");
while ($row = $result->fetch(PDO::FETCH_OBJ)) {
$produtos[] = array("id" => $row->id, "descricao" => $row->descricao, "nome" => $row->nome, "valor" => $row->valor, "foto" => $row->foto);
}
$data['produtos'] = $produtos;


echo json_encode($data);
}
else {
    header('index.php');   
}