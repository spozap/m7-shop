<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <title>Login</title>
</head>
<body>
    <div id="container">
        <form class="form-register" method="POST">
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Usuario</label>
                <input class="form-control" id="username" name="username">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="passwdInput" class="form-label">Contraseña</label>
                <input type="password" id="password" class="form-control" name="password">
                <div class="invalid-feedback"></div>
            </div>
            <button id="login" class="btn btn-primary">Submit</button>
            </form>
    </div>

    <script src="../js/login.js"></script>


</body>
</html>
