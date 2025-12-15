<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body class="container mt-5">
    <h2 class="mb-4 text-center">Cadastro de Usuário</h2>
    
    <div class="card shadow">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#associado">Sou Associado</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#comercio">Sou Comerciante</button></li>
            </ul>
        </div>
        <div class="card-body">
             <?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
             
            <div class="tab-content">
                <div class="tab-pane fade show active" id="associado">
                    <form action="index.php?action=cadastro" method="POST">
                        <input type="hidden" name="tipo" value="associado">
                        <div class="mb-3"><label>Nome Completo</label><input type="text" name="nome" class="form-control" required></div>
                        <div class="mb-3"><label>CPF</label><input type="text" name="cpf" class="form-control" required></div>
                        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label>Senha</label><input type="password" name="senha" class="form-control" required></div>
                        <button class="btn btn-success w-100">Cadastrar Associado</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="comercio">
                    <form action="index.php?action=cadastro" method="POST">
                        <input type="hidden" name="tipo" value="comercio">
                        <div class="mb-3"><label>Razão Social</label><input type="text" name="razao" class="form-control" required></div>
                        <div class="mb-3"><label>CNPJ</label><input type="text" name="cnpj" class="form-control" required></div>
                        <div class="mb-3"><label>Categoria</label>
                            <select name="categoria" class="form-select">
                                <?php foreach($categorias as $c): ?>
                                    <option value="<?= $c['id_categoria'] ?>"><?= $c['nom_categoria'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label>Senha</label><input type="password" name="senha" class="form-control" required></div>
                        <button class="btn btn-primary w-100">Cadastrar Comércio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="index.php?action=login">Já tenho conta (Voltar)</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>