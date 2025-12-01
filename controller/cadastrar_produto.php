<?php 

# Inserir dados
function insertData($connect, $produto){
	$nome = $produto->getNome();
    $marca = $produto->getMarca();
    $tipo = $produto->getTipo();
    $valor = $produto->getValor();
    $imagem = $produto->getImagem();

    $sql = "INSERT INTO produto (nome, marca, tipo, valor, imagem) VALUES 
    ('$nome', '$marca', '$tipo', '$valor', '$imagem')";
    
    $execute = mysqli_query($connect, $sql);

    if ($execute) {
        return true;
    } else {
        return mysqli_error($connect);
    }

}