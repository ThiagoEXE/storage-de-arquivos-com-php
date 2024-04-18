<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadstro de Armazenamento externo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <form action="ManageRequest.php" method="post">
        <div class="container">
            <div class="card">
                <h5 class="card-header text-center">Cadastro de provedores</h5>
            </div>
            <div class="mb-3">
                <label for="storage">Nome do provedor</label>
                <select id="storage" name="storage" class="form-control" required>
                    <option value="minio" selected>MinIO</option>
                    <option value="amazon">Amazon</option>
                    <option value="azure">Azure</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="endpoint">URL do serviço</label>
                <input id="endpoint" name="endpoint" class="form-control" type="url" required>
            </div>
            <div class="mb-3">
                <label for="login">Login</label>
                <input id="login" name="login" class="form-control" type="text" required>
            </div>
            <div class="mb-3">
                <label for="password">Senha</label>
                <input id="password" name="password" class="form-control" type="text" required>
            </div>
            <div class="text-center">
                <button id="send" class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
</body>

</html>