<?php
session_start(); // Inicia a sessão
include("conexao.php");
require_once("../models/usuario.php");

$email = $_POST["email"];
$senha = $_POST["senha"];


if (isset($_POST['enviar'])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (!empty($email) && !empty($senha)) {

        #cria uma instancia de usuario
        $user = new Usuario();

        #chama a função de login passando a conexão que veio do conexao.php
        $resultado = $user->autenticarLogin($email, $senha, $connect);

        if ($resultado === true) {
            #se is_admin for = 1, redireciona pagina admin, caso contrario para pagina do usuario
            if ($_SESSION['usuario']['is_admin'] && $_SESSION['usuario']['is_admin'] == 1) {
                header("Location: ../view/paginas/admin.php");
            } else {
                header("Location: ../view/paginas/user.php");
            }
            exit;
        } else {
            echo "Usuário ou senha inválidos";
            echo "<a href='login.php'>Voltar</a>";
        }
    }
}
