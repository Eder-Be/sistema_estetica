<?php
require_once 'conexao.php';
/** Armazena o código do cliente a ser excluído */
$idCliente = isset($_GET['idCliente']) ? $_GET['idCliente']: null;
if (empty($idCliente)) {
    echo "o Código do cliente para exclusão não foi definido";
    exit;
}

/**Faz a exclusão do registro do cliente na tabela de clientes */
$PDO = conecta_bd();
$sql = "DELETE FROM cliente WHERE idCliente = :idCliente";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
if ($stmt->execute()) {
    header('Location: todos_clientes.php');
}
else {
    echo"Ocorreu um erro ao excluir o cadastro do cliente";
    print_r($stmt->errorInfo());
}
    
    
?>
