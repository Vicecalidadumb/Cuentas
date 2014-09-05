<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Cortes <small>para Pagos</small>
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
                    <a href="<?php echo base_url('cut') ?>">
                        Cortes
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
                            <a href="<?php echo base_url('cut/add') ?>">
                                Agregar un Nuevo Corte
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
                            <i class="fa fa-cogs"></i>Listado de Cortes
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <a href="<?php echo base_url('cut/add') ?>" class="btn blue">
                            Agregar Registro <i class="fa fa-plus"></i>
                        </a>

                        <div class="table-scrollable">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Administrativo</th>
                                        <th>Dia de Pago</th>
                                        <th>Dia de Inicio</th>
                                        <th>Dia Final</th>
                                        <th>Usuario Creador</th>
                                        <th>Fecha de Creación</th>
                                        <th>Opciones</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($cuts as $cut) {
                                        ?>
                                        <tr <?php echo ($cut->USUARIO_ESTADO == 0) ? 'class="danger"' : '' ?>>
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->CORTE_NOMBREADMIN; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->CORTE_DIAPAGO; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->CORTE_DIAINICIO; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->CORTE_DIAFIN; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->USUARIO_NOMBRES . ' ' . $cut->USUARIO_APELLIDOS; ?>
                                            </td>
                                            <td>
                                                <?php echo $cut->CORTE_FECHACREACION; ?>
                                            </td>                                            
                                            <td>
                                                <a href="<?php echo base_url('cut/edit/'.encrypt_id($cut->CORTE_ID)) ?>" class="btn default btn-xs purple">
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
