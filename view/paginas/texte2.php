<div>
                    <div class="bloco">
                        <h3>Usuários cadastrados: </h3>
                        <div class="tabela">

                            <?php
                            $tabela = "usuarios";
                            $order = "nome";
                            $usuarios = buscaTodosDados($connect, $tabela, 1, $order);
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nome:</th>
                                        <th>Sobrenome:</th>
                                        <th>E-mail:</th>
                                        <th>Nascimento:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    #mostra tabela somente de usuarios que não são admins
                                    foreach ($usuarios as $usuario) {
                                        if ($usuario['is_admin'] != 1) { ?>
                                            <tr>
                                                <td><?php echo $usuario['nome']; ?></td>
                                                <td><?php echo $usuario['sobrenome']; ?></td>
                                                <td><?php echo $usuario['email']; ?></td>
                                                <td><?php echo $usuario['dt_nascimento']; ?></td>
                                            </tr>
                                    <?php
                                        };
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bloco">
                        <h3>Usuários cadastrados: </h3>
                        <div class="tabela">

                            <?php
                            $tabela = "usuarios";
                            $order = "nome";
                            $usuarios = buscaTodosDados($connect, $tabela, 1, $order);
                            ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nome:</th>
                                        <th>Sobrenome:</th>
                                        <th>E-mail:</th>
                                        <th>Nascimento:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    #mostra tabela somente de usuarios que não são admins
                                    foreach ($usuarios as $usuario) {
                                        if ($usuario['is_admin'] != 1) { ?>
                                            <tr>
                                                <td><?php echo $usuario['nome']; ?></td>
                                                <td><?php echo $usuario['sobrenome']; ?></td>
                                                <td><?php echo $usuario['email']; ?></td>
                                                <td><?php echo $usuario['dt_nascimento']; ?></td>
                                            </tr>
                                    <?php
                                        };
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>