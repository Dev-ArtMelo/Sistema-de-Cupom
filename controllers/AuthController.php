<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController {
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new UsuarioModel();
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $tipo = $_POST['tipo'];

            if ($tipo == 'associado') {
                $user = $model->loginAssociado($login);
                $hash = $user['sen_associado'] ?? '';
            } else {
                $user = $model->loginComercio($login);
                $hash = $user['sen_comercio'] ?? '';
            }

            if ($user && password_verify($senha, $hash)) {
                $_SESSION['usuario'] = $user;
                $_SESSION['tipo'] = $tipo;
                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $erro = "Login inválido. Verifique seus dados.";
                require __DIR__ . '/../views/login.php';
            }
        } else {
            require __DIR__ . '/../views/login.php';
        }
    }

    public function cadastro() {
        $model = new UsuarioModel();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tipo = $_POST['tipo'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            
            try {
                if ($tipo == 'associado') {
                    $dados = [
                        'cpf' => $_POST['cpf'], 'nome' => $_POST['nome'], 
                        'email' => $_POST['email'], 'senha' => $senha
                    ];
                    $model->cadastrarAssociado($dados);
                } else {
                    $dados = [
                        'cnpj' => $_POST['cnpj'], 'categoria' => $_POST['categoria'],
                        'razao' => $_POST['razao'], 'email' => $_POST['email'], 'senha' => $senha
                    ];
                    $model->cadastrarComercio($dados);
                }
                echo "<script>alert('Cadastrado com sucesso!'); window.location='index.php?action=login';</script>";
            } catch (Exception $e) {
                $erro = "Erro ao cadastrar (Verifique se CPF/CNPJ já existe).";
            }
        }
        
        $categorias = $model->getCategorias();
        require __DIR__ . '/../views/cadastro.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
?>