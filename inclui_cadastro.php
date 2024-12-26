<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no cadastro.php */
$nome = isset ($_POST['nome']) ? $_POST['nome']: null;
$telefone = isset ($_POST['telefone']) ? $_POST['telefone']: null;

/**Verifica se o usuário preencheu todas os campos do formulário */
if (empty($nome) || empty($telefone)) {
    echo "<script>alert('CADASTRO NÃO REALIZADO! É necessário preencher todos os campos do cadastro!');</script>";
    echo "<script>window.location.href = 'cadastro.php';</script>";
}

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$sql = "INSERT INTO cliente(nome,telefone) VALUES (:nome,:telefone)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome',$nome);
$stmt->bindParam(':telefone',$telefone);
if ($stmt->execute()) {
    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    echo "<script>window.location.href = 'cadastro.php';</script>";
        
}
else{
    echo "Ocorreu um erro de inclusão de registro";
    print_r($stmt->errorInfo());
}

?>
