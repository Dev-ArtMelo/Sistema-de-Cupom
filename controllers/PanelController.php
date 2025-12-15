<?php
require_once __DIR__ . '/../models/CupomModel.php';

class PanelController {
    public function dashboard() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }

        $cupomModel = new CupomModel();
        $msg = '';
        $erro = '';

        if ($_SESSION['tipo'] == 'associado') {
            // --- ASSOCIADO ---
            if(isset($_GET['reservar'])) {
                if($cupomModel->reservar($_SESSION['usuario']['cpf_associado'], $_GET['reservar'])){
                    $msg = "Cupom reservado com sucesso!";
                } else {
                    $erro = "Não foi possível reservar este cupom.";
                }
            }
            $disponiveis = $cupomModel->listarDisponiveis();
            $meus_cupons = $cupomModel->listarReservados($_SESSION['usuario']['cpf_associado']);
            require __DIR__ . '/../views/associado/dashboard.php';

        } else {
            // --- COMERCIO ---
            $cnpj = $_SESSION['usuario']['cnpj_comercio'];

            // Gerar
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gerar_cupom'])) {
                $qtd = $_POST['qtd'];
                for ($i=0; $i < $qtd; $i++) { 
                    $dados = [
                        'hash' => strtoupper(substr(md5(uniqid(rand(), true)), 0, 12)),
                        'titulo' => $_POST['titulo'], 'cnpj' => $cnpj,
                        'inicio' => $_POST['inicio'], 'fim' => $_POST['fim'],
                        'desconto' => $_POST['desconto']
                    ];
                    $cupomModel->criarCupom($dados);
                }
                $msg = "Cupons gerados com sucesso!";
            }

            // Validar
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validar_cupom'])) {
                $codigo = $_POST['codigo_cupom'];
                if ($cupomModel->validarUso($codigo, $cnpj)) {
                    $msg = "Cupom validado e baixado no sistema!";
                } else {
                    $erro = "Cupom inválido, vencido ou já utilizado.";
                }
            }
            
            $meus_cupons = $cupomModel->listarPorComercio($cnpj);
            require __DIR__ . '/../views/comercio/dashboard.php';
        }
    }
}
?>