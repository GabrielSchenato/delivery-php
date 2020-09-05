<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Awesome | Lanches</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- Skin -->
    <link rel="stylesheet" href="dist/css/skins/skin-black.min.css">
    <!-- Font Google -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
    </br></br></br></br></br></br></br></br></br></br></br></br></br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-center">
                            <b>Awesome </b>Lanches
                            <br/>
                            <small>Área Restrita</small>
                        </h1>
                        <br/>
                        <form action="login/auth.php" method="POST">
                            <div class="form-group has-feedback">
                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuário" required="" autofocus="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Senha" required="">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="fa fa-sign-in"></span> Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
