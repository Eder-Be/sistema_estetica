<?php
require_once 'conexao.php';
/** Coleta as informações digitadas no lista_fatura.php */
$idCliente = isset ($_POST['idCliente']) ? $_POST['idCliente']: null;

/**Insere as informações na tabela cliente do banco de dados pati_estetica */
$PDO = conecta_bd();
$stmt = $PDO->prepare("SELECT nome, DATE_FORMAT(dataPag,'%d/%m/%Y') AS data_formato,  FORMAT(valor, 2, 'de_DE') AS valor_formato FROM cliente INNER JOIN faturamento ON cliente.idCliente = faturamento.idCliente WHERE faturamento.idCliente = :idCliente ORDER BY dataPag");
$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Lista de Clientes</title>

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

p { font-size: 20px}


table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;      
}

th {
    background-color: #007BFF;
    color: white;
}

td {
    padding: 12px;
    border: 1px solid #ddd;
}

thead {
    background-color: #f4f4f4;
}

tr:hover {
    background-color: #f1f1f1;
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
            <?php
            if ($resultado && count($resultado) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $linha): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($linha['data_formato']); ?></td>
                            <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                            <td><?php echo htmlspecialchars($linha['valor_formato']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum resultado encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>


   