<?php
session_start();
include("../../controller/conexao.php");
include("../../controller/inserir_produtos.php");
include("../../controller/upload.php");
include("../../controller/buscar_dados.php");
include("../../controller/deletar_dados.php");
include("../../controller/update_usuario.php");
include("../../controller/update_produto.php");

inserirProdutos($connect);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kracht - Admin</title>
    <!-- css geral - header, footer, estilos e cores base -->
    <link rel="stylesheet" href="../src/css/style.css">
    <!-- css especifico da página admin.html -->
    <link rel="stylesheet" href="../src/CSS/admin.css">
    <!-- icone da aba -->
    <link rel="shortcut icon" href="../src/img/kracht-icone.png" type="image/x-icon">
</head>

<body>
    <div class="div-principal">

        <!-- INICIO CABECALHO -->
        <header>
            <nav class="nav">
                <!-- MENU DROPDOWN TELAS MENORES -->
                <div class="dropdown">
                    <button id="meuBotao" class="botao-dropdown"><img class="icone" src="../src/img/icone-menu.svg"
                            alt="icone com tres barras laranja representando um menu"></button>
                    <div id="meuDropdown" class="conteudo-dropdown">
                        <!-- LINKS -->
                        <ul class="links-nav-mobile">
                            <li class="link-li"><a href="#">Bicicletas</a></li>
                            <li class="link-li"><a href="#">Roupas</a></li>
                            <li class="link-li"><a href="#">Acessórios</a></li>
                            <li class="link-li"><a href="#">Sobre Nós</a></li>
                            <li class="link-li"><a href="#">Contato</a></li>
                        </ul>

                        <div class="logo-link">
                            <a class="logo" href="../../controller/logout.php">
                                <ion-icon class="icone-link" name="log-out-outline"></ion-icon>Sair
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MENU TELAS GRANDES -->
                <div class="links-nav-desktop logo-link">
                    <a class="logo" href="../../controller/logout.php">
                        <ion-icon class="icone-link" name="log-out-outline"></ion-icon>Sair
                    </a>
                </div>

                <ul class="links-nav-desktop">
                    <li class="link-li"><a href="#">Bicicletas</a></li>
                    <li class="link-li"><a href="#">Roupas</a></li>
                    <li class="link-li"><a href="#">Acessórios</a></li>
                    <li class="link-li"><a href="#">Sobre Nós</a></li>
                    <li class="link-li"><a href="#">Contato</a></li>
                </ul>
                <!-- LOGO -->
                <div class="">
                    <a href="../index.php" class="logo"><img src="../src/img/kracht-icone.png"
                            alt="icone de um homem pedalando com o fundo laranja" class="icone-logo">
                        <h1>Kracht</h1>
                    </a>
                </div>
            </nav>
        </header>
        <!-- FIM CABECALHO -->

        <!-- INICIO SECAO PRINCIPAL -->
        <main class="usuario">
            <?php if (isset($_SESSION['ativa'])) { ?>
                <!-- BLOCO 1 -->
                <div>
                    <div class="bloco">
                        <div>
                            <img class="img-perfil" src="../../db/uploads/<?php echo $_SESSION['usuario']['imagem']; ?>" alt="">
                            <h3>Bem vindo(a) à página administrativa, <?php echo $_SESSION['usuario']['nome']; ?>!</h3>
                        </div>
                    </div>
                    <div class="bloco dados">

                        <?php
                        #ATUALIZAR ADMIN
                        if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'atualizar' && $_GET['tipo'] == 'admin' && $_SESSION['usuario']['is_admin'] == 1) {
                            $id = $_GET['id'];
                            updateUsuario($connect);
                            $adminDados = buscaUnica($connect, "usuarios", $id);

                            $usuario = buscaUnica($connect, "usuarios", $id);
                            updateUsuario($connect);

                            echo "<form method='POST' enctype='multipart/form-data' class='form form-center'>";
                            echo "<div><h3>Editar usuário: " . $adminDados['nome'] . "</h3></div>";

                            echo "<div class='links-login'>";

                            echo "<input type='hidden' name='id' value='" . $adminDados['id'] . "'>";
                            echo "<input class='input-entrada' value='" . $adminDados['nome'] . "' type='text' name='nome' placeholder='Nome' required>";
                            echo "<input class='input-entrada' value='" . $adminDados['sobrenome'] . "' type='text' name='sobrenome' placeholder='Sobrenome' required>";
                            echo "<input class='input-entrada' value='" . $adminDados['email'] . "' type='email' name='email' placeholder='E-mail' required>";
                            echo "<input class='input-entrada' type='password' name='senha' placeholder='Senha'>";
                            echo "<input class='input-entrada' type='password' name='repita-senha' placeholder='Confirme a senha'>";
                            echo "<input class='input-entrada' value='" . $adminDados['dt_nascimento'] . "' type='date' name='dt-nascimento'>";
                            echo "<input class='input-entrada upload' type='file' name='arquivo'>";

                            echo "</div>";

                            echo "<div class='btn-login'>";
                            echo "<input class='btn btn-ativo' type='submit' value='Salvar Alterações' name='atualizar'>";
                            
                            echo "</div>";
                            echo "</form>";

                            if (isset($_POST['atualizar-admin'])) {
                                echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Recarrega a página

                            }
                        }
                        ?>

                        <h3>Seus dados:</h3>
                        <p>Nome: <?php echo $_SESSION['usuario']['nome']; ?></p>
                        <p>Sobrenome: <?php echo $_SESSION['usuario']['sobrenome']; ?></p>
                        <p>E-mail: <?php echo $_SESSION['usuario']['email']; ?></p>
                        <p>Data de nascimento: <?php echo $_SESSION['usuario']['dt_nascimento']; ?></p>

                        <div class="btn-admin">
                            <a class="btn btn-ativo" href="admin.php?id=<?php echo $_SESSION['usuario']['id']; ?>&acao=atualizar&tipo=admin">Atualizar dados</a>
                        </div>

                    </div>
                </div>

                <!-- BLOCO 2 -->
                <div class="bloco-externo ">

                    <!-- BLOCO USUARIOS CADASTRADOS -->
                    <div class="bloco">
                        <h3>Usuários cadastrados: </h3>
                        <div class="tabela ">

                            <?php
                            $tabela = "usuarios";
                            $order = "nome";
                            $usuarios = buscaTodosDados($connect, $tabela, 1, $order);

                            #ATUALIZAR USUARIO
                            if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'atualizar' && $_GET['tipo'] == 'usuario') {
                                $id = $_GET['id'];
                                $usuario = buscaUnica($connect, "usuarios", $id);
                                updateUsuario($connect);

                                echo "<form method='POST' enctype='multipart/form-data' class='form form-center'>";
                                echo "<div><h3>Editar usuário: " . $usuario['nome'] . "</h3></div>";

                                echo "<div class='links-login'>";

                                echo "<input type='hidden' name='id' value='" . $usuario['id'] . "'>";
                                echo "<input class='input-entrada' value='" . $usuario['nome'] . "' type='text' name='nome' placeholder='Nome' required>";
                                echo "<input class='input-entrada' value='" . $usuario['sobrenome'] . "' type='text' name='sobrenome' placeholder='Sobrenome' required>";
                                echo "<input class='input-entrada' value='" . $usuario['email'] . "' type='email' name='email' placeholder='E-mail' required>";
                                echo "<input class='input-entrada' type='password' name='senha' placeholder='Senha'>";
                                echo "<input class='input-entrada' type='password' name='repita-senha' placeholder='Confirme a senha'>";
                                echo "<input class='input-entrada' value='" . $usuario['dt_nascimento'] . "' type='date' name='dt-nascimento'>";
                                echo "<input class='input-entrada upload' type='file' name='arquivo'>";

                                echo "</div>";

                                echo "<div class='btn-login'>";
                                echo "<input class='btn btn-ativo' type='submit' value='Salvar Alterações' name='atualizar'>";
                                echo "</div>";
                                echo "</form>";
                            }
                            if (isset($_POST['atualizar'])) {
                                echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Recarrega a página

                            }

                            #DELETAR USUARIO
                            if (isset($_GET['nome']) && isset($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['tipo'] == 'usuario') {
                                echo "<form method='POST' class='form form-center'>";
                                echo "Deseja mesmo deletar o usuario " . $_GET['nome'] . "?";
                                echo "<input type='hidden' name='id' value=" . $_GET['id'] . ">";
                                echo "<input class='btn btn-ativo' type='submit' value='Deletar' name='deletar-usuario'>";
                                echo "</form>";
                            }
                            if (isset($_POST['deletar-usuario'])) {
                                deletar($connect, "usuarios", $_POST['id']);
                                echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Recarrega a página
                            }
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID: </th>
                                        <th>Nome:</th>
                                        <th>Sobrenome:</th>
                                        <th>E-mail:</th>
                                        <th>Nascimento:</th>
                                        <th>Imagem:</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    #mostra tabela somente de usuarios que não são admins
                                    foreach ($usuarios as $usuario) {
                                        if ($usuario['is_admin'] != 1) { ?>
                                            <tr>
                                                <td><?php echo $usuario['id']; ?></td>
                                                <td><?php echo $usuario['nome']; ?></td>
                                                <td><?php echo $usuario['sobrenome']; ?></td>
                                                <td><?php echo $usuario['email']; ?></td>
                                                <td><?php echo $usuario['dt_nascimento']; ?></td>
                                                <td><?php echo $usuario['imagem']; ?></td>
                                                <td>
                                                    <a class="btn-acoes" href="admin.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>&tipo=usuario&acao=deletar">Excluir</a>

                                                    <a class="btn-acoes" href="admin.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>&tipo=usuario&acao=atualizar">Atualizar</a>
                                                </td>
                                            </tr>
                                    <?php
                                        };
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- BLOCO PRODUTOS CADASTRADOS -->
                    <div class="bloco">
                        <h3>Produtos cadastrados: </h3>
                        <div class="tabela">
                            <?php
                            $tabela = "produtos";
                            $order = "tipo, nome";
                            $produtos = buscaTodosDados($connect, $tabela, 1, $order);

                            #ATUALIZA PRODUTOS
                            if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'atualizar' && $_GET['tipo'] == 'produto') {
                                $id = $_GET['id'];
                                $produto = buscaUnica($connect, "produtos", $id);
                                updateProduto($connect);

                                echo "<form method='POST' enctype='multipart/form-data' class='form'>";
                                echo "<div><h3>Editar produto: " . $produto['nome'] . "</h3></div>";

                                echo "<div class='links-login'>";

                                echo "<input type='hidden' name='id' value='" . $produto['id'] . "'>";
                                echo "<input class='input-entrada' value='" . $produto['nome'] . "' type='text' name='nome' placeholder='Nome' required>";
                                echo "<input class='input-entrada' value='" . $produto['marca'] . "' type='text' name='marca' placeholder='Marca' required>";
                                echo "<input class='input-entrada' value='" . $produto['tipo'] . "' type='tipo' name='tipo' placeholder='Tipo' required>";
                                echo "<input class='input-entrada' type='number' name='valor' placeholder='Valor'>";
                                echo "<input class='input-entrada upload' type='file' name='arquivo'>";

                                echo "</div>";

                                echo "<div class='btn-login'>";
                                echo "<input class='btn btn-ativo' type='submit' value='Salvar Alterações' name='atualizar'>";
                                echo "</div>";
                                echo "</form>";
                            }
                            if (isset($_POST['atualizar'])) {
                                echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Recarrega a página

                            }

                            #DELETA PRODUTOS
                            if (isset($_GET['nome']) && isset($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['tipo'] == 'produto') {
                                echo "<form method='POST'  class='form form-center'>";
                                echo "Deseja mesmo deletar o produto " . $_GET['nome'] . "?";
                                echo "<input type='hidden' name='id' value=" . $_GET['id'] . ">";
                                echo "<input class='btn btn-ativo' type='submit' value='Deletar' name='deletar'>";
                                echo "</form>";
                            }
                            if (isset($_POST['deletar'])) {
                                deletar($connect, "produtos", $_POST['id']);
                                echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Recarrega a página
                            }
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
                                        <th>Ações</th>
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
                                            <td>
                                                <a class="btn-acoes" href="admin.php?id=<?php echo $produto['id']; ?>&nome=<?php echo $produto['nome']; ?>&tipo=produto&acao=deletar">Excluir</a>

                                                <a class="btn-acoes" href="admin.php?id=<?php echo $produto['id']; ?>&nome=<?php echo $produto['nome']; ?>&tipo=produto&acao=atualizar">Atualizar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- BLOCO 3 -->
                <!-- INICIO FORMULARIO -->
                <form class="" method="POST" enctype="multipart/form-data">
                    <div>
                        <h3>Cadastrar produto</h3>
                    </div>

                    <div class="links-login">
                        <label for="nome">Nome do produto:</label>
                        <input type="text" id="nome" name="nome" class="input-entrada" required autofocus>

                        <label for="marca">Marca do produto:</label>
                        <input type="text" id="marca" name="marca" class="input-entrada" required>


                        <label for="tipo">Tipo de produto:</label>
                        <select name="tipo" id="tipo" required>
                            <option value="bicicleta">Bicicleta</option>
                            <option value="roupas">Roupas</option>
                            <option value="calcados">Calçados</option>
                            <option value="acessorios">Acessorios</option>
                        </select>

                        <label for="valor">Valor do produto:</label>
                        <input type="number" id="valor" name="valor" class="input-entrada" required>

                        <label for="valor">Imagem do produto:</label>
                        <input type="file" name="arquivo" id="arquivo" class="input-entrada upload" required>
                    </div>

                    <div class="btn-login">
                        <button type="submit" name="cadastrar" class="btn-ativo btn">Cadastrar produto</button>
                    </div>
                </form>
                <!-- FIM FORMULARIO -->
            <?php } ?>
        </main>
        <!-- INICIO RODAPÉ -->
        <footer>
            <!-- SEÇÃO SUPERIOR DO FOOTER -->
            <section class="secao-superior-footer">
                <!-- INICIO SEÇÃO LOGO E REDES -->
                <div class="div-logo-rodape">
                    <!-- LOGO -->
                    <div class="">
                        <a href="index.html" class="logo"><img src="../src/img/kracht-icone.png"
                                alt="icone de um homem pedalando com o fundo laranja" class="icone-logo">
                            <h1>Kracht</h1>
                        </a>
                    </div>
                    <!-- ICONES -->
                    <div class="icones-redes">
                        <ul class="icone-links-ul">
                            <li class="icone-links-li">
                                <a href="https://github.com/fortesvitoria/kracht">
                                    <ion-icon class="icone-link" name="logo-github"></ion-icon>
                                </a>
                            </li>
                            <li class="icone-links-li">
                                <a href="https://facebook.com">
                                    <ion-icon class="icone-link" name="logo-facebook"></ion-icon>
                                </a>
                            </li>
                            <li class="icone-links-li">
                                <a href="https://instagram.com">
                                    <ion-icon class="icone-link" name="logo-instagram"></ion-icon>
                                </a>
                            </li>
                            <li class="icone-links-li">
                                <a href="https://youtube.com">
                                    <ion-icon class="icone-link" name="logo-youtube"></ion-icon>
                                </a>
                            </li>
                            <li class="icone-links-li">
                                <a href="https://tiktok.com">
                                    <ion-icon class="icone-link" name="logo-tiktok"></ion-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- FIM SEÇÃO LOGO E REDES -->
                <!-- INICIO SEÇÃO LINKS-->
                <div class="hr"></div>
                <div class="links-footer">
                    <!-- COLUNA 1 -->
                    <ul class="coluna-links">
                        <li>
                            <p class="titulo-links">Loja</p>
                        </li>
                        <li class="link-li"><a class="link-footer">Bicicletas de estrada</a></li>
                        <li class="link-li"><a class="link-footer">Bicicletas de montanha</a></li>
                        <li class="link-li"><a class="link-footer">Bicicletas híbridas</a></li>
                        <li class="link-li"><a class="link-footer">Bicicletas masculinas</a></li>
                        <li class="link-li"><a class="link-footer">Bicicletas femininas</a></li>
                        <li class="link-li"><a class="link-footer">Equipamentos</a></li>
                        <li class="link-li"><a class="link-footer">Roupas</a></li>
                        <li class="link-li"><a class="link-footer">Acessórios</a></li>
                        <li class="link-li"><a class="link-footer">Encontre uma loja </a></li>
                    </ul>
                    <!-- COLUNA 2 -->
                    <ul class="coluna-links">
                        <li>
                            <p class="titulo-links">Suporte</p>
                        </li>
                        <li class="link-li"><a class="link-footer">Atendimento ao cliente</a></li>
                        <li class="link-li"><a class="link-footer">Entre em contato conosco</a></li>
                        <li class="link-li"><a class="link-footer">Inscrição para a newsletter</a></li>
                        <li class="link-li"><a class="link-footer">Garantia</a></li>
                        <li class="link-li"><a class="link-footer">Como comprar com segurança</a></li>
                        <li class="link-li"><a class="link-footer">Manuais e guias do usuário</a></li>
                        <li class="link-li"><a class="link-footer">Suporte ao produto</a></li>
                        <li class="link-li"><a class="link-footer">Guias de tamanhos e ajustes de roupas </a></li>
                    </ul>
                    <!-- COLUNA 3 -->
                    <ul class="coluna-links">
                        <li>
                            <p class="titulo-links">Privacidade e termos</p>
                        </li>
                        <li class="link-li"><a class="link-footer">Declaração de Privacidade</a></li>
                        <li class="link-li"><a class="link-footer">Termos e Condições</a></li>
                        <li class="link-li"><a class="link-footer">Notificação de Segurança</a></li>
                        <li class="link-li"><a class="link-footer">Política de Cookies</a></li>
                        <li class="link-li"><a class="link-footer"> Relatório de Transparência Salarial</a></li>
                    </ul>
                </div>
                <!-- FIM SEÇÃO LINKS-->
            </section>
            <div class="hr"></div>
            <!-- SEÇÃO INFERIOR DO FOOTER -->
            <div class="secao-inferior-footer">
                <div class="direitos-autorais">
                    <p>© Vitória Fortes 2025</p>
                </div>
                <div class="idioma">
                    <a href="#">
                        <p>Português/BR</p>
                        <img src="../src/img/icone-brasil.png" alt="icone da bandeira do Brasil" class="icone-idioma">
                    </a>
                </div>
            </div>
        </footer>
        <!-- FIM RODAPÉ -->
    </div>
    <!-- SCRIPT IONICONS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../src/JS/dropDown.js"></script>
</body>

</html>