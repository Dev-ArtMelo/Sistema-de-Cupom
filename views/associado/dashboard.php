<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Área do Associado</title>
</head>
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Olá, <?php echo $_SESSION['usuario']['nom_associado']; ?></h3>
        <a href="index.php?action=logout" class="btn btn-danger btn-sm">Sair</a>
    </div>

    <?php if(!empty($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(!empty($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

    <h4 class="mb-3 text-primary">Cupons Disponíveis</h4>
    <div class="row">
        <?php if(count($disponiveis) == 0) echo "<p class='text-muted'>Nenhum cupom disponível no momento.</p>"; ?>
        <?php foreach($disponiveis as $cupom): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= $cupom['tit_cupom'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $cupom['raz_social_comercio'] ?></h6>
                        <p class="card-text display-6 text-success"><?= $cupom['per_desc_cupom'] ?>% OFF</p>
                        <p class="small">Válido até: <?= date('d/m/Y', strtotime($cupom['dta_termino_cupom'])) ?></p>
                        <a href="index.php?action=dashboard&reservar=<?= $cupom['num_cupom'] ?>" class="btn btn-primary w-100">Reservar Agora</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <hr class="my-5">

    <h4 class="mb-3 text-success">Meus Cupons Reservados</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark"><tr><th>Código (Apresente na Loja)</th><th>Loja</th><th>Promoção</th><th>Status</th></tr></thead>
            <tbody>
                <?php foreach($meus_cupons as $m): 
                    $status = $m['dta_uso_cupom_associado'] ? "<span class='badge bg-secondary'>Utilizado</span>" : "<span class='badge bg-success'>Ativo</span>";
                ?>
                <tr>
                    <td><h4 class="text-primary"><?= $m['num_cupom'] ?></h4></td>
                    <td><?= $m['raz_social_comercio'] ?></td>
                    <td><?= $m['tit_cupom'] ?> (<?= $m['per_desc_cupom'] ?>%)</td>
                    <td><?= $status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>