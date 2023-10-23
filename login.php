<?php
session_start();

// Verifique se o usuário já está logado e redirecione-o para a página apropriada
if (isset($_SESSION['id'])) {
    header("Location: logout.php"); // Redirecione para a página de dashboard ou outra página após o login
    exit();
}

include_once('db/config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    // Resto do código de login aqui
    // ...
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="" method="post">
            <div class="lab">
                <label for="email">Email:</label>
            </div>
            <div class="inp">
                <input type="email" name="email" required><br>
            </div>

            <div class="lab">
                <label for="senha">Senha:</label>
            </div>
            <div class="inp">
                <input type="password" name="senha" required><br>
            </div>
            <div class="lab">
                <button class="botao" type="submit" name="submit" value="login">
                    
                        Logar
                    
                </button>

                <?php

    if (isset($_POST['email']) && isset($_POST['senha'])) {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = $pdo->prepare("SELECT * FROM cadastro WHERE email = ? AND senha = ?");
        $sql_code->execute([$email, $senha]);

        $quantidade = $sql_code->rowCount();

        if ($quantidade > 0) {
            $pdo = $sql_code->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id'] = $pdo['id'];
            $_SESSION['nome'] = $pdo['nome'];
            $_SESSION['permissao'] = $pdo['adm'];
            var_dump($_SESSION['permissao']);
            $adm = $pdo['adm'];

            switch ($adm) {
                case 0:
                    header("Location: index.php");
                    break;
                case 1:
                    header("Location: adm.php");
                    break;
                default:
                    echo "USUÁRIO SEM PERMISSÃO, FAVOR CONTATAR O ADMIN!!";
                    break;
            }
        } else {
            echo '<span>Falha ao logar! E-mail ou senha incorretos</span>';
        }
    }
    ?>
    </body>
</html>