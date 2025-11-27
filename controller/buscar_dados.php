<?php
require_once "conexao.php";
#busca no bd apenas um resultado
function buscaUnica($connect, $tabela, $id)
{
    $query = "SELECT * FROM $tabela WHERE id =" . (int) $id;
    $execute = mysqli_query($connect, $query);
    $result = mysqli_fetch_assoc($execute);

    return $result;
}


# busca no bd apenas todos com base no id
function buscaTodosDados($connect, $tabela, $where = 1, $order = "")
{
    if (!empty($order)) {
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($connect, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);

    return $results;
}
