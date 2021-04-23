<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">    

</header>
<body>
    <div id="container">
        <form class="form-register" method="POST" action="register.php">
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Usuario</label>
                <input class="form-control" name="username" id="username">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Correo electrónico</label>
                <input class="form-control" name="email" id="email">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="passwdInput" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password">
                <div class="invalid-feedback"></div>
            </div>
            <button class="btn btn-primary" id="registerBtn">Submit</button>
        </form>
    </div>

    <script src="../js/register.js"></script>

</body>
