<?php
class usermodel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    //Método para criar user
public function criaruser($nome, $email, $senha) {
    $sql = "INSERT INTO cadastro (nome, email, senha)
    VALUES (?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha]);
}

//Model para listar users
public function listarusers() {
    $sql = "SELECT * FROM cadastro";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchALL(PDO:: FETCH_ASSOC);
}

//Model para atualizar users
public function 
atualizaruser($id, $nome, $email, $senha) {
    $sql = "UPDATE cadastro SET nome = ?, email = ?, senha = ?
    WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha, $id]);
} 

}

?>