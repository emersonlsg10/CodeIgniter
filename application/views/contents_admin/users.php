<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lista de Usuários
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="/admin/users">Usuários</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <a href="<?php echo base_url("index.php/admin/userscreate") ?>" class="btn btn-success">Cadastrar Usuário</a>
                    </div>

                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Login</th>
                                    <th style="width: 60px">Admin</th>
                                    <th style="width: 140px">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                function inadmin($param) {

                                    if ($param == 1) {
                                        return $param = "sim";
                                    } else {
                                        return $param = "não";
                                    }
                                }

                                foreach ($users as $user) {
                                    echo "<tr>";
                                    echo "<td>$user->iduser </td>";
                                    echo "<td>$user->desperson </td>";
                                    echo "<td>$user->desemail </td>";
                                    echo "<td>$user->deslogin </td>";
                                    echo "<td>". inadmin($user->inadmin)."</td>";
                                    
                                    echo "<td>"
                                    ."<a href='". base_url("index.php/admin/usersUpdate/$user->iduser") ."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Editar</a>"
                                    ."<a href='". base_url("index.php/admin/delete/$user->iduser")."' onclick = 'return confirm('Deseja realmente excluir este registro?')' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Excluir</a>"    
                                    ."</td>";
                                echo "</tr>";}
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