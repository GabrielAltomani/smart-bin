<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connection.php';

// Verifique se a solicitação é uma solicitação POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receba os dados JSON do corpo da solicitação
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    error_log(json_encode($_POST));
    // Verifique se o campo 'contador' está presente no JSON recebido
    if (isset($data['contador'])) {
        // Receba o contador do corpo da solicitação JSON
        $contador = $data['contador'];
        $idUsuario = isset($data['idUsuario']) ? $data['idUsuario'] : null;

        
        // Execute uma consulta SQL para atualizar a quantidade na tabela tb_lixeira
        $updateSql = "UPDATE tb_lixeira SET quantidade = (:contador) WHERE id_lixeira = '1'";
        // Por exemplo, inserir o ID do usuário na tabela tb_lixo_descarte
        $insertSql = "INSERT INTO tb_lixo_descarte (cod_usuario, data_hora) VALUES (:idUsuario, current_timestamp())";
    
        try {
            $pdo->beginTransaction();

            // Atualize a tabela tb_lixeira
            $stmtUpdate = $pdo->prepare($updateSql);
            $stmtUpdate->bindParam(':contador', $contador, PDO::PARAM_INT);
            $stmtUpdate->execute();

            // Insira na tabela tb_lixo_descarte
            $stmtInsert = $pdo->prepare($insertSql);
            $stmtInsert->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmtInsert->execute();

            // Commit das transações
            $pdo->commit();

            echo json_encode(array('mensagem' => 'Dados inseridos com sucesso.'));
        } catch(PDOException $e) {
            // Se ocorrer um erro, reverta as transações
            $pdo->rollBack();
            echo json_encode(array('erro' => 'Erro ao inserir dados: ' . $e->getMessage()));
        }
    } else {
        echo json_encode(array('erro' => 'Campo "contador" não foi enviado no JSON.'));
    }
} else {
    echo json_encode(array('erro' => 'Método de solicitação não suportado.'));
}
?>
