<?php
session_cache_expire();
session_start();
include '../login/validaLogin.php';
$pagina = 'viewCliente';
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
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
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
                    <h4>Clientes cadastrados no sistema</h4>
                    <ol class="breadcrumb">
                        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li>Visualizar</li>
                        <li class="active">Clientes</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Clientes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" id="btnEditar" disabled=""><span class="fa fa-edit"></span> Editar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" id="btnDeletar" disabled=""><span class="fa fa-trash"></span> Deletar</button>
                                </br>
                                </br>
                                <table id="tableClientes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>CEP</th>
                                            <th>Rua</th>
                                            <th>Número</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th>UF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>CEP</th>
                                            <th>Rua</th>
                                            <th>Número</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th>UF</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <div class="modal modal-open fade" id="modal-info">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="formClienteEditar" method="POST" action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                                        <div class="box-body">

                                            <div id="nome-group" class="form-group has-feedback">
                                                <label>Nome completo</label>
                                                <input type="text" id="nome" name="nome" class="form-control" required="">
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div id="email-group" class="form-group has-feedback">
                                                <label>E-mail</label>
                                                <input type="email" id="email" name="email" class="form-control" required="">
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
                                        <input name="id" type="hidden" id="id">
                                        <input name="action" type="hidden" id="action" value="editar">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger-outline pull-left" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary-outline">Salvar alterações</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal modal-danger fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Deletar </h4>
                                </div>
                                <div class="modal-body">
                                    <form id="formClienteDeletar" method="POST" action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <p>Atenção, isso irá excluir o cliente!</p>
                                            <h1>Confirme a exclusão do cliente!</h1>                                                      
                                            <input name="id" type="hidden" id="id">
                                            <input name="action" type="hidden" id="action" value="deletar">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-outline">Deletar</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
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
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../bower_components/moment/min/moment.min.js"></script>
    <script src="../bower_components/moment/min/datetime-moment.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var table;
        $(function () {
            $.fn.dataTable.moment('D/M/YYYY');
            table = $('#tableClientes').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'responsive': true,
                select: {
                    style: 'single'
                },
                "ajax": {
                    "url": 'serviceCRUD.php',
                    "dataSrc": "clientes"
                },
                "columns": [
                    {"data": "id"},
                    {"data": "nome"},
                    {"data": "email"},
                    {"data": "cep"},
                    {"data": "rua"},
                    {"data": "numero"},
                    {"data": "bairro"},
                    {"data": "cidade"},
                    {"data": "uf"}
                ],

                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    select: {
                        rows: "%d linha selecionada"
                    },
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }

            });
        });
        var id;
        var nome;
        var email;
        var cep;
        var rua;
        var numero;
        var bairro;
        var cidade;
        var uf;
        $('#tableClientes tbody').on('click', 'tr', function () {
            document.getElementById("btnEditar").disabled = false;
            document.getElementById("btnDeletar").disabled = false;
            id = table.row(this).data().id;
            nome = table.row(this).data().nome;
            email = table.row(this).data().email;
            cep = table.row(this).data().cep;
            rua = table.row(this).data().rua;
            numero = table.row(this).data().numero;
            bairro = table.row(this).data().bairro;
            cidade = table.row(this).data().cidade;
            uf = table.row(this).data().uf;
        });

        $('#modal-info').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);
            modal.find('.modal-title').text('Alterar dados do cliente ' + nome);
            modal.find('#id').val(id);
            modal.find('#nome').val(nome);
            modal.find('#email').val(email);
            modal.find('#cep').val(cep);
            modal.find('#rua').val(rua);
            modal.find('#numero').val(numero);
            modal.find('#bairro').val(bairro);
            modal.find('#cidade').val(cidade);
            modal.find('#uf').val(uf);
        });

        $('#modal-danger').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var modal = $(this);
            modal.find('.modal-title').text('Deletar o cliente ' + nome);
            modal.find('#id').val(id);
        });

    </script>
    <script>
        $(document).ready(function () {

            // process the form
            $('#formClienteEditar').submit(function (event) {
                $('.form-group').removeClass('has-error'); // remove the error class
                $('.help-block').remove(); // remove the error text
                // process the form
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: 'serviceCRUD.php', // the url where we want to POST
                    data: $("#formClienteEditar").serialize(), // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                        // using the done promise callback
                        .done(function (data) {

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
                                table.ajax.reload();
                                $('#modal-info').modal('hide');
                            }
                        });
                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            });

        });

        $(document).ready(function () {
            // process the form
            $('#formClienteDeletar').submit(function (event) {
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: 'serviceCRUD.php', // the url where we want to POST
                    data: $("#formClienteDeletar").serialize(), // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                        // using the done promise callback
                        .done(function (data) {

                            if (!data.success) {
                            } else {
                                table.ajax.reload();
                                $('#modal-danger').modal('hide');
                            }
                        });
                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            });

        });
    </script>
    <!-- Script busca endereço -->
    <script type="text/javascript" >

        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function () {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

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