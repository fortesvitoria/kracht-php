<?php 

function inserirUsuarios($connect) {
    if (isset($_POST['cadastrar-usuario'])) {

        $erros = [];

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_real_escape_string($connect, $_POST['sobrenome']);
        $senha = sha1($_POST['senha']);
        $dt_nascimento = $_POST['dt-nascimento'];
        $imagem = null;
        $is_admin = 0;
        
        if ($_POST['senha'] != $_POST['repita-senha']) {
            $erros[] = "Senhas não conferem!";
        }

        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email'";

        $buscaEmail = mysqli_query($connect,$queryEmail);

        $verifica = mysqli_num_rows($buscaEmail);

        if (!empty($verifica)) {
            $erros[] = "Email já cadastrado!";
        }

        if (empty($erros)){
            //iserir usuario no banco
            $query = "INSERT INTO usuarios(nome, sobrenome, email, senha, dt_nascimento, imagem, is_admin) 
            VALUES ('$nome', '$sobrenome', '$email', '$senha', '$dt_nascimento', NULL, '$is_admin')";
            if (mysqli_query($connect, $query)) {
                header("Location: /kracht-php/view/paginas/login_usuario.php");
                exit;
            } else {
                echo "Erro ao cadastrar: " . mysqli_error($connect);
            }
        } else {
            foreach($erros as $erro) {
                echo "<p> $erro </p>";
            }
        }
    }
}

?>