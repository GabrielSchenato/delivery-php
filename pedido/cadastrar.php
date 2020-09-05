<?php
session_cache_expire();
session_start();
include '../login/validaLogin.php';
$pagina = 'cadPedido';
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
        <!-- Select 2 -->
        <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
        <!-- Datepicker -->
        <link rel="stylesheet" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">   
        <!-- Font Google -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.32/angular.min.js"></script>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-black sidebar-mini" ng-app="myapp" ng-controller="ListController">
        <div class="wrapper">

            <?php
            include '../menu/menu.php';
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h4>Insira as informações para realizar o cadastro de um pedido</h4>
                    <ol class="breadcrumb">
                        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li>Cadastrar</li>
                        <li class="active">Pedido</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">

                    <div style="    margin: 0 auto !important;
                         float: none !important; "class="col-md-10">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cadastrar Pedido</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div id="loader" style="display:none;" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                            <form id="formPedido" data-toggle="validator" role="form" >
                                <div class="box-body">

                                    <div id="cliente-group" class="form-group has-feedback">
                                        <label>Cliente</label>
                                        <select class="form-control select2" style="width: 100%;" required="" ng-model="clienteSelecionado">
                                            <option value="">Selecione um cliente</option>
                                            <option ng-repeat="(key ,cliente) in clientes" ng-value="cliente.id">{{ cliente.nome }}</option>
                                        </select>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div id="data-group" class="form-group has-feedback">
                                        <label>Data e hora</label>                                        
                                        <div class='input-group date' id='datetimepicker'>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" class="form-control" required="" ng-model="dataHora" data-error="Insira uma data valida!">
                                        </div>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <div class="help-block with-errors"></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-body">

                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th>
                                                                <th>Produto</th>
                                                                <th>Foto</th>
                                                                <th>Valor</th>
                                                                <th>Quantidade</th>
                                                                <th>Observação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr ng-repeat="Item in Itens">
                                                                <td>
                                                                    <input type="checkbox" ng-model="Item.selected"/></td>
                                                                <td>
                                                                    <div id="pedido-group" class="form-group has-feedback">
                                                                        <select ng-options="produto as produto.nome for produto in produtos track by produto.id" ng-model="Item.produtoSelecionado">
                                                                            <option value="">Selecione um produto</option>
                                                                        </select>
                                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                        <div class="help-block with-errors"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div ng-if="Item.produtoSelecionado.foto">
                                                                    <img src="{{'data:image/jpeg;base64,' + Item.produtoSelecionado.foto}}" ng-model="Item.produtoSelecionado.foto" width="100px" height="100px">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="pedido-group" class="form-group has-feedback">
                                                                        <input type="text" class="form-control" ng-model="Item.produtoSelecionado.valor" required/>
                                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                        <div class="help-block with-errors"></div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="pedido-group" class="form-group has-feedback">
                                                                        <input type="number" pattern="[0-9]+$" class="form-control" ng-model="Item.qtda" required/>
                                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                        <div class="help-block with-errors"></div>
                                                                </td>
                                                                <td>
                                                                    <div id="pedido-group" class="form-group has-feedback">
                                                                        <input type="text" class="form-control" ng-model="Item.obs"/>
                                                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                        <div class="help-block with-errors"></div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="form-group"></div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                        <div class="info-box">
                                                            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                                                            <div class="info-box-content">
                                                                <span class="info-box-text">Valor total</span>
                                                                <span class="info-box-number">{{Itens.total}}</span>
                                                            </div>
                                                            <!-- /.info-box-content -->
                                                        </div>
                                                        <!-- /.info-box -->
                                                    </div>
                                                    <input ng-hide="!Itens.length" type="button" class="btn btn-danger pull-right" ng-click="remove()" value="Remover">
                                                    <input type="submit" ng-click="addNew()"class="btn btn-primary addnew pull-right" value=Adicionar>
                                                </div>

                                            </div>                                            
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="button" ng-click="resetForm();" class="btn btn-danger btn-lg col-sm-3 col-sm-6 col-sm-3"><span class="fa fa-close"></span> Cancelar</button>
                                    <button type="submit" ng-click="insert()" class="btn btn-primary pull-right btn-lg col-sm-3 col-sm-6 col-sm-3"><span class="fa fa-save"></span> Cadastrar</button>
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
            <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
            <script src="../bower_components/select2/dist/js/i18n/pt-BR.js" type="text/javascript"></script>
            <script src="../bower_components/moment/min/moment-with-locales.min.js" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
            <script>       
                $(function () {
                    $('#datetimepicker').datetimepicker({
                    format: 'DD/MM/YYYY HH:mm:ss',
                    locale: 'pt-br'
                });
                });
                $("#idCliente").select2({
                    "language": "pt-BR"
                });
                
                function resetaForm(){
                    document.getElementById("formCliente").reset();
                }
            </script>
            <script src="../dist/js/validator.js" type="text/javascript"></script>
            <script>
                var app = angular.module("myapp", []);
                app.config(['$httpProvider', function($httpProvider) {
                    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
                }]);
            app.controller("ListController", ['$scope','$http' , function($scope,$http) {
                $scope.produtos = [];
                $http.get("http://localhost/produto/serviceCRUD.php", {  }).success(function(data) {
                $scope.produtos = data.produtos;
                });
                
                $scope.clientes = [];
                $http.get("http://localhost/cliente/serviceCRUD.php", {  }).success(function(data) {
                $scope.clientes = data.clientes;
                });
                $scope.dataHora = new Date().toLocaleString();
                    $scope.btnName = "Insert";
    $scope.insert = function() {
        if($scope.Itens.total == 0){
            swal("Ops!", "Preencha algum produto no pedido!", "error");
        }else{
       
            $http.post(
                "http://localhost/pedido/serviceCRUD.php", {
                    'idCliente': $scope.clienteSelecionado,
                    'datahora': $scope.dataHora,
                    'produtos': $scope.Itens,
                    'total': $scope.Itens.total,
                    'btnName': $scope.btnName
                }
            ).success(function(data) {
                if (data.success) {
                    swal("Bom trabalho!", "Pedido cadastrado com sucesso!", "success");
                    $scope.resetForm();
                }else{
                    swal("Ops!", "Erro ao cadastrar o pedido, tente novamente!", "error");
                }
            });
        }}
            $scope.resetForm = function() {
                                    document.getElementById("formPedido").reset();
                                $scope.Itens.total = 0;
                                var newDataList=[];
                                    angular.forEach($scope.Itens, function(){
                                        newDataList.push();
                                    }); 
                                $scope.Itens = newDataList;
            }
                $scope.Itens = [
                    {
                        'qtda':'',
                        'obs':''
                    }];

                    $scope.addNew = function(Item){
                        $scope.Itens.push({ 
                            'qtda': "",
                            'obs': "",
                        });
                    };

                    $scope.remove = function(){
                        var newDataList=[];
                        $scope.selectedAll = false;
                        angular.forEach($scope.Itens, function(selected){
                            if(!selected.selected){
                                newDataList.push(selected);
                            }
                        }); 
                        $scope.Itens = newDataList;
                    };
                $scope.$watchCollection('Itens',function() {
                  $scope.Itens.total = 0;  
                  angular.forEach($scope.Itens, function(value, key) {
                      if(value.qtda == ''){
                          
                      }else{
                    $scope.Itens.total += value.produtoSelecionado.valor * value.qtda;}
                  });
                });
                $scope.checkAll = function () {
                    if (!$scope.selectedAll) {
                        $scope.selectedAll = true;
                    } else {
                        $scope.selectedAll = false;
                    }
                    angular.forEach($scope.Itens, function(Item) {
                        Item.selected = $scope.selectedAll;
                    });
                };    


            }]);
        </script>
    </body>
</html>