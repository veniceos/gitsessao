<?php 

require_once 'db/config.php';

        if (isset($_POST['submit'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM cadastro WHERE email = ? AND senha = ?');
            $stmt->execute([$email, $senha]);
            $count = $stmt->fetchColumn();
            
            if ($count > 0){
                $error = 'Esse perfil já foi cadastrado.';}
            else{
                $stmt = $pdo->prepare('INSERT INTO cadastro (nome, email, senha)
                VALUES (:nome, :email, :senha)');
                $stmt->execute(['nome' => $nome, 'email' => $email,
                'senha' => $senha]);

                if ($stmt->rowCount()){
                    echo '<span>Cadastro realizado com sucesso!</span>';
                }else{
                    echo '<span>Erro na realização de cadastro. Tente novamente mais tarde!</span>';
                }

            }header("Location: "login.php");

            if (isset($error)) {
                echo '<span>' . $error . '</span>';
            }
        }
?>

<form method="post">   

<div class="lab">
    <label for="nome">Nome completo:</label>
</div>

<div class="inp">
    <input type="text" name="nome" required><br>    
</div>

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

<div>
<button class="botao" type="submit" name="submit" value="cadastrar">Cadastrar-se</button>
</form>