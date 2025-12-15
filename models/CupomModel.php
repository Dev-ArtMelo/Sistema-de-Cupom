<?php
require_once __DIR__ . '/../config/Database.php';

class CupomModel {
    public function criarCupom($dados) {
        $sql = "INSERT INTO cupom (num_cupom, tit_cupom, cnpj_comercio, dta_emissao_cupom, dta_inicio_cupom, dta_termino_cupom, per_desc_cupom) VALUES (?, ?, ?, NOW(), ?, ?, ?)";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute([$dados['hash'], $dados['titulo'], $dados['cnpj'], $dados['inicio'], $dados['fim'], $dados['desconto']]);
    }

    public function listarPorComercio($cnpj) {
        $stmt = Database::connect()->prepare("SELECT * FROM cupom WHERE cnpj_comercio = ? ORDER BY dta_inicio_cupom DESC");
        $stmt->execute([$cnpj]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarDisponiveis() {
        $sql = "SELECT c.*, com.nom_fantasia_comercio, com.raz_social_comercio FROM cupom c 
                JOIN comercio com ON c.cnpj_comercio = com.cnpj_comercio
                WHERE c.dta_termino_cupom >= CURDATE() 
                AND c.num_cupom NOT IN (SELECT num_cupom FROM cupom_associado)";
        return Database::connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reservar($cpf, $cupom_id) {
        // Verifica duplicidade antes de inserir
        $check = Database::connect()->prepare("SELECT * FROM cupom_associado WHERE num_cupom = ?");
        $check->execute([$cupom_id]);
        if($check->rowCount() > 0) return false;

        $stmt = Database::connect()->prepare("INSERT INTO cupom_associado (num_cupom, cpf_associado, dta_cupom_associado) VALUES (?, ?, NOW())");
        return $stmt->execute([$cupom_id, $cpf]);
    }

    public function listarReservados($cpf) {
        $sql = "SELECT ca.*, c.tit_cupom, c.per_desc_cupom, com.raz_social_comercio 
                FROM cupom_associado ca 
                JOIN cupom c ON ca.num_cupom = c.num_cupom 
                JOIN comercio com ON c.cnpj_comercio = com.cnpj_comercio
                WHERE ca.cpf_associado = ? ORDER BY ca.dta_cupom_associado DESC";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute([$cpf]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validarUso($codigo, $cnpj) {
        $sql = "SELECT * FROM cupom_associado ca 
                JOIN cupom c ON ca.num_cupom = c.num_cupom 
                WHERE ca.num_cupom = ? AND c.cnpj_comercio = ? AND ca.dta_uso_cupom_associado IS NULL";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute([$codigo, $cnpj]);

        if ($stmt->rowCount() > 0) {
            $upd = Database::connect()->prepare("UPDATE cupom_associado SET dta_uso_cupom_associado = NOW() WHERE num_cupom = ?");
            $upd->execute([$codigo]);
            return true;
        }
        return false;
    }
}
?>