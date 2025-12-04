<?php

session_start();

include("../../controller/conexao.php");
include("../../controller/upload.php");
include("../../controller/buscar_dados.php");
include("../../controller/deletar_dados.php");
include("../../controller/update_usuario.php");

if (isset($_POST['deletar-usuario'])) {
    deletar($connect, "usuarios", $_POST['id']);
    exit;
}

updateUsuario($connect);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kracht</title>
    <!-- css geral - header, footer, estilos e cores base -->
    <link rel="stylesheet" href="../src/css/style.css">
    <!-- css especifico da página login.html -->
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
                            alt="icone com tres bbarras laranja representando um menu"></button>
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
                    <a href="index.html" class="logo"><img src="../src/img/kracht-icone.png"
                            alt="icone de um homem pedalando com o fundo laranja" class="icone-logo">
                        <h1>Kracht</h1>
                    </a>
                </div>
            </nav>
        </header>
        <!-- FIM CABECALHO -->

        <!-- INICIO SECAO PRINCIPAL -->
        <main class="login">
            <?php if (isset($_SESSION['ativa'])) { ?>
                <div>
                    <div class="bloco">
                        <div>
                            <img class="img-perfil" src="../../db/uploads/<?php echo $_SESSION['usuario']['imagem']; ?>" alt="">
                            <h3>Bem vindo(a) à página do usuário, <?php echo $_SESSION['usuario']['nome']; ?>!</h3>
                        </div>
                    </div>

                    <div class="bloco dados texto-dados">

                        <?php
                        #DELETAR USUARIO
                        if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['tipo'] == 'usuario') {
                            $usuario = buscaUnica($connect, "usuarios", $_GET['id']);

                            echo "<form method='POST' class='form form-center'>";
                            echo "<div class='div-fechar'><a class='' href='usuario.php'><ion-icon name='close-outline' class='icone-link icone-fechar'></ion-icon></a></div>";
                            echo "Deseja mesmo deletar sua conta " . $usuario['nome'] . "?";
                            echo "<input type='hidden' name='id' value=" . $usuario['id'] . ">";
                            echo "<input class='btn btn-ativo' type='submit' value='Deletar' name='deletar-usuario'>";
                            echo "</form>";
                        }
                        ?>

                        <h3>Seus dados:</h3>
                        <p>Nome: <?php echo $_SESSION['usuario']['nome']; ?></p>
                        <p>Sobrenome: <?php echo $_SESSION['usuario']['sobrenome']; ?></p>
                        <p>E-mail: <?php echo $_SESSION['usuario']['email']; ?></p>
                        <p>Data de nascimento: <?php echo $_SESSION['usuario']['dt_nascimento']; ?></p>
                        <div class="btn-login btn-admin">
                            <a class="btn btn-ativo" href="usuario.php?id=<?php echo $_SESSION['usuario']['id']; ?>&tipo=usuario&acao=atualizar">Atualizar</a>

                            <a class="btn btn-ativo" href="usuario.php?id=<?php echo $_SESSION['usuario']['id']; ?>&tipo=usuario&acao=deletar">Excluir conta</a>
                        </div>

                    </div>
                </div>


            <?php } ?>
            <?php
            $tabela = "usuarios";
            $order = "nome";
            $usuarios = buscaTodosDados($connect, $tabela, 1, $order);

            #ATUALIZAR USUARIO
            if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'atualizar' && $_GET['tipo'] == 'usuario') {
                $id = $_GET['id'];
                $usuario = buscaUnica($connect, "usuarios", $id);

                echo "<form method='POST' enctype='multipart/form-data' class='form'>";

                echo "<div>
                    <h3>Editar usuário: " . $usuario['nome'] . "</h3>
                    </div>";

                echo "<div class='mensagens'>";

                if (isset($_SESSION['msg_temp'])) {
                    echo $_SESSION['msg_temp'];
                    unset($_SESSION['msg_temp']);
                }

                echo "</div>";

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
            ?>



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