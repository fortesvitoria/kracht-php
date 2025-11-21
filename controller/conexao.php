<?php

# Configuração do banco
$server = "localhost";
$userDb = "root";
$passDb = "";
$nameDb = "db_kracht";

# Conexão do banco
$connect = mysqli_connect($server, $userDb, $passDb, $nameDb);

//testa se conexão funcionou
    if(!$connect) {
        echo "<br>NÃO CONECTOU NO BANCO DE DADOS :(<br>".mysqli_connect_error();
    } else {
        // echo "<br>CONECTOU :)<br>";
    }

?>