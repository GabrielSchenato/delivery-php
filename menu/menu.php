
<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="../home/dashboard.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>WL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Awesome</b>Lanches</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation"><?php require '../contador/contador.php'; ?>
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?= $_SESSION['nome'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                <?= $_SESSION['nome']?> - <?= $_SESSION['funcao']?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="../login/logoff.php" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $_SESSION['nome'] ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Procurar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li class="<?=($pagina == 'cadProduto' || $pagina == 'cadCliente' || $pagina == 'cadPedido' ? 'treeview active' : 'treeview')?>">
                <a href="#"><i class="fa fa-align-justify"></i> <span>Cadastrar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($pagina == 'cadCliente'? 'active' : '')?>"><a href="../cliente/cadastrar.php"><i class="fa fa-user-plus"></i>Cliente</a></li>
                    <li class="<?=($pagina == 'cadProduto'? 'active' : '')?>"><a href="../produto/cadastrar.php"><i class="fa fa-tags"></i>Produto</a></li>
                    <li class="<?=($pagina == 'cadPedido'? 'active' : '')?>"><a href="../pedido/cadastrar.php"><i class="fa fa-sticky-note-o"></i>Pedido</a></li>
                </ul>
            </li>
            
            <li class="<?=($pagina == 'viewProduto' || $pagina == 'viewCliente' || $pagina == 'viewPedido' ? 'treeview active' : 'treeview')?>">
                <a href="#"><i class="fa fa-eye"></i> <span>Visualizar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($pagina == 'viewCliente'? 'active' : '')?>"><a href="../cliente/visualizar.php"><i class="fa fa-user"></i>Clientes</a></li>
                    <li class="<?=($pagina == 'viewProduto'? 'active' : '')?>"><a href="../produto/visualizar.php"><i class="fa fa-tags"></i>Produtos</a></li>
                    <li class="<?=($pagina == 'viewPedido'? 'active' : '')?>"><a href="../pedido/visualizar.php"><i class="fa fa-sticky-note-o"></i>Pedidos</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>