<?php
require_once 'conexao.php';
$PDO = conecta_bd();
    $stmt_count = $PDO->prepare("SELECT COUNT(*) AS total FROM cliente");
    $stmt_count->execute();
    $total = $stmt_count->fetchColumn();
    $stmt = $PDO->prepare("SELECT idCliente, nome, telefone  FROM cliente");
    $stmt->execute();
        
    ?>
    
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Clientes</title>
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
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        h1 {
            text-align: center;
        }
    </style>

</head>

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
        <h1>Clientes<h1>
        <h2>Total de clientes cadastrados:<?php echo $total ?><h2>    
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $resultado['idCliente']?></td>    
                    <td><?php echo $resultado['nome']?></td>
                    <td><?php echo $resultado['telefone']?></td>
                    <td>
                        <a href="altera.php?idCliente=<?php echo $resultado['idCliente'] ?>" >Alterar </a>/
                        <a href="exclui.php?idCliente=<?php echo $resultado['idCliente'] ?>" onclick= "return confirm ('Tem certeza de que deseja excluir o registro ?');">Excluir </a>
                    </td>
                </tr>
                <?php endwhile?>
            </tbody>
        </table>
    </div>
    
</body>

</html>