<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Painel Comércio</title>
</head>
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Empresa: <?php echo $_SESSION['usuario']['raz_social_comercio']; ?></h3>
        <a href="index.php?action=logout" class="btn btn-danger btn-sm">Sair</a>
    </div>

    <?php if(!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(!empty($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

    <div class="row">
        <div class="col-md-5">
            <div class="card bg-light mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">✔ Validar Cupom do Cliente</h5>
                    <p class="small text-muted">Insira o código de 12 dígitos apresentado pelo cliente.</p>
                    <form method="POST" action="index.php?action=dashboard">
                        <input type="hidden" name="validar_cupom" value="1">
                        <div class="input-group">
                            <input type="text" name="codigo_cupom" class="form-control" placeholder="Ex: A1B2C3D4E5F6" required>
                            <button class="btn btn-success">Confirmar Uso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">+ Criar Nova Promoção</h5>
                    <form method="POST" action="index.php?action=dashboard">
                        <input type="hidden" name="gerar_cupom" value="1">
                        <div class="mb-2"><input type="text" name="titulo" class="form-control" placeholder="Título da Promoção (Ex: Natal)" required></div>
                        <div class="row g-2 mb-2">
                            <div class="col-md-6"><label class="small">Início</label><input type="date" name="inicio" class="form-control" required></div>
                            <div class="col-md-6"><label class="small">Fim</label><input type="date" name="fim" class="form-control" required></div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6"><input type="number" name="desconto" class="form-control" placeholder="% Desconto" step="0.01" required></div>
                            <div class="col-md-6"><input type="number" name="qtd" class="form-control" placeholder="Quantidade de Cupons" required></div>
                        </div>
                        <button class="btn btn-primary w-100 mt-3">Gerar Cupons</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h4>Histórico de Cupons Gerados</h4>
    <table class="table table-striped table-hover">
        <thead><tr><th>Código</th><th>Promoção</th><th>Vencimento</th><th>Status</th></tr></thead>
        <tbody>
            <?php foreach ($meus_cupons as $c): ?>
                <tr>
                    <td><?= $c['num_cupom'] ?></td>
                    <td><?= $c['tit_cupom'] ?></td>
                    <td><?= date('d/m/Y', strtotime($c['dta_termino_cupom'])) ?></td>
                    <td>Ativo</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>