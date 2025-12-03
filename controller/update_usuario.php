<?php
require_once "conexao.php";

function updateUsuario($connect)
{
    if (isset($_POST['atualizar'])) {

        // $erros = [];

        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_real_escape_string($connect, $_POST['sobrenome']);
        $dt_nascimento = $_POST['dt-nascimento'];

        $senhaSql = "";
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repita-senha']) {
                $novaSenha = sha1($_POST['senha']);
                $senhaSql = ", senha = '$novaSenha'";
            } else {
                $_SESSION['msg_temp'] = "<div class='msg-padrao msg-erro'>Senhas não conferem!</div>";
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }
        }

        $buscaAtual = mysqli_query($connect, "SELECT imagem FROM usuarios WHERE id = $id");
        $dadosAtuais = mysqli_fetch_assoc($buscaAtual);
        $imagemFinal = $dadosAtuais['imagem'];

        if (!empty($_FILES['arquivo']['name'])) {
            $caminho = "../../db/uploads/";
            $novaImagem = uploadImagens($caminho);

            if ($novaImagem) {
                $imagemFinal = $novaImagem;
            } else {
                $_SESSION['msg_temp'] = "<div class='msg-padrao msg-erro'>Erro ao fazer upload da imagem!</div>";
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }
        }

        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email' AND id <> '$id'";
        $buscaEmail = mysqli_query($connect, $queryEmail);

        if (mysqli_num_rows($buscaEmail) > 0) {
            $_SESSION['msg_temp'] = "<div class='msg-padrao msg-erro'>Email já cadastrado por outro usuário!</div>";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }

        if (!empty($erros)) {
            $_SESSION['msg_temp'] = "<div class='msg-padrao msg-erro'>" . implode("<br>", $erros) . "</div>";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
        $query = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', dt_nascimento = '$dt_nascimento', imagem = '$imagemFinal' $senhaSql WHERE id = $id";

        $execute = mysqli_query($connect, $query);

        if ($execute) {
            if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] == $id) {
                $_SESSION['usuario']['nome'] = $nome;
                $_SESSION['usuario']['sobrenome'] = $sobrenome;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['usuario']['dt_nascimento'] = $dt_nascimento;
                $_SESSION['usuario']['imagem'] = $imagemFinal;
            }

            $_SESSION['msg_temp'] = "<div class='msg-padrao msg-sucesso'>Dados atualizados com sucesso!</div>";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            $_SESSION['msg_temp'] = "<div class='msg-padrao msg-erro'>Erro no banco de dados.</div>";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
}
