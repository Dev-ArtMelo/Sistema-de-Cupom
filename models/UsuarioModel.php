<?php
require_once __DIR__ . '/../config/Database.php';

class UsuarioModel {
    public function loginAssociado($cpf) {
        $stmt = Database::connect()->prepare("SELECT * FROM associado WHERE cpf_associado = ?");
        $stmt->execute([$cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loginComercio($cnpj) {
        $stmt = Database::connect()->prepare("SELECT * FROM comercio WHERE cnpj_comercio = ?");
        $stmt->execute([$cnpj]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrarAssociado($dados) {
        $sql = "INSERT INTO associado (cpf_associado, nom_associado, email_associado, sen_associado) VALUES (?, ?, ?, ?)";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute([$dados['cpf'], $dados['nome'], $dados['email'], $dados['senha']]);
    }

    public function cadastrarComercio($dados) {
        $sql = "INSERT INTO comercio (cnpj_comercio, id_categoria, raz_social_comercio, email_comercio, sen_comercio) VALUES (?, ?, ?, ?, ?)";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute([$dados['cnpj'], $dados['categoria'], $dados['razao'], $dados['email'], $dados['senha']]);
    }
    
    public function getCategorias() {
        return Database::connect()->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>