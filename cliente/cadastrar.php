<?php
session_cache_expire();
session_start();
include '../login/validaLogin.php';
$pagina = 'cadCliente';
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
                    <h4>Insira as informações para realizar o cadastro de um cliente</h4>
                    <ol class="breadcrumb">
                        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li>Cadastrar</li>
                        <li class="active">Cliente</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">

                    <div style="    margin: 0 auto !important;
                         float: none !important; "class="col-md-10">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cadastrar Cliente</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div id="loader" style="display:none;" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                            <form id="formCliente" method="POST" action="" data-toggle="validator" role="form">
                                <div class="box-body">

                                    <div id="nome-group" class="form-group has-feedback">
                                        <label>Nome completo</label>
                                        <input type="text" name="nome" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    
                                    <div id="email-group" class="form-group has-feedback">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div id="cep-group" class="form-group has-feedback">                                        
                                        <label >CEP</label>
                                        <input name="cep" type="text" id="cep" value="" size="8" maxlength="8" class="form-control" required="" pattern="[0-9]+$">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>                                      
                                    </div>
                                    <div id="cep-group" class="form-group has-feedback">  
                                        <label >Rua</label>
                                        <input name="rua" type="text" id="rua" size="220" class="form-control" readonly="readonly" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div id="cep-group" class="form-group has-feedback">
                                        <label >Número</label>
                                        <input name="numero" type="text" id="numero" size="50" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>    
                                    <div id="cep-group" class="form-group has-feedback">      
                                        <label >Bairro</label>
                                        <input name="bairro" type="text" id="bairro" size="220" class="form-control" readonly="readonly" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>    
                                    <div id="cep-group" class="form-group has-feedback">     
                                        <label >Cidade</label>
                                        <input name="cidade" type="text" id="cidade" size="220" class="form-control" readonly="readonly" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>   
                                    <div id="cep-group" class="form-group has-feedback">      
                                        <label >Estado</label>
                                        <input name="uf" type="text" id="uf" size="2" class="form-control" readonly="readonly" required="" maxlength="2">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
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
            <script>
                function resetaForm(){
                    document.getElementById("formCliente").reset();
                }
            </script>
            <!-- Script cadastra cliente -->
            <script>
                            $(document).ready(function () {

                // process the form
                $('form').submit(function (event) {
                    $('.form-group').removeClass('has-error'); // remove the error class
                    $('.help-block').remove(); // remove the error text
                    // process the form
                    $.ajax({
                        beforeSend: function () {
                            $("#loader").show();
                        },
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'serviceCRUD.php', // the url where we want to POST
                        data: $("form").serialize(), // our data object
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

                                    // handle errors for email ---------------
                                    if (data.errors.email) {
                                        $('#email-group').addClass('has-error'); // add the error class to show red input
                                        $('#email-group').append('<span class="help-block">' + data.errors.email + '</span>'); // add the actual error message under our input
                                    }

                                    // handle errors for superhero alias ---------------
                                    if (data.errors.endereco) {
                                        swal("Ops!", data.errors.endereco, "error");
                                    }
                                  
                                    if (data.errors.errosql) {
                                        swal("Ops!", data.errors.errosql, "error");
                                    }
                                } else {

                                    // ALL GOOD! just show the success message!
                                    swal("Bom trabalho!", "Cliente cadastrado com sucesso!", "success");
                                    resetaForm();

                                }
                            });
                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });

            });
            </script>
            
            <!-- Script busca endereço -->
            <script type="text/javascript" >

                $(document).ready(function() {

                    function limpa_formulário_cep() {
                        // Limpa valores do formulário de cep.
                        $("#rua").val("");
                        $("#bairro").val("");
                        $("#cidade").val("");
                        $("#uf").val("");
                        $("#ibge").val("");
                    }

                    //Quando o campo cep perde o foco.
                    $("#cep").blur(function() {

                        //Nova variável "cep" somente com dígitos.
                        var cep = $(this).val().replace(/\D/g, '');

                        //Verifica se campo cep possui valor informado.
                        if (cep != "") {

                            //Expressão regular para validar o CEP.
                            var validacep = /^[0-9]{8}$/;

                            //Valida o formato do CEP.
                            if(validacep.test(cep)) {

                                //Preenche os campos com "..." enquanto consulta webservice.
                                $("#rua").val("...");
                                $("#bairro").val("...");
                                $("#cidade").val("...");
                                $("#uf").val("...");
                                $("#ibge").val("...");

                                //Consulta o webservice viacep.com.br/
                                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                    if (!("erro" in dados)) {
                                        //Atualiza os campos com os valores da consulta.
                                        $("#rua").val(dados.logradouro);
                                        $("#bairro").val(dados.bairro);
                                        $("#cidade").val(dados.localidade);
                                        $("#uf").val(dados.uf);
                                        $("#ibge").val(dados.ibge);
                                    } //end if.
                                    else {
                                        //CEP pesquisado não foi encontrado.
                                        limpa_formulário_cep();
                                        swal("Ops!", 'CEP não encontrado.', "error");
                                    }
                                });
                            } //end if.
                            else {
                                //cep é inválido.
                                limpa_formulário_cep();
                                swal("Ops!", 'Formato de CEP inválido.', "error");
                            }
                        } //end if.
                        else {
                            //cep sem valor, limpa formulário.
                            limpa_formulário_cep();
                        }
                    });
                });

            </script>
            <script src="../dist/js/validator.js" type="text/javascript"></script>
    </body>
</html>