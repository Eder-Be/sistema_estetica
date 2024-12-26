<?php
require_once 'conexao.php';
/** Armazena o código do agendamento a ser alterado */
$idAgendamento = isset($_GET['idAgendamento']) ? (int) $_GET['idAgendamento']: null;
if (empty($idAgendamento)) {
    echo "o Código do agendamento para alteração não foi definido";
    exit;
}

/** Busca na tabela os dados do cliente que deverá ser alterado */
$PDO = conecta_bd();
$stmt = $PDO->prepare("SELECT idAgendamento, idProcedimento, idCliente, data_Ag, horario FROM agendamento WHERE idAgendamento = :idAgendamento");
$stmt->bindParam(':idAgendamento', $idAgendamento, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
/** Se o Fetch acima não retornar um array conhecido, o código do cliente não existe na tabela */
if (!is_array($resultado)) {
    echo "Nenhum agendamento encontrado com o código informado";
    exit;
}
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

    <title>Alteração Agendamento</title>
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
      <h2> Alteração de Agendamento</h2>
        <form action = "inclui_altera_compromisso.php" method="post">
            <label for="idCliente">Código do Cliente:</label>
            <input type="int" name = "idCliente" id = "idCliente" value="<?=$resultado['idCliente']?>"><br><br>
            <label for="data_Ag">Data:</label>
            <input type="date" name = "data_Ag" id = "data_Ag" value="<?=$resultado['data_Ag']?>"> <br><br>
            <label for="horario">Horário:</label>
            <input type="time" name = "horario" id = "horario" value="<?=$resultado['horario']?>"> <br><br>
            <label for="codProcedimento">Código do Procedimento:</label>
            <input type="int" name = "idProcedimento" id = "idProcedimento" value="<?=$resultado['idProcedimento']?>"> <br><br> 
            <input type="hidden" name = "idAgendamento"  value="<?=$idAgendamento?>">         
            <input type="submit" value = "Alterar" class="btn btn-secondary">            
         </form>  
    </div> 

</body>
</html>