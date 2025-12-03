<?php
require_once "conexao.php";

function updateProduto($connect)
{
    if (isset($_POST['atualizar-produto'])) {

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $marca = mysqli_real_escape_string($connect, $_POST['marca']);
        $tipo = mysqli_real_escape_string($connect, $_POST['tipo']);
        $valor = filter_input(INPUT_POST, "valor", FILTER_VALIDATE_FLOAT);

        #busca imagem atual no banco
        $queryBusca = "SELECT imagem FROM produtos WHERE id = '$id'";
        $resultadoBusca = mysqli_query($connect, $queryBusca);
        $produtoAtual = mysqli_fetch_assoc($resultadoBusca);

        $imagemFinal = $produtoAtual['imagem'];

        if (!empty($_FILES['arquivo']['name'])) {
            $caminho = "../../db/uploads/";
            $novaImagem = uploadImagens($caminho);

            if ($novaImagem) {
                $imagemFinal = $novaImagem;
            }
        }

        $query = "UPDATE produtos SET nome = '$nome', marca = '$marca', tipo = '$tipo', valor = '$valor', imagem = '$imagemFinal' WHERE id = $id";

        $execute = mysqli_query($connect, $query);

        if ($execute) {
            $_SESSION['msg_temp'] = "<div class='msg-sucesso'>Produto atualizado com sucesso!</div>";
            header("Location: admin.php");
            exit;
        } else {
            $_SESSION['msg_temp'] = "<div class='msg-erro'>Erro ao atualizar produto!</div>";
            header("Location: admin.php");
            exit;
        }
    }
}
