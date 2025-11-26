<!-- BLOCO PRODUTOS CADASTRADOS -->
<div class="bloco">
    <h3>Produtos cadastrados: </h3>
    <div class="tabela">
        <?php
        $tabela = "produtos";
        $order = "nome";
        $produtos = buscaTodosDados($connect, $tabela, 1, $order);
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Nome:</th>
                    <th>Marca:</th>
                    <th>Tipo:</th>
                    <th>Valor:</th>
                    <th>Imagem:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produtos as $produto) {
                ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['marca']; ?></td>
                        <td><?php echo $produto['tipo']; ?></td>
                        <td><?php echo $produto['valor']; ?></td>
                        <td><?php echo $produto['imagem']; ?></td>
                    </tr>
                <?php
                };
                ?>
            </tbody>
        </table>
    </div>
</div>
