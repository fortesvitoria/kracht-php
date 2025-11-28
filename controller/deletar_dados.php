<?php
require_once "conexao.php";


function deletar($connect, $tabela, $id)
{
    if (!empty($id)) {
        $query = "DELETE FROM $tabela WHERE id =" . (int)$id;
        $execute = mysqli_query($connect, $query);
        if ($execute) {
            echo "<script>alert(Dado deletado com sucesso!)</script>";
        } else {
            echo "Erro ao deletar.";
        }

    }
}
