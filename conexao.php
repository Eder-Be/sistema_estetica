<?php
/* O código abaixo faz a conexão com o MYSQL atravé de PDO **/

function conecta_bd() {
    try {
        $PDO = new PDO('mysql:host=localhost;dbname=pati_estetica;charset=utf8', 'root', 'root');
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $PDO;
    } catch (PDOException $e) {
        echo 'ERRO de Conexão Patrícia Estética: ' . $e->getMessage();
        exit;
    }
}
?>