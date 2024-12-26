<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no cadastro.php */
$procedimento = isset ($_POST['procedimento']) ? $_POST['procedimento']: null;


/**Verifica se o usuário preencheu todas os campos do formulário */
if (empty($procedimento)) {
    echo "<script>alert('PROCEDIMENTO NÃO CADASTRADO! É necessário preencher todos os campos do cadastro!');</script>";
    echo "<script>window.location.href = 'cadastro_proced.php';</script>";
}

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$sql = "INSERT INTO procedimento(procedimento) VALUES (:procedimento)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':procedimento',$procedimento);
if ($stmt->execute()) {
    echo "<script>alert('Procedimento cadastrado com sucesso!');</script>";
    echo "<script>window.location.href = 'procedimentos.php';</script>";
        
}
else{
    echo "Ocorreu um erro de inclusão de registro";
    print_r($stmt->errorInfo());
}

?>
