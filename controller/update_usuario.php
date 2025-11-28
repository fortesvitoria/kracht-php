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

        $senhaSql = ""; 
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repita-senha']) {
                $novaSenha = sha1($_POST['senha']);
                $senhaSql = ", senha = '$novaSenha'";
            } else {
                $erros[] = "Senhas não conferem!";
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
            }
        }
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repita-senha']) {
                $senha = sha1($_POST['senha']);
            }
            if ($novaImagem) {
                $imagemFinal = $novaImagem;
            } else {
                $erros[] = "Erro ao fazer upload da imagem.";
            }
        }

        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email' AND id <> '$id'";
        $buscaEmail = mysqli_query($connect, $queryEmail);

        if (mysqli_num_rows($buscaEmail) > 0) {
            $erros[] = "Email já cadastrado por outro usuário!";
        }

        if (empty($erros)) {
            if (!empty($senha)) {
                $query = "UPDATE usuarios SET                     nome = '$nome', 
                      sobrenome = '$sobrenome', 
                      email = '$email', 
                      dt_nascimento = '$dt_nascimento', 
                      imagem = '$imagemFinal' 
                      $senhaSql 
                      WHERE id = $id";

                $execute = mysqli_query($connect, $query);
                
                $_SESSION['usuario'] = buscaUnica($connect, "usuarios", $id);

                if ($execute) {
                    if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] == $id) {
                        $_SESSION['usuario']['nome'] = $nome;
                        $_SESSION['usuario']['sobrenome'] = $sobrenome;
                        $_SESSION['usuario']['email'] = $email;
                        $_SESSION['usuario']['dt_nascimento'] = $dt_nascimento;
                        $_SESSION['usuario']['imagem'] = $imagemFinal;
                    }
                    echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href='admin.php';</script>";
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
}