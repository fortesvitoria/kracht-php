<?php 

function inserirUsuarios($connect) {
    $erros = []; // Inicializa o array vazio

    if (isset($_POST['cadastrar'])) {

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_real_escape_string($connect, $_POST['sobrenome']);
        $senha = sha1($_POST['senha']);
        $dt_nascimento = $_POST['dt-nascimento'];
        
        // Lógica de imagem
        $imagem = !empty($_FILES['arquivo']['name']) ? $_FILES['arquivo']['name'] : NULL;
        if(!empty($imagem)) {
            $caminho = "../../db/uploads/";
            // Supondo que você tenha a função uploadImagens disponível aqui ou incluída
            // $imagem = uploadImagens($caminho); 
        }
        $is_admin = 0;
    
        if ($_POST['senha'] != $_POST['repita-senha']) {
            $erros[] = "Senhas não conferem!";
        }

        $queryEmail = "SELECT email FROM usuarios WHERE email = '$email'";
        $buscaEmail = mysqli_query($connect, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);

        if (!empty($verifica)) {
            $erros[] = "Email já cadastrado!";
        }

        // Se não houver erros, tenta cadastrar
        if (empty($erros)){
            $query = "INSERT INTO usuarios(nome, sobrenome, email, senha, dt_nascimento, imagem, is_admin) 
            VALUES ('$nome', '$sobrenome', '$email', '$senha', '$dt_nascimento', '$imagem', '$is_admin')";
            
            if (mysqli_query($connect, $query)) {
                echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = '/kracht-php/view/paginas/login_usuario.php';</script>";
                exit;
            } else {
                $erros[] = "Erro ao cadastrar no banco: " . mysqli_error($connect);
            }
        }
    }
    
    // AQUI ESTÁ O SEGREDO: Retorna o array de erros para quem chamou a função
    return $erros;
}
?>