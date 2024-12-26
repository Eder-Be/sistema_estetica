<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no altera_compromisso.php */
$idAgendamento = isset ($_POST['idAgendamento']) ? $_POST['idAgendamento']: null;
$idCliente = isset ($_POST['idCliente']) ? $_POST['idCliente']: null;
$data_Ag = isset ($_POST['data_Ag']) ? $_POST['data_Ag']: null;
$horario = isset ($_POST['horario']) ? $_POST['horario']: null;
$idProcedimento = isset ($_POST['idProcedimento']) ? $_POST['idProcedimento']: null;

/**Verifica se o usuário preencheu todas os campos do formulário */
if (empty($idCliente) || empty($data_Ag) || empty($horario) || empty($idProcedimento) ) {
    echo "<script>alert('ALTERAÇÃO NÃO REALIZADA! É necessário preencher todos os campos do cadastro!');</script>";
    exit;
}

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$stmt = $PDO->prepare("UPDATE agendamento SET idCliente=:idCliente, data_Ag=:data_Ag, horario=:horario, idProcedimento= :idProcedimento WHERE idAgendamento=:idAgendamento");
$stmt->bindParam(':idAgendamento',$idAgendamento, PDO::PARAM_INT);
$stmt->bindParam(':idProcedimento',$idProcedimento);
$stmt->bindParam(':idCliente',$idCliente);
$stmt->bindParam(':data_Ag',$data_Ag);
$stmt->bindParam(':horario',$horario);
if ($stmt->execute()) {
    echo "<script>alert('Agendamento alterado com sucesso!');</script>";
    echo "<script>window.location.href = 'agenda.php';</script>";
        
}
else{
    echo "Ocorreu um erro na alteração do agendamento";
    print_r($stmt->errorInfo());
}

?>