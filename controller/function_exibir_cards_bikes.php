<?php 

require_once "conexao.php";
require_once '../../models/produto.php';


function exibirCardsBikes() {

    $conexao = new Conexao(); // Cria uma instância da conexão
    $produtoModel = new Produto($conexao); // Cria uma instância do modelo, passando a conexão

    $caminho_base_uploads = "../db/uploads/";
    // Chama o método para listar todos os produtos
    $produtos = $produtoModel->listarProdutos();
    // Ccaminho para a pasta de uploads (do ponto de vista do admin.php)
    $caminho = "../db/uploads/";
    
    // Verifica se o diretório existe
    if (!is_dir($caminho)) {
        echo "<p>Nenhuma imagem enviada ainda.</p>";
        return;
    }

    // Usa glob() para encontrar todos os arquivos de imagem permitidos
    $imagens = glob($caminho . "*.{jpg,jpeg,png}", GLOB_BRACE);

    if (empty($imagens)) {
        echo "<p>Nenhuma imagem encontrada na galeria.</p>";
    } else {
        // Adiciona um estilo simples para a galeria
       
        foreach ($produtos as $produto) {
            $link_produto = "#";
            $caminho_imagem_completo = $caminho_base_uploads . htmlspecialchars($produto['imagem']);
            $valor_formatado = 'R$ ' . number_format($produto['valor'], 2, ',', '.');   

            echo '<a href="' . $link_produto . '">';
            echo '<figure class="div-img-bike">';
            // $imagem já contém o caminho "uploads/nomearquivo.jpg"
            echo "<img class='img-bike' src='{$caminho_imagem_completo}' alt='Imagem do produto: " . htmlspecialchars($produto['nome']) . "'>";
            echo '<h3>' . htmlspecialchars($produto['nome']) . '</h3>';
            echo '<span class="secao-valor">';
            echo '<span>' . $valor_formatado . '</span>';
            echo '</span>';
            echo '</figure>';
            echo '</a>';
        }

    }
}

?>
