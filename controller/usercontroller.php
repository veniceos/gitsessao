<?php
require_once 'model/usermodel.php';

class userController {
    private $usermodel;

    public function __construct($pdo) {
        $this->usermodel = new usermodel($pdo);
    }
        
    public function criaruser ($nome, $email, $senha) {
        $this->usermodel->criaruser($nome, $email, $senha);
    }

    public function listarusers() {
        return $this->usermodel->listarusers();
    }

    public function exibirListausers() {
        $users = $this->usermodel->listarusers();
        include 'views/users/lista.php';
    }
    
    public function atualizaruser($id, $nome, $email, $senha) {
        $this->usermodel->atualizaruser($id, $nome, $email, $senha);
    }

}