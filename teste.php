<?php

$user = "admin";
$pass = "admin123";
if (isset($_POST['logar'])) {
	if ( !empty($_POST['usuario']) and !empty($_POST['senha'])) {
		if ($_POST['usuario'] == "admin" and $_POST['senha'] == "admin123") {
			session_start();
			$_SESSION['usuario'] = $_POST['usuario'];
			$_SESSION['ativa'] = true;
			echo "<a href='admin.php'>Acessar</a>";
			//redireciona páginas
			header("location: admin.php");
		}else{
			echo "Usuário ou senha inválidos";
			echo "<a href='login.php'>Voltar</a>";
		}
	}
} 



    $tipoUsuario = $_POST['tipoAcesso'];
    if ($tipoUsuario === "usuario") {
        $usuario = new Usuario(); // Cria um objeto Usuario
        $login = $usuario->autenticarLogin($email, $senha, $connect); // Chama o método autenticarLogin

        if ($login === true) {
            header("Location: ../view/index.html");
            exit(); // Encerra o script após o redirecionamento
        } else {
            // Exibe um pop-up informando o erro de login e redireciona de volta para a página de login
            echo "<script>alert('$login');</script>";
            echo "<script>window.location.href = '../view/paginas/login.html';</script>";
            exit(); // Encerra o script após o redirecionamento
        }
    } elseif ($tipoUsuario === "petsitter") {
        $petsitter = new Petsitter(); // Cria um objeto petsitter
        $login = $petsitter->autenticarLogin($email, $senha, $connect); // Chama o método autenticarLogin

        if ($login === true) {
            session_start(); // Inicia a sessão
            $_SESSION['emailLogado'] = $email;
            // Redireciona para a página adequada para o usuário
            header("Location: ../view/index.html");
            exit(); // Encerra o script após o redirecionamento
        } else {
            // Exibe um pop-up informando o erro de login e redireciona de volta para a página de login
            echo "<script>alert('$login');</script>";
            echo "<script>window.location.href = '../view/paginas/login.html';</script>";
            exit(); // Encerra o script após o redirecionamento
        }
    }

