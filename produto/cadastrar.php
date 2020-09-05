<?php
session_cache_expire();
session_start();
include '../login/validaLogin.php';
$pagina = 'cadProduto';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Awesome | Lanches</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- Skin -->
        <link rel="stylesheet" href="../dist/css/skins/skin-black.min.css">
        <!-- Font Google -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-black sidebar-mini">
        <div class="wrapper">

            <?php
            include '../menu/menu.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h4>Insira as informações para realizar o cadastro de um produto</h4>
                    <ol class="breadcrumb">
                        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li>Cadastrar</li>
                        <li class="active">Produto</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">

                    <div style="    margin: 0 auto !important;
                         float: none !important; "class="col-md-10">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cadastrar Produto</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div id="loader" style="display:none;" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                            <form id="formProduto" method="POST" action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                                <div class="box-body">
                                    
                                    <div id="nome-group" class="form-group has-feedback">
                                        <label>Nome do produto</label>
                                        <input type="text" name="nome" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div id="descricao-group" class="form-group has-feedback">
                                        <label >Descrição</label>
                                        <input type="text" name="descricao" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div id="valor-group" class="form-group has-feedback">
                                        <label>Valor</label>
                                        <input type="text" name="valor" class="form-control" required="" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    
                                    <div id="foto-group" class="form-group has-feedback">
                                        <label>Foto</label>
                                        <div class="input-group input-file" name="foto">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose" type="button">Escolher</button>
                                            </span>
                                            <input type="text" class="form-control" placeholder='Escolher uma foto...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-warning btn-reset" type="button">Resetar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="alert alert-info alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h4><i class="icon fa fa-info"></i> Atenção!</h4>
                                      <ul>
                                          <li>Os formatos de imagem aceitos são: jpg, jpeg, png e gif.</li>
                                          <li>O tamanho máximo de upload permitido é de 5MB.</li>
                                      </ul>                                       
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="button" onclick="resetaForm();" class="btn btn-danger btn-lg col-sm-3 col-sm-6 col-sm-3"><span class="fa fa-close"></span> Cancelar</button>
                                    <button type="submit" class="btn btn-primary pull-right btn-lg col-sm-3 col-sm-6 col-sm-3"><span class="fa fa-save"></span> Cadastrar</button>
                                </div>
                                <!-- /.box-footer -->
                        </div>                                  
                        </form>
                           
                    </div> 

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php
            include '../footer/footer.php';
            ?>

            <!-- ./wrapper -->

            <!-- REQUIRED JS SCRIPTS -->

            <!-- jQuery 3 -->
            <script src="../bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
            <!-- Script cadastra cliente -->
            <script>
                            $(document).ready(function () {

                // process the form
                $('form').submit(function (event) {
                    var formData = new FormData(this);
                    $('.form-group').removeClass('has-error'); // remove the error class
                    $('.help-block').remove(); // remove the error text
                    // process the form
                    $.ajax({
                        beforeSend: function () {
                            $("#loader").show();
                        },
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'serviceCRUD.php', // the url where we want to POST
                        data: formData, // our data object
                        contentType: false, 
                        processData: false,
                        dataType: 'json', // what type of data do we expect back from the server
                        encode: true
                    })
                            // using the done promise callback
                            .done(function (data) {
                                setTimeout(function () {
                                    $("#loader").hide();
                                }, 500);

                                if (!data.success) {

                                    // handle errors for name ---------------
                                    if (data.errors.nome) {
                                        $('#nome-group').addClass('has-error'); // add the error class to show red input
                                        $('#nome-group').append('<span class="help-block">' + data.errors.nome + '</span>'); // add the actual error message under our input
                                    }

                                    // handle errors for descricao ---------------
                                    if (data.errors.descricao) {
                                        $('#descricao-group').addClass('has-error'); // add the error class to show red input
                                        $('#descricao-group').append('<span class="help-block">' + data.errors.descricao + '</span>'); // add the actual error message under our input
                                    }
                                    
                                    // handle errors for valor ---------------
                                    if (data.errors.valor) {
                                        $('#valor-group').addClass('has-error'); // add the error class to show red input
                                        $('#valor-group').append('<span class="help-block">' + data.errors.valor + '</span>'); // add the actual error message under our input
                                    }

                                    // handle errors for superhero alias ---------------
                                    if (data.errors.foto) {
                                        swal("Ops!", data.errors.foto, "error");
                                    }
                                  
                                    if (data.errors.errosql) {
                                        swal("Ops!", data.errors.errosql, "error");
                                    }
                                } else {

                                    // ALL GOOD! just show the success message!
                                    swal("Bom trabalho!", "Produto cadastrado com sucesso!", "success");
                                    resetaForm();

                                }
                            });
                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });

            });
            </script>
            <script>
                function bs_input_file() {
                    $(".input-file").before(
                            function() {
                                    if ( ! $(this).prev().hasClass('input-ghost') ) {
                                            var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' required>");
                                            element.attr("name",$(this).attr("name"));
                                            element.change(function(){
                                                    element.next(element).find('input').val((element.val()).split('\\').pop());
                                            });
                                            $(this).find("button.btn-choose").click(function(){
                                                    element.click();
                                            });
                                            $(this).find("button.btn-reset").click(function(){
                                                    element.val(null);
                                                    $(this).parents(".input-file").find('input').val('');
                                            });
                                            $(this).find('input').css("cursor","pointer");
                                            $(this).find('input').mousedown(function() {
                                                    $(this).parents('.input-file').prev().click();
                                                    return false;
                                            });
                                            return element;
                                    }
                            }
                    );
            }
            $(function() {
                    bs_input_file();
            });
            
            function resetaForm(){
                document.getElementById("formProduto").reset();
                document.getElementById("formProduto").reset();
            }
            </script>
            <script src="../dist/js/validator.js" type="text/javascript"></script>
    </body>
</html>