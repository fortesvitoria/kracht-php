<?php
session_start(); // Inicia a sessão
include("conexao.php");
require_once("../models/usuario.php");

function login($connect)
{
    if (isset($_POST['enviar'])) {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        if (!empty($email) && !empty($senha)) {

            #cria uma instancia de usuario
            $user = new Usuario();

            #chama a função de login passando a conexão que veio do conexao.php
            $resultado = $user->autenticarLogin($email, $senha, $connect);

            if ($resultado === true) {
                $_SESSION['ativa'] = TRUE;
                #se is_admin for = 1, redireciona pagina admin, caso contrario para pagina do usuario
                if ($_SESSION['usuario']['is_admin'] && $_SESSION['usuario']['is_admin'] == 1) {
                    header("Location: ../view/paginas/admin.php");
                } else {
                    header("Location: ../view/paginas/usuario.php");
                }
                exit;
            } else {
                $_SESSION['msg_login'] = "<p class='erro'>Usuário ou senha inválidos.</p>";
                header("Location: ../view/paginas/login_usuario.php");
                exit;
            }
        }
    }
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("location: ../view/paginas/login_usuario.php");
}

login($connect);
