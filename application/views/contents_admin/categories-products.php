<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos da Categoria <?php echo $categories[0]->descategory?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("index.php/admin") ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url("index.php/categories") ?>">Categorias</a></li>
            <li><a href="<?php echo base_url("index.php/categories/products/").$categories[0]->idcategory ?>"><?php echo $categories[0]->descategory?></a></li>
            <li class="active"><a href="<?php echo base_url("index.php/admin/products") ?>">Produtos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todos os Produtos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">Id</th>
                                    <th>Nome do Produto</th>
                                    <th style="width: 240px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                                 echo count($productsNoRelated[0]);   var_dump($productsNoRelated[0][0]);exit;
                              if(count($productsNoRelated[0]) > 0){
                                for($i = 0; $i < count($productsNoRelated[0]); $i++) {
                                    echo "<tr>
                                      <td>".$productsNoRelated[0][$i]->idproduct."</td>";
                                    echo "<td>".$productsNoRelated[0][$i]->desproduct."</td>";
                                    echo " <td>"
                                    . "<a href='" . base_url("index.php/categories/add?a=").$productsNoRelated[0][$i]->idproduct."&b=".$categories[0]->idcategory . "' class='btn btn-primary btn-xs pull-right'><i class='fa fa-arrow-right'></i> Adicionar</a>";
                                    echo "</td>
                            </tr>";
                              }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Produtos na Categoria <?php echo $categories[0]->descategory?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">Id</th>
                                    <th>Nome do Produto</th>
                                    <th style="width: 240px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php    
                                
//             echo count($productsRelated[0]);        var_dump($productsRelated[0]);exit;
                               if(count($productsRelated[0]) != 0){ 
                                for($i = 0; $i < count($productsRelated[0]); $i++) {
                                    echo "<tr>"
                                    . "<td>".$productsRelated[0][$i]->idproduct."</td>";
                                    echo "<td>".$productsRelated[0][$i]->desproduct."</td>";
                                    echo "<td>"
                                    . "<a href='" . base_url("index.php/categories/remove?a=").$productsRelated[0][$i]->idproduct."&b=".$categories[0]->idcategory . "' class='btn btn-primary btn-xs pull-right'><i class='fa fa-arrow-left'></i> Remover</a>";
                                    echo "  </td>
                                </tr>";
                               }}else{
                                    echo "<tr>"
                                   ."<td></td></tr>";
                               }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->