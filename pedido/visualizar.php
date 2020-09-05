<?php
  session_cache_expire();
  session_start();
  include '../login/validaLogin.php';
  $pagina = 'viewPedido';
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
    <style>
      .modal .modal-dialog { width: 60%; } 
    </style>
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
      <h4>Pedidos cadastrados no sistema</h4>
      <ol class="breadcrumb">
        <li><a href="../home/dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Visualizar</li>
        <li class="active">Pedidos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pedidos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome cliente</th>
                  <th>E-mail</th>
                  <th>Data e hora</th>
                  <th>Valor total R$</th>
                  <th>Ação</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="pedido in pedidos">
                  <td>{{ pedido.id_pedido}}</td>
                  <td>{{ pedido.nome}}</td>
                  <td>{{ pedido.email}}</td>
                  <td>{{ pedido.data_hora}}</td>
                  <td>{{ pedido.valor_total}}</td>
                  <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-info" ng-click="edit(pedido, $index)"><span class="fa fa-edit"></span> Editar</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" ng-click="deletar(pedido, $index)"><span class="fa fa-trash"></span> Deletar</button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nome cliente</th>
                  <th>E-mail</th>
                  <th>Data e hora</th>
                  <th>Valor total R$</th>
                  <th>Ação</th>
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
            <h4 class="modal-title">Editar pedido do cliente {{update.nome}}</h4>
          </div>
          <div class="modal-body">
            <form id="formPedidoEditar" data-toggle="validator" role="form" >
              <div class="box-body">
                <div id="cliente-group" class="form-group has-feedback">
                  <label>Cliente</label>
                  <select ng-model="update.id_cliente" class="form-control">
                    <option ng-selected="{{cli.id == update.id_cliente}}" ng-repeat="cli in clientes" value="{{cli.id}}">{{cli.nome}}</option>
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
                    <input type="text" class="form-control" required="" ng-model="update.data_hora" data-error="Insira uma data valida!">
                  </div>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="table-responsive">
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
                              <tr ng-repeat="produto in update.produtos">
                                <td>
                                  <input type="checkbox" ng-model="produto.selected"/>
                                </td>
                                <td>
                                  <div id="pedido-group" class="form-group has-feedback">
                                    <select ng-model="produto.id_produto" ng-click="produto.valor = 0">
                                      <option ng-selected="{{pro.id == produto.id_produto}}" ng-repeat="pro in Produtos" value="{{pro.id}}">{{pro.nome}}</option>
                                    </select>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                  </div>
                                </td>
                                <td>
                                  <div ng-if="produto.id_produto">
                                    <img src="{{'data:image/jpeg;base64,' + Produtos[produto.id_produto - 1].foto}}" ng-model="Produtos[produto.id_produto - 1].foto" width="100px" height="100px">
                                  </div>
                                </td>
                                <td>
                                  <div id="pedido-group" class="form-group has-feedback">
                                    <input ng-value="{{ produto.valor > 0 && produto.quantidade > 0 && produto.observacao == '' ? produto.valor : produto.valor = Produtos[produto.id_produto - 1].valor}}" type="text" class="form-control" ng-model="produto.valor" required/>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                  </div>
                                </td>
                                <td>
                                  <div id="pedido-group" class="form-group has-feedback">
                                    <input type="text" pattern="[0-9]+$" class="form-control" ng-model="produto.quantidade" required/>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </td>
                                <td>
                                <div id="pedido-group" class="form-group has-feedback">
                                <input type="text" class="form-control" ng-model="produto.observacao"/>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                          <div class="form-group"></div>
                          <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box">
                          <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
                          <div class="info-box-content">
                          <span class="info-box-text">Valor total</span>
                          <span class="info-box-number">Anterior: {{update.valor_total}} Agora: {{update.valor_total_final}}</span>
                          </div>
                          <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                          </div>
                          <input ng-hide="!Itens.length" type="button" class="btn btn-danger pull-right" ng-click="remove()" value="Remover">
                          <input id="adicionar" type="submit" ng-click="addNew()"class="btn btn-primary addnew pull-right" value=Adicionar>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input name="id" type="hidden" id="id">
                  <input name="action" type="hidden" id="action" value="editar">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger-outline pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" ng-click="editar()" class="btn btn-primary-outline">Salvar alterações</button>
                  </div>
            </form>
            </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
    </script>
    <script>
      var app = angular.module("myapp", []);
      app.config(['$httpProvider', function ($httpProvider) {
              $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
          }]);
      app.controller("ListController", ['$scope', '$http', function ($scope, $http) {
              $scope.Produtos = [];
              $http.get("http://localhost/lanches/produto/serviceCRUD.php", {}).success(function (data) {
                  $scope.Produtos = data.produtos;
              });
      
              $scope.clientes = [];
              $http.get("http://localhost/lanches/cliente/serviceCRUD.php", {}).success(function (data) {
                  $scope.clientes = data.clientes;
              });
              $scope.pedidos = [];
              $http.get("http://localhost/lanches/pedido/serviceCRUD.php", {}).success(function (data) {
                  $scope.pedidos = data.pedidos;
              });
      
              $scope.dataHora = new Date().toLocaleString();
              $scope.btnName = "Update";
              $scope.editar = function () {
                  if ($scope.update.valor_total == $scope.update.valor_total_final) {
                      swal("Ops!", "Você não alterou o pedido!", "error");
                  } else {
                      $http.post(
                              "http://localhost/lanches/pedido/serviceCRUD.php", {
                                  'idCliente': $scope.update.id_cliente,
                                  'idPedido': $scope.update.id_pedido,
                                  'datahora': $scope.update.data_hora,
                                  'produtos': $scope.update.produtos,
                                  'total': $scope.update.valor_total_final,
                                  'btnName': $scope.btnName
                              }
                      ).success(function (data) {
                          if (data.success) {
                              swal("Bom trabalho!", "Pedido alterado com sucesso!", "success");
                              $http.get("http://localhost/lanches/pedido/serviceCRUD.php", {}).success(function (data) {
                                  $scope.pedidos = data.pedidos;
                              });
                              $('#modal-info').modal('hide');
                          } else {
                              swal("Ops!", "Erro ao alterar o pedido, tente novamente!", "error");
                          }
                      });
                  }
              }
      
              $scope.btnNameDelete = "Deletar";
              $scope.deletar = function (pedido, i) {
                  $http.post(
                          "http://localhost/lanches/pedido/serviceCRUD.php", {
                              'idCliente': pedido.id_cliente,
                              'idPedido': pedido.id_pedido,
                              'datahora': pedido.data_hora,
                              'produtos': pedido.produtos,
                              'total': pedido.valor_total_final,
                              'btnName': $scope.btnNameDelete
                          }
                  ).success(function (data) {
                      if (data.success) {
                          swal("Bom trabalho!", "Pedido deletado com sucesso!", "success");
                          $http.get("http://localhost/lanches/pedido/serviceCRUD.php", {}).success(function (data) {
                              $scope.pedidos = data.pedidos;
                          });
                      } else {
                          swal("Ops!", "Erro ao deletar o pedido, tente novamente!", "error");
                      }
                  });
              }
      
      
              $scope.edit = function (pedido, i) {
                  $scope.update = angular.copy(pedido);
                  index = i;
              }
      
              $scope.resetForm = function () {
                  document.getElementById("formPedidoEditar").reset();
                  $scope.Itens.total = 0;
                  var newDataList = [];
                  angular.forEach($scope.Itens, function () {
                      newDataList.push();
                  });
                  $scope.Itens = newDataList;
              }
              $scope.Itens = [
                  {
                      'qtda': '',
                      'obs': ''
                  }];
      
              $scope.addNew = function (produto) {
                  $scope.update.produtos.push({
                      'qtda': "",
                      'obs': ""
                  });
              };
      
              $scope.remove = function () {
                  var newDataList = [];
                  $scope.selectedAll = false;
                  angular.forEach($scope.update.produtos, function (selected) {
                      if (!selected.selected) {
                          newDataList.push(selected);
                      }
                  });
                  $scope.update.produtos = newDataList;
              };
              $scope.$watchCollection('update.produtos', function ( ) {
                  if ($scope.update) {
                      $scope.update.valor_total_final = 0;
                      angular.forEach($scope.update.produtos, function (value, key) {
      
                          if (!value.quantidade == 0) {
                              $scope.update.valor_total_final += value.valor * value.quantidade;
                          }
                      });
                      $scope.update.valor_total_final = Number($scope.update.valor_total_final).toFixed(2);
                  }
      
              });
              $scope.checkAll = function () {
                  if (!$scope.selectedAll) {
                      $scope.selectedAll = true;
                  } else {
                      $scope.selectedAll = false;
                  }
                  angular.forEach($scope.update.produtos, function (produto) {
                      produto.selected = $scope.selectedAll;
                  });
              };
      
      
          }]);
    </script>
    <script>
      $('#modal-info').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var modal = $(this);
      });
      $('#modal-info').on('hide.bs.modal', function (event) {
      
      });
      
    </script>
    <script src="../dist/js/validator.js" type="text/javascript"></script>
  </body>
</html>