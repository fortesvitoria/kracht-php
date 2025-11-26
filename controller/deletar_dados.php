<?php
require_once "conexao.php";


function deletar($connect, $tabela, $id)
{
    if (!empty($id)) {
        $query = "DELETE FROM $tabela WHERE id =" . (int)$id;
        $execute = mysqli_query($connect, $query);
        if ($execute) {
            echo "Dado deletado com sucesso!";
        } else {
            echo "Erro ao deletar.";
        }

    }
}
