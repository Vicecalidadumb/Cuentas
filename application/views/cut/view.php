<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Contratos a cancelar <small>por Fecha</small>
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
                        Contratos a Cancelar por Corte
                    </a>
                </li>                    
            </ul>

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
                            <i class="fa fa-cogs"></i>Listado de Contratos a Calcelar
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <h1>
                            Seleccione la Fecha
                            <small style="color:#f37720 !important">
                                <script>
                                    function redirect(route) {
                                        window.location.href = "<?php echo base_url(""); ?>" + "cut/view_cut/" + route
                                    }
                                </script>
                                <?php
                                echo form_dropdown('date', $date, $select, 'class="form-control" style="color: #F37720 !important;" onchange="redirect(this.value)"');
                                ?>
                            </small>
                        </h1>  
                        <?php $cut_day = get_cut_day(); ?>
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Profesion</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>Proyecto</th>
                                    <th>Corte</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($registros as $registro) {
                                    foreach ($contractok as $contract) {
                                        if ($contract['id'] == $registro->CONTRATO_ID) {
                                            ?>
                                            <tr <?php echo ($registro->CONTRATO_ESTADO == 0) ? 'class="danger"' : '' ?>>
                                                <td>
                                                    <?php echo $count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $registro->HV_NOMBRES . ' ' . $registro->HV_APELLIDOS; ?>
                                                </td>
                                                <td>
                                                    <?php echo $registro->HV_TIPODOCUMENTO . ' ' . $registro->HV_NUMERODOCUMENTO; ?>
                                                </td>
                                                <td>
                                                    <?php echo $registro->HV_PROFESION; ?>
                                                </td>                                            
                                                <td>
                                                    <?php echo $registro->CONTRATO_FECHAINI; ?>
                                                </td>
                                                <td>
                                                    <?php echo $registro->CONTRATO_FECHAFIN; ?>
                                                </td>   
                                                <td>
                                                    <?php echo $registro->PROYECTO_NOMBRE; ?>
                                                </td>
                                                <td>
                                                    <?php echo $cut_day[date("j", strtotime($registro->CONTRATO_FECHAINI))] ?>
                                                    <?php echo ', D&iacute;a de Pago:' . get_cutday_id($cut_day[date("j", strtotime($registro->CONTRATO_FECHAINI))]); ?>
                                                </td>                                            
                                                <td>
                                                    <a href="<?php echo base_url('contract/info_documents/' . encrypt_id($registro->CONTRATO_ID)) ?>" class="btn default btn-xs yellow" data-target="#ajax<?php echo $registro->CONTRATO_ID; ?>" data-toggle="modal">
                                                        <i class="fa fa-folder-open"></i>
                                                        Ver Info.
                                                    </a>
                                                    <div class="modal fade" id="ajax<?php echo $registro->CONTRATO_ID; ?>" role="basic" aria-hidden="true">
                                                        <div class="page-loading page-loading-boxed">
                                                            <img src="<?php echo base_url('/assets/global/img/loading-spinner-grey.gif') ?>" alt="" class="loading">
                                                            <span>
                                                                &nbsp;&nbsp;Cargando Informaci&oacute;n... 
                                                            </span>
                                                        </div>
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </td>                                        
                                            </tr>
                                            <?php
                                            $count++;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
