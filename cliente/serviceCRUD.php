<?php
session_start();
include '../config/conn.php';
include '../login/validaLogin.php';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {
    
$errors         = array();      // array para validação de erros
$data           = array();      // array de retorno de dados

// validação das variáveis ======================================================
    // se nenhuma dessas variáveis existir, for vazia, adiciona um erro no nosso $errors array

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
$uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (!$action == "deletar"){
// validação do nome ===================================
if (empty(trim($nome))) {
    $errors['nome'] = 'Nome é obrigatório.';
}
//======================================================

// validação do email ==================================
if (empty(trim($email))) {
    $errors['email'] = 'Email é obrigatório.';
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Email inválido.';
}

if(!$action == "editar"){
$sql = "SELECT * FROM tb_clientes WHERE email = :email";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':email', $email );
$result = $stmt->execute();

if (($stmt) and ($stmt->rowCount() != 0)) {
    $errors['email'] = 'Este e-mail já está sendo utilizado!';
}
}
//======================================================

// validação do endereco ================================
if (empty(trim($cep)) || empty(trim($rua)) || empty(trim($numero)) || empty(trim($bairro)) || empty(trim($cidade)) || empty(trim($uf))) {
    $errors['endereco'] = 'Endereço é obrigatório.';
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
$sql = "UPDATE tb_clientes SET nome = :nome, email = :email, cep = :cep, rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, uf = :uf WHERE id = :id";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':id', $id );
$stmt->bindParam( ':nome', $nome );
$stmt->bindParam( ':email', $email );
$stmt->bindParam( ':cep', $cep );
$stmt->bindParam( ':rua', $rua );
$stmt->bindParam( ':numero', $numero );
$stmt->bindParam( ':bairro', $bairro );
$stmt->bindParam( ':cidade', $cidade );
$stmt->bindParam( ':uf', $uf );

$result = $stmt->execute();
        if($result){
        $data['success'] = true;
        }else{
             $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';   
             $data['success'] = false;
             $data['errors']  = $errors;
        }
        
    } else if ($action == "deletar"){     
        
$sql = "DELETE FROM tb_clientes WHERE id = :id";
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
$sql = "INSERT INTO tb_clientes (nome, email, cep, rua, numero, bairro, cidade, uf) VALUES(:nome, :email, :cep, :rua, :numero, :bairro, :cidade, :uf)";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam( ':nome', $nome );
$stmt->bindParam( ':email', $email );
$stmt->bindParam( ':cep', $cep );
$stmt->bindParam( ':rua', $rua );
$stmt->bindParam( ':numero', $numero );
$stmt->bindParam( ':bairro', $bairro );
$stmt->bindParam( ':cidade', $cidade );
$stmt->bindParam( ':uf', $uf );

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
$result = $pdo->query("SELECT * FROM tb_clientes");
while ($row = $result->fetch(PDO::FETCH_OBJ)) {
$clientes[] = array("id" => $row->id, "nome" => $row->nome, "email" => $row->email, "cep" => $row->cep, "rua" => $row->rua, "numero" => $row->numero, "bairro" => $row->bairro, "cidade" => $row->cidade, "uf" => $row->uf);
}
$data['clientes'] = $clientes;

echo json_encode($data);
}
else {
    header('index.php');   
}