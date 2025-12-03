<?php
require_once "conexao.php";

function deletar($connect, $tabela, $id)
{
    if (!empty($id)) {
        $query = "DELETE FROM $tabela WHERE id =" . (int)$id;
        $execute = mysqli_query($connect, $query);

        if ($tabela == 'produtos') {
            $sessao = 'msg_produto';
        } else {
            $sessao = 'msg_temp';
        }

        if ($execute) {
            $_SESSION[$sessao] = "<div class='msg-sucesso'>Dados deletados com sucesso!</div>";

            if ($tabela == 'usuarios' && isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] == $id) {
                session_destroy();
                header("Location: login_usuario.php");
                exit;
            }
            else {
                header("Location: admin.php");
                exit;
            }
        } else {
            $_SESSION[$sessao] = "<div class='msg-erro'>Erro ao deletar!</div>";
            exit;
        }
    }
}
