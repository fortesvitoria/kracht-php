<?php 

function inserirProdutos($connect) {
    if (isset($_POST['cadastrar'])) {

        $erros = [];

        $nome = mysqli_real_escape_string($connect, $_POST['nome']);
        $marca = mysqli_real_escape_string($connect,$_POST['marca']);
        $tipo = mysqli_real_escape_string($connect,$_POST['tipo']);
        $valor = mysqli_real_escape_string($connect,$_POST['valor']);
        $imagem = !empty($_FILES['arquivo']['name']) ? $_FILES['arquivo']['name'] : NULL;
        if(!empty($imagem)) {
            $caminho = "../../db/uploads/";
            $imagem = uploadImagens($caminho);
        }

        if (empty($erros)){
            //iserir usuario no banco
            $query = "INSERT INTO produtos(nome, marca, tipo, valor, imagem) 
            VALUES ('$nome', '$marca', '$tipo', '$valor', '$imagem')";
            if (mysqli_query($connect, $query)) {
                header("Location: /kracht-php/view/paginas/admin.php"); 
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