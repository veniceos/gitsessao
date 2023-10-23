<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=?>, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>LISTA DE USUÁRIOS</h2>
                <?php
                require_once 'db/config.php';
                require_once 'controller/usercontroller.php';
                require_once 'model/usermodel.php';

                // Criar uma instância do modelo usermodel
                $usermodel = new usermodel($pdo);

                // Criar uma instância do controlador userController e passar o modelo
                $userController = new userController($usermodel);



                //Atualizar usuário 
                if (
                    isset($_POST['atualizar_nome']) &&
                    isset($_POST['atualizar_email']) &&
                    isset($_POST['atualizar_senha']) &&
                    isset($_POST['id'])
                ) {
                    $usermodel->atualizaruser(
                        $_POST['id'],
                        $_POST['atualizar_nome'],
                        $_POST['atualizar_email'],
                        $_POST['atualizar_senha'],
                    );
                }


                // Exibir usuários - removido o trecho redundante
                $users = $usermodel->listarusers();
                ?>
<ul>
                    <?php foreach ($users as $user) : ?>
                        <li>
                            nome: <?php echo $user['nome']; ?>
                            Email: <?php echo $user['email']; ?>
                            Senha: <?php echo $user['senha']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h2>Atualizar Dados do usuário</h2>
            <form method="post">
                <div class="cadastro-n">
                <select name="id">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php echo $user['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="atualizar_nome" placeholder="Nome">
                <input type="text" name="atualizar_email" placeholder="Email">
                <input type="password" name="atualizar_senha" placeholder="Senha">
                <div class="inp"><input><button type="submit">Atualizar</button></input></div>
                </div>
            </form> 
</body>
</html>