<?php
include("../../models/produto.php");
include("conexao.php");     
include("cadastrar_produto.php");

function uploadImages()
{
    if (isset($_POST['enviarProduto'])) {
        
        // Verifica se algum arquivo foi enviado
        if (!empty($_FILES['arquivo']['name'][0])) {

            // Pega dados do produto do formulário
            $nome = $_POST['nome-produto'];
            $marca = $_POST['marca-produto'];
            $tipo = $_POST['tipo-produto'];
            $valor = $_POST['valor'];

            // Caminhos:
            $caminho_uploads_disco = "../db/uploads/"; // Para o PHP salvar o arquivo no disco
            $caminho_url_publico = "../../db/uploads/"; // Caminho para o banco (usado pelo navegador no SRC)
            
            // Pega o número total de arquivos enviados (IMPORTANTE!)
            $totalArquivos = count($_FILES['arquivo']['name']);
            $erros = array();
            $caminhos_salvos = array(); 
            $primeira_imagem_salva = null;

            // Itera sobre todos os arquivos
            for ($i = 0; $i < $totalArquivos; $i++) {
                // Recupera os dados do arquivo atual
                $nomeArquivo = $_FILES['arquivo']['name'][$i];
                $tipo = $_FILES['arquivo']['type'][$i];
                $tamanho = $_FILES['arquivo']['size'][$i];
                $tempName = $_FILES['arquivo']['tmp_name'][$i];
                
                $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                
                // limite de tamanho - até 5mb
                $tamanhoMaximo = 1024 * 1024 * 5;
                if ($tamanho > $tamanhoMaximo) {
                    $erros[] = "O arquivo '{$nomeArquivo}' excede o tamanho máximo (5MB).";
                    continue; 
                }

                // extensoes e tipos permitidos
                $arquivosPermitidos = ["png", "jpg", "jpeg"];
                $tiposPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                
                if (!in_array($extensao, $arquivosPermitidos) || !in_array($tipo, $tiposPermitidos)) {
                    $erros[] = "O arquivo '{$nomeArquivo}' não tem uma extensão/tipo permitido.";
                    continue; 
                }
                
                $novoNome = uniqid() . "." . $extensao;
                $destino_disco = $caminho_uploads_disco . $novoNome;

               
                if (move_uploaded_file($tempName, $destino_disco)) {
                    $caminho_para_db = $caminho_url_publico . $novoNome;
                    $caminhos_salvos[] = $caminho_para_db;

                    // Salva a primeira imagem para o campo 'imagem' da tabela 'produto'
                    if ($primeira_imagem_salva === null) {
                        $primeira_imagem_salva = $caminho_para_db;
                }
                    
                } else {
                    $erros[] = "Erro ao enviar o arquivo '{$nomeArquivo}'. Verifique as permissões da pasta 'uploads'.";
                }
            }

            if (!empty($primeira_imagem_salva)) {
            global $connect; 
            
            $produto = new Produto(null, $nome, $marca, $tipo, $valor, $primeira_imagem_salva);
            $resultado = insertData($connect, $produto);
            
            if ($resultado === true) {
                $total_sucesso = count($caminhos_salvos);
                header("Location: ../view/paginas/admin.php?upload=sucesso&total={$total_sucesso}");
                exit();
            } else {
                $erros[] = "Erro ao salvar os dados do produto no banco de dados: " . $resultado;
            }
        }
            
            
        } 
        // Se houver erros, redireciona com a mensagem de erro
        $mensagem = "Foram salvos " . count($caminhos_salvos) . " de {$totalArquivos} arquivos. Erros: " . implode(" | ", $erros);
        header("Location: ../view/paginas/admin.php?upload=parcial&msg=" . urlencode($mensagem));
        exit();

    }

}

uploadImages();
?>