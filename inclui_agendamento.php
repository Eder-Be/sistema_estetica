<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no cadastro.php */
$codCliente = isset ($_POST['codCliente']) ? $_POST['codCliente']: null;
$dataAg = isset ($_POST['dataAg']) ? $_POST['dataAg']: null;
$horario = isset ($_POST['horario']) ? $_POST['horario']: null;
$codProcedimento = isset ($_POST['codProcedimento']) ? $_POST['codProcedimento']: null;

/**Verifica se o usuário preencheu todas os campos do formulário */
if (empty($codCliente) || empty($dataAg) || empty($horario) || empty($codProcedimento) ) {
    echo "<script>alert('AGENDAMENTO NÃO REALIZADO! É necessário preencher todos os campos do cadastro!');</script>";
    echo "<script>window.location.href = 'agenda.php';</script>";
}

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$sql = "INSERT INTO agendamento(idcliente, idProcedimento, data_Ag, horario) VALUES (:codCliente,:codProcedimento,:dataAg, :horario)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codCliente',$codCliente);
$stmt->bindParam(':codProcedimento',$codProcedimento);
$stmt->bindParam(':dataAg',$dataAg);
$stmt->bindParam(':horario',$horario);
if ($stmt->execute()) {
    echo "<script>alert('Agendamento realizado com sucesso!');</script>";
    echo "<script>window.location.href = 'agenda.php';</script>";
        
}
else{
    echo "Ocorreu um erro de inclusão de registro";
    print_r($stmt->errorInfo());
}

?>
