<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Usuarios <small>del Sistema</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo base_url('desk') ?>">
                        Escritorio
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo base_url('user') ?>">
                        Usuarios
                    </a>
                </li>                    
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                        Acciones <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="<?php echo base_url('user/add') ?>">
                                Agregar un Nuevo Registro
                            </a>
                        </li>
                    </ul>
                </div>
            </div>            
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix">
        </div>

        <div class="col-md-12 col-sm-12">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>          
        </div>        

        <div class="row ">
            <div class="col-md-12 col-sm-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Listado de Usuarios
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <a href="<?php echo base_url('user/add') ?>" class="btn blue">
                            Agregar Registro <i class="fa fa-plus"></i>
                        </a>

                        <div class="table-scrollable">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                        <th>Correo</th>
                                        <th>Telefonos</th>
                                        <th>Rol</th>
                                        <th>Fecha de Creación</th>
                                        <th>Opciones</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($registros as $registro) {
                                        ?>
                                        <tr <?php echo ($registro->USUARIO_ESTADO == 0) ? 'class="danger"' : '' ?>>
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $registro->USUARIO_NOMBRES.' '.$registro->USUARIO_APELLIDOS; ?>
                                            </td>
                                            <td>
                                                <?php echo $registro->USUARIO_TIPODOCUMENTO.' '.$registro->USUARIO_NUMERODOCUMENTO; ?>
                                            </td>
                                            <td>
                                                <?php echo $registro->USUARIO_CORREO; ?>
                                            </td>                                            
                                            <td>
                                                <?php echo $registro->USUARIO_TELEFONOFIJO.' - '.$registro->USUARIO_CELULAR; ?>
                                            </td>
                                            <td>
                                                <?php echo $registro->NOM_TIPO_USU; ?>
                                            </td>
                                            <td>
                                                <?php echo $registro->USUARIO_FECHAINGRESO; ?>
                                            </td>                                         
                                            <td>
                                                <a href="<?php echo base_url('user/edit/'.encrypt_id($registro->USUARIO_ID)) ?>" class="btn default btn-xs purple">
                                                    <i class="fa fa-edit"></i> 
                                                    Editar 
                                                </a>                                              
                                            </td>                                        
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
