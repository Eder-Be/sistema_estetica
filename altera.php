<?php
require_once 'conexao.php';
/** Armazena o código do cliente a ser alterado */
$idCliente = isset($_GET['idCliente']) ? (int) $_GET['idCliente']: null;
if (empty($idCliente)) {
    echo "o Código do cliente para alteração não foi definido";
    exit;
}

/** Busca na tabela os dados do cliente que deverá ser alterado */
$PDO = conecta_bd();
$stmt = $PDO->prepare("SELECT idCliente, nome, telefone FROM cliente WHERE idCliente = :idCliente");
$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
/** Se o Fetch acima não retornar um array conhecido, o código do cliente não existe na tabela */
if (!is_array($resultado)) {
    echo "Nenhum cliente encontrado com o código informado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Patricia Becker Estética</title>


   
</head>
<style>

body {
      margin: 0px;
      background-color: #F5F5F5          
}  

.container {display: flex;
margin: 0px;
gap: 150px;
}


</style>    
<body>
<a href="index.php"><img src="LogoPatiEst.png" class="img-fluid" alt="Patricia Logo" width="20%" ></a>
<br><br><br>
                                
      
    <div class = "container">
        <div class = "box box1">
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Clientes</button>
                    <ul class="dropdown-menu">
                        <li><a href="cadastro.php"><button class="dropdown-item" type="button">Cadastro</button></a></li>
                        <li><a href="lista_cliente.php"><button class="dropdown-item" type="button">Pesquisa</button></a></li>
                    </ul>
            </div>
            <br>          
               
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Agendamentos</button>
                    <ul class="dropdown-menu">
                        <li><a href="agendamento.php"><button class="dropdown-item" type="button">Novo agendamento</button></a></li>
                        <li><a href="agenda.php"><button class="dropdown-item" type="button">Agenda</button></a></li>
                    </ul>
            </div>
            <br>            
                
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Procedimentos</button>
                    <ul class="dropdown-menu">
                       <li><a href="procedimentos.php"><button class="dropdown-item" type="button">Todos</button></a></li>
                        <li><a href="cadastro_proced.php"><button class="dropdown-item" type="button">Cadastrar procedimento</button></a></li>
                    </ul>
            </div>   
            <br>           
              
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Faturamento</button>
                    <ul class="dropdown-menu">
                        <li><a href="nova_fatura.php"><button class="dropdown-item" type="button">Novo</button></a></li>
                        <li><a href="lista_fatura.php"><button class="dropdown-item" type="button">Pesquisa</button></a></li>
                    </ul>
             </div>
        </div>

        <div class = "box box2"> 


<!doctype html>
<html>
    <head>
        <meta charset ="utg-8">
        <title>Cadastro de cliente</title>
    </head>

    <body>
        <h2> Cadastro de Cliente - Alteração</h2>
        <form action = "inclui_altera.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?=$resultado['nome']?>"><br><br>
            <label for="telefone">Telefone:</label>            
            <input type="text" name="telefone" id="telefone" value="<?=$resultado['telefone']?>"><br><br>
            <input type="hidden" name="idCliente" value="<?=$idCliente?>">
            <input type="submit" value="Alterar">
        </form>
    </body>
</html>
