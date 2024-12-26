<?php
require_once 'conexao.php';

/**Coleta as informações alimentadas no formulário de altera.php */
$idCliente = isset ($_POST['idCliente']) ? $_POST['idCliente'] : null;
$nome = isset ($_POST['nome']) ? $_POST['nome'] : null;
$telefone = isset ($_POST['telefone']) ? $_POST['telefone'] : null;

/** Verifica se todos os campos do formulário estão preenchidos */
if (empty($nome) || empty($telefone)) {
    echo "É preciso preencher todos os campos do formulário de cadastro";
    exit;
}

/**Altera as informações na tabela do banco de dados */

$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE cliente SET nome=:nome, telefone=:telefone WHERE idCliente =:idCliente");
$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':telefone', $telefone);
if ($stmt->execute()) {
    header('Location:todos_clientes.php');
}
else {
    echo "ocorreu um erro na alteração do cadastro";
    print_r($stmt->errorInfo());
}
?>