<?php
session_cache_expire();
session_start();
include '../login/validaLogin.php';
$pagina = 'viewProduto';
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
                    <h4>Produtos cadastrados no sistema</h4>
                    <ol class="breadcrumb">
                        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li>Visualizar</li>
                        <li class="active">Produtos</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Produtos</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" id="btnEditar" disabled=""><span class="fa fa-edit"></span> Editar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" id="btnDeletar" disabled=""><span class="fa fa-trash"></span> Deletar</button>
                                </br>
                                </br>
                                <table id="tableProdutos" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Foto</th>
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
                              <form id="formProdutoEditar" method="POST" action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                                <div class="box-body">
                                    
                                    <div id="nome-group" class="form-group has-feedback">
                                        <label>Nome do produto</label>
                                        <input type="text" name="nome" id="nome" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div id="descricao-group" class="form-group has-feedback">
                                        <label >Descrição</label>
                                        <input type="text" name="descricao"  id="descricao" class="form-control" required="">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div id="valor-group" class="form-group has-feedback">
                                        <label>Valor</label>
                                        <input type="text" name="valor" id="valor" class="form-control" required="" pattern="([0-9]{1,3}\.)?[0-9]{1,3}.[0-9]{2}$">
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
                               <form id="formProdutoDeletar" method="POST" action="" data-toggle="validator" role="form" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <p>Atenção, isso irá excluir o produto!</p>
                                    <h1>Confirme a exclusão do produto!</h1>                                                      
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
                    table = $('#tableProdutos').DataTable({
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
                            "dataSrc": function (json) {
                            var return_data = new Array();
                            for(var i=0;i< json.produtos.length; i++){
                              return_data.push({
                                'id': json.produtos[i].id,
                                'nome': json.produtos[i].nome,
                                'descricao': json.produtos[i].descricao,
                                'valor': json.produtos[i].valor,
                                'foto'  : json.produtos[i].foto,
                                'img'  : '<img src="data:image/jpeg;base64,' + json.produtos[i].foto + '" width="100px" height="100px">'
                              });
                            }
                            return return_data;
                          }
                        },
                        "columns": [
                            {"data": "id"},
                            {"data": "nome"},
                            {"data": "descricao"},
                            {"data": "valor"},                            
                            {"data": "img"},
                            {"data": "foto", "visible": false, "searchable": false}
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
var descricao;
var valor;
var foto;
                $('#tableProdutos tbody').on( 'click', 'tr', function () {
                    document.getElementById("btnEditar").disabled = false;
                    document.getElementById("btnDeletar").disabled = false;
                    id = table.row( this ).data().id;
                    nome = table.row( this ).data().nome;
                    descricao = table.row( this ).data().descricao;
                    valor = table.row( this ).data().valor;
                    foto = table.row( this ).data().foto;
                } );

         $('#modal-info').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget); // Button that triggered the modal
             var modal = $(this);
             modal.find('.modal-title').text('Alterar dados do produto ' + nome);
             modal.find('#id').val(id);
             modal.find('#nome').val(nome);
             modal.find('#descricao').val(descricao);
             modal.find('#valor').val(valor);
             modal.find('#foto').val(foto);
         });
         
         $('#modal-danger').on('show.bs.modal', function (event) {
             var button = $(event.relatedTarget); // Button that triggered the modal
             var modal = $(this);
             modal.find('.modal-title').text('Deletar o produto ' + nome);
             modal.find('#id').val(id);
         });

            </script>
            <script>
            $(document).ready(function () {

                // process the form
                $('#formProdutoEditar').submit(function (event) {
                    var formData = new FormData(this);
                    $('.form-group').removeClass('has-error'); // remove the error class
                    $('.help-block').remove(); // remove the error text
                    // process the form
                    $.ajax({
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
                $('#formProdutoDeletar').submit(function (event) {
                    $.ajax({
                        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url: 'serviceCRUD.php', // the url where we want to POST
                        data: $("#formProdutoDeletar").serialize(), // our data object
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
            
            <script>
                function bs_input_file() {
                    $(".input-file").before(
                            function() {
                                    if ( ! $(this).prev().hasClass('input-ghost') ) {
                                            var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
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
           
            </script>
            
            <script src="../dist/js/validator.js" type="text/javascript"></script>
    </body>
</html>