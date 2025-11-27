<?php
require_once "conexao.php";

function updateUsuario($connect)
{
    if (isset($_POST['atualizar'])) {

        $erros = [];

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_real_escape_string($connect, $_POST['sobrenome']);
        $dt_nascimento = $_POST['dt-nascimento'];

        $senha = ""; 
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repita-senha']) {
                $novaSenha = sha1($_POST['senha']);
                $senha = ", senha = '$novaSenha'";
            } else {
                $erros[] = "Senhas não conferem!";
            }
        }

        
        if (!empty($imagem)) {
            $caminho = "../../db/uploads/";
            $imagem = uploadImagens($caminho);
        }
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repita-senha']) {
                $senha = sha1($_POST['senha']);
            } else {
                $erros[] = "Senhas não conferem!";
            }
        }

        $queryBusca = "SELECT imagem FROM usuarios WHERE id = '$id'";
        $res = mysqli_query($connect, $queryBusca);
        $dadosAtuais = mysqli_fetch_assoc($res);
        $imagemFinal = $dadosAtuais['imagem'];

        if (!empty($_FILES['arquivo']['name'])) {
            $caminho = "../../db/uploads/";
            $novaImagem = uploadImagens($caminho);
            if ($novaImagem) {
                $imagemFinal = $novaImagem;
            }
        }

        $queryEmailAtual = "SELECT email FROM usuarios WHERE id = '$id'";

        $buscaEmailAtual = mysqli_query($connect, $queryEmailAtual);

        $returnEmail = mysqli_fetch_assoc($buscaEmailAtual);
        $returnEmail['email'];

        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email' AND email <> '" . $returnEmail['email'] . "'";

        $buscaEmail = mysqli_query($connect, $queryEmail);

        $verifica = mysqli_num_rows($buscaEmail);

        if (!empty($verifica)) {
            $erros[] = "Email já cadastrado!";
        }

        if (empty($erros)) {
            if (!empty($senha)) {
                $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', senha = '$senha', dt_nascimento = '$dt_nascimento', imagem = '$imagemFinal' WHERE id = $id";
            } else {
                $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', dt_nascimento = '$dt_nascimento', imagem = '$imagemFinal' WHERE id = $id";
            }

            $execute = mysqli_query($connect, $query);

            if ($execute) {
                echo "Usuário atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar usuário";
            }
        } else {
            foreach ($erros as $erro) {
                echo "<p> $erro </p>";
            }
        }
    }
}
