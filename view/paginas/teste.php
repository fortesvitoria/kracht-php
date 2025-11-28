<?php
session_start();
include("../../controller/conexao.php");
include("../../controller/upload.php");
include("../../controller/buscar_dados.php");
include("../../controller/deletar_dados.php");
include("../../controller/update_usuario.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kracht</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/CSS/admin.css">
    <link rel="shortcut icon" href="../src/img/kracht-icone.png" type="image/x-icon">
</head>

<body>
    <div class="div-principal">
        <header>
            <nav class="nav">
                <div class="links-nav-desktop logo-link">
                    <a class="logo" href="../../controller/logout.php">
                        <ion-icon class="icone-link" name="log-out-outline"></ion-icon>Sair
                    </a>
                </div>
                <div class="">
                    <a href="../index.php" class="logo"><img src="../src/img/kracht-icone.png" class="icone-logo">
                        <h1>Kracht</h1>
                    </a>
                </div>
            </nav>
        </header>

        <main class="login">
            <?php if (isset($_SESSION['ativa'])) { ?>
                <div>
                    <div class="bloco">
                        <div>
                            <img class="img-perfil" src="../../db/uploads/<?php echo $_SESSION['usuario']['imagem']; ?>" alt="">
                            <h3>Bem vindo(a), <?php echo $_SESSION['usuario']['nome']; ?>!</h3>
                        </div>
                    </div>
                    <div class="bloco dados texto-dados">
                        <h3>Seus dados:</h3>
                        <p>Nome: <?php echo $_SESSION['usuario']['nome']; ?></p>
                        <p>Sobrenome: <?php echo $_SESSION['usuario']['sobrenome']; ?></p>
                        <p>E-mail: <?php echo $_SESSION['usuario']['email']; ?></p>
                        <p>Data de nascimento: <?php echo $_SESSION['usuario']['dt_nascimento']; ?></p>
                        <div class="btn-login btn-admin">
                            <a class="btn btn-ativo" href="usuario.php?id=<?php echo $_SESSION['usuario']['id']; ?>&tipo=usuario&acao=atualizar">Atualizar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            // #ATUALIZAR USUARIO
            if (isset($_GET['id']) && isset($_GET['acao']) && $_GET['acao'] == 'atualizar' && $_GET['tipo'] == 'usuario') {
                $id = (int)$_GET['id'];
                $usuario = buscaUnica($connect, "usuarios", $id);

                // CORREÇÃO: Removi o 'action' que estava quebrado.
                echo "<form method='POST' enctype='multipart/form-data' class='form'>";
                echo "<div><h3>Editar usuário: " . $usuario['nome'] . "</h3></div>";

                echo "<div class='links-login'>";
                
                // CORREÇÃO: Adicionei o campo origem para saber para onde voltar
                echo "<input type='hidden' name='origem' value='usuario.php'>";
                echo "<input type='hidden' name='id' value='" . $usuario['id'] . "'>";
                
                echo "<label>Nome:</label>";
                echo "<input class='input-entrada' value='" . $usuario['nome'] . "' type='text' name='nome' required>";
                
                echo "<label>Sobrenome:</label>";
                echo "<input class='input-entrada' value='" . $usuario['sobrenome'] . "' type='text' name='sobrenome' required>";
                
                echo "<label>E-mail:</label>";
                echo "<input class='input-entrada' value='" . $usuario['email'] . "' type='email' name='email' required>";
                
                echo "<label>Nova Senha:</label>";
                echo "<input class='input-entrada' type='password' name='senha' placeholder='Opcional'>";
                
                echo "<label>Repita Senha:</label>";
                echo "<input class='input-entrada' type='password' name='repita-senha'>";
                
                echo "<label>Nascimento:</label>";
                echo "<input class='input-entrada' value='" . $usuario['dt_nascimento'] . "' type='date' name='dt-nascimento'>";
                
                echo "<label>Foto:</label>";
                echo "<input class='input-entrada upload' type='file' name='arquivo'>";

                echo "</div>";

                echo "<div class='btn-login'>";
                echo "<input class='btn btn-ativo' type='submit' value='Salvar Alterações' name='atualizar'>";
                echo "</div>";
                
                // Botão cancelar
                echo "<br><a href='usuario.php' class='btn' style='background:gray; color:white; text-align:center; display:block;'>Cancelar</a>";
                
                echo "</form>";
            }

            // Processa o formulário
            if (isset($_POST['atualizar'])) {
                updateUsuario($connect);
            } 
            ?>
        </main>
        
        <footer>
            <div class="secao-inferior-footer">
                <div class="direitos-autorais">
                    <p>© Vitória Fortes 2025</p>
                </div>
            </div>
        </footer>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>