<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no cadastro.php */
$codCliente = isset ($_POST['codCliente']) ? $_POST['codCliente']: null;
$dataPag = isset ($_POST['dataPag']) ? $_POST['dataPag']: null;
$valor = isset ($_POST['valor']) ? $_POST['valor']: null;

/**Verifica se o usuário preencheu todas os campos do formulário */
if (empty($codCliente) || empty($dataPag) || empty($valor)) {
    echo "<script>alert('REGISTRO DE FATURAMENTO NÃO REALIZADO! É necessário preencher todos os campos do cadastro!');</script>";
    echo "<script>window.location.href = 'todos_fat.php';</script>";
}

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$sql = "INSERT INTO faturamento(idCliente, dataPag, valor) VALUES (:codCliente,:dataPag, REPLACE(:valor, ',','.'))";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codCliente',$codCliente);
$stmt->bindParam(':dataPag',$dataPag);
$stmt->bindParam(':valor',$valor);
if ($stmt->execute()) {
    echo "<script>alert('Registro realizado com sucesso!');</script>";
    echo "<script>window.location.href = 'todos_fat.php';</script>";
        
}
else{
    echo "Ocorreu um erro de inclusão de registro";
    print_r($stmt->errorInfo());
}

?>
