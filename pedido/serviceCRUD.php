<?php

session_start();

include '../config/conn.php';
include '../config/functions.php';
include '../login/validaLogin.php';

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')) {

    $errors = array();      // array para validação de erros
    $data = array();      // array de retorno de dados
// validação das variáveis ======================================================
    // se nenhuma dessas variáveis existir, for vazia, adiciona um erro no nosso $errors array
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);


    $info = json_decode(file_get_contents("php://input"));
    if (count($info) > 0) {
        $idCliente = $info->idCliente;
        $idPedido = $info->idPedido;
        
        $datahora = $info->datahora;
        $mysqlDate = DateTime::createFromFormat('d/m/Y H:i:s', $datahora);

        $produtos = $info->produtos;
        $valorTotal = $info->total;
        $btn_name = $info->btnName;
        if ($btn_name == "Insert") {
            $sql = "INSERT INTO tb_pedidos (id_cliente, data_hora, valor_total) VALUES(:idCliente, :data_hora, :valor_total)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente);
            $stmt->bindParam(':data_hora', $mysqlDate->format('Y-m-d H:i:s'));
            $stmt->bindParam(':valor_total', $valorTotal);
            $result = $stmt->execute();
            if ($result) {
                $data['success'] = true;

                $idPedido = $pdo->lastInsertId();

                foreach ($produtos as $value) {
                    $qtda = $value->qtda;
                    $obs = $value->obs;
                    $idProduto = $value->produtoSelecionado->id;
                    $valor = $value->produtoSelecionado->valor;

                    $sql = "INSERT INTO tb_pedido_produtos (id_pedido, id_produto, quantidade, valor, observacao) VALUES(:id_pedido, :id_produto, :quantidade, :valor, :observacao)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id_pedido', $idPedido);
                    $stmt->bindParam(':id_produto', $idProduto);
                    $stmt->bindParam(':quantidade', $qtda);
                    $stmt->bindParam(':valor', $valor);
                    $stmt->bindParam(':observacao', $obs);
                    $result = $stmt->execute();
                }
            } else {
                $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        } else if ($btn_name == 'Update') {
            $sql = "DELETE FROM tb_pedido_produtos WHERE id_pedido = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idPedido);
            $result = $stmt->execute();

            $sql = "DELETE FROM tb_pedidos WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idPedido);
            $result = $stmt->execute();

            
            $sql = "INSERT INTO tb_pedidos (id_cliente, data_hora, valor_total) VALUES(:idCliente, :data_hora, :valor_total)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente);
            $stmt->bindParam(':data_hora', $mysqlDate->format('Y-m-d H:i:s'));
            $stmt->bindParam(':valor_total', $valorTotal);
            $result = $stmt->execute();
            if ($result) {
                $data['success'] = true;

                $idPedido = $pdo->lastInsertId();

                foreach ($produtos as $value) {
                    $qtda = $value->quantidade;
                    $obs = $value->observacao;
                    $idProduto = $value->id_produto;
                    $valor = $value->valor;

                    $sql = "INSERT INTO tb_pedido_produtos (id_pedido, id_produto, quantidade, valor, observacao) VALUES(:id_pedido, :id_produto, :quantidade, :valor, :observacao)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id_pedido', $idPedido);
                    $stmt->bindParam(':id_produto', $idProduto);
                    $stmt->bindParam(':quantidade', $qtda);
                    $stmt->bindParam(':valor', $valor);
                    $stmt->bindParam(':observacao', $obs);
                    $result = $stmt->execute();
                }
            } else {
                $errors['errosql'] = 'Erro ao gravar no banco de dados, tente novamente.';
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        } else if ($btn_name == 'Deletar') {

            $sql = "DELETE FROM tb_pedido_produtos WHERE id_pedido = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idPedido);

            $result = $stmt->execute();

            $sql = "DELETE FROM tb_pedidos WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idPedido);

            $result = $stmt->execute();

            $result = $stmt->execute();
            if ($result) {
                $data['success'] = true;
            } else {
                $errors['errosql'] = 'Erro ao deletar do banco de dados, tente novamente.';
                $data['success'] = false;
                $data['errors'] = $errors;
            }
        }
    }


    $result = $pdo->query("SELECT *, tb_pedidos.id AS 'id_pedido', DATE_FORMAT(data_hora, '%d/%m/%Y %H:%i:%s') AS 'data_hora_br' FROM tb_pedidos INNER JOIN tb_clientes ON tb_clientes.id = tb_pedidos.id_cliente");
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {

        $result2 = $pdo->query("SELECT pe.id_pedido, pe.id_produto, pe.quantidade, pe.valor, pe.observacao, pr.nome, pr.descricao, pr.foto FROM tb_pedido_produtos pe INNER JOIN tb_produtos pr ON pr.id = pe.id_produto WHERE id_pedido = $row->id_pedido");
        $produtos = null;
        while ($row2 = $result2->fetch(PDO::FETCH_OBJ)) {
            $produtos[] = array("id_produto" => $row2->id_produto, "quantidade" => $row2->quantidade, "valor" => $row2->valor, "observacao" => $row2->observacao, "nome_produto" => $row2->nome);
        }
        $pedidos[] = array("id_pedido" => $row->id_pedido, "id_cliente" => $row->id, "nome" => $row->nome, "email" => $row->email, "cep" => $row->cep, "rua" => $row->rua, "numero" => $row->numero, "bairro" => $row->bairro, "cidade" => $row->cidade, "uf" => $row->uf, "data_hora" => $row->data_hora_br, "valor_total" => $row->valor_total, "produtos" => $produtos);
    }
    $data['pedidos'] = $pedidos;


    echo json_encode($data);
} else {
    header('index.php');
}