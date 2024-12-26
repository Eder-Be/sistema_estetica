<?php
require_once 'conexao.php';
/** Armazena o código do agendamento a ser excluído */
$idAgendamento = isset($_GET['idAgendamento']) ? $_GET['idAgendamento']: null;
if (empty($idAgendamento)) {
    echo "o Código do cliente para exclusão não foi definido";
    exit;
}

/**Faz a exclusão do registro do cliente na tabela de clientes */
$PDO = conecta_bd();
$sql = "DELETE FROM agendamento WHERE idAgendamento = :idAgendamento";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':idAgendamento', $idAgendamento, PDO::PARAM_INT);
if ($stmt->execute()) {
    header('Location: agenda.php');
}
else {
    echo"Ocorreu um erro ao excluir o cadastro do cliente";
    print_r($stmt->errorInfo());
}
    
    
?>