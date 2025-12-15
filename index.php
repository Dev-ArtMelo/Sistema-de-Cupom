<?php
session_start();

// Carregando Controllers
require_once 'controllers/AuthController.php';
require_once 'controllers/PanelController.php';

// Roteador Simples
$action = $_GET['action'] ?? 'login';

$auth = new AuthController();
$panel = new PanelController();

switch ($action) {
    case 'login':
        $auth->login();
        break;
        
    case 'cadastro':
        $auth->cadastro();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'dashboard':
        $panel->dashboard();
        break;

    default:
        $auth->login();
        break;
}
?>