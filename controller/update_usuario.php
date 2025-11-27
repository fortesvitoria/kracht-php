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
        $senha = "";
        $dt_nascimento = $_POST['dt-nascimento'];
        $imagem = !empty($_FILES['arquivo']['name']) ? $_FILES['arquivo']['name'] : NULL;
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
                $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', senha = '$senha', dt_nascimento = '$dt_nascimento', imagem = '$imagem' WHERE id = $id";
            } else {
                $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', dt_nascimento = '$dt_nascimento', imagem = '$imagem' WHERE id = $id";
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
