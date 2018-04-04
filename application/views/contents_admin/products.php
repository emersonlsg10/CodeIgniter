<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Produtos
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("index.php/admin") ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url("index.php/products") ?>">Produtos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <a href="<?php echo base_url("index.php/products/create") ?>" class="btn btn-success">Cadastrar Produto</a>
                    </div>

                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nome da Produto</th>
                                    <th>Preço</th>
                                    <th>Largura</th>
                                    <th>Altura</th>
                                    <th>Comprimento</th>
                                    <th>Peso</th>
                                    <th style="width: 140px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $value) {
                                    echo "<tr>";
                                    echo "<td>$value->idproduct</td>";
                                    echo "<td>$value->desproduct</td>";
                                    echo "<td>$value->vlprice</td>";
                                    echo "<td>$value->vlwidth</td>";
                                    echo "<td>$value->vlheight</td>";
                                    echo "<td>$value->vllength</td>";
                                    echo "<td>$value->vlweight</td>";
                                    echo "<td>"
                                    . "<a href='" . base_url("index.php/products/update/$value->idproduct") . "' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Editar</a>"
                                    . "<a href='" . base_url("index.php/products/delete/$value->idproduct") . "' onclick='return confirm('Deseja realmente excluir este registro?')' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Excluir</a>"
                                    . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
