<link href="<?php echo base_url('/assets/admin/pages/css/profile.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">
        Informaci&oacute;n del <small>Contrado</small>
    </h4>
</div>
<h3 class="page-title">

</h3>


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
        <?php //echo '<pre>' . print_r($registro, true) . '</pre>'; ?>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Documentos del Contrado
                </div>
            </div>
            <div class="portlet-body">
                <!-- INICIO PERFIL-->
                <div class="row profile">
                    <div class="col-md-3">
                        <ul class="list-unstyled profile-nav">
                            <li>
                                <?php
                                $image = ($registro[0]->HV_GENERO == 'F') ? '/images/vice/user_f.png' : '/images/vice/user_h.png';
                                ?>
                                <img src="<?php echo base_url($image); ?>" class="img-responsive" alt=""/>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 profile-info">
                                <h1>
                                    <?php echo $registro[0]->HV_NOMBRES . ' ' . $registro[0]->HV_APELLIDOS ?>
                                </h1>
                                <p></p>
                                <ul class="list-inline">
                                    <li>
                                        <i class="fa fa-calendar"></i> <?php echo $registro[0]->HV_FECHADENACIMIENTO ?>
                                    </li>
                                    <li>
                                        <i class="fa fa-mortar-board"></i> <?php echo $registro[0]->HV_PROFESION ?>
                                    </li>
                                    <li>
                                        <i class="fa fa-money"></i> $<?php echo number_format($registro[0]->CONTRATO_VALOR, 2, '.', '.') ?>
                                    </li>                                            
                                </ul>
                                <p>
                                <ul class="media-list">
                                    <li class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="<?php echo base_url($registro[0]->PROYECTO_IMAGEN) ?>" alt="64x64" data-src="holder.js/64x64" style="width: 64px; height: 64px;">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $registro[0]->PROYECTO_NOMBRE ?></h4>
                                            <p>
                                                <?php echo $registro[0]->PROYECTO_DESCRIPCION ?>
                                            </p>
                                        </div>
                                    </li>
                                </ul>                                            
                                </p>
                                <p>
                                    Correo Electronico: <?php echo $registro[0]->HV_CORREO ?>
                                </p>
                                <p>
                                    Direcci&oacute;n de Residencia: <?php echo $registro[0]->HV_DIRECCIONRESIDENCIA ?>
                                </p>
                                <p>
                                    Telefonos: <?php echo $registro[0]->HV_TELEFONOFIJO . ' - ' . $registro[0]->HV_CELULAR ?>
                                </p>
                                <p>
                                    Fechas: Desde <?php echo $registro[0]->CONTRATO_FECHAINI . ' Hasta ' . $registro[0]->CONTRATO_FECHAFIN ?>
                                </p>                                         
                                <br>
                                <hr>
                            </div>

                        </div>
                        <!--end row-->
                        <div class="tabbable tabbable-custom tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_11" data-toggle="tab">
                                        Documentos de la Hoja de Vida
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_11">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Tipo de Documento
                                                    </th>
                                                    <th>
                                                        Observacion
                                                    </th>
                                                    <th>
                                                        Opciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($documents_2 as $document) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $count; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $document->TIPODOCUMENTO_NOMBRE; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $document->DOCUMENTOHV_OBSERVACION; ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn default btn-xs green-stripe" href="<?php echo base_url('cv/view_document/' . encrypt_id($document->DOCUMENTOHV_ID)) ?>" target="_blank">
                                                                Ver 
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
                        </div>

                        <div class="tabbable tabbable-custom tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_11" data-toggle="tab">
                                        Documentos del Contrato
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_11">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Tipo de Documento
                                                    </th>
                                                    <th>
                                                        Observacion
                                                    </th>
                                                    <th>
                                                        Opciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($documents as $document) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $count; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $document->TIPODOCUMENTO_NOMBRE; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $document->DOCUMENTOCO_OBSERVACION; ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn default btn-xs green-stripe" href="<?php echo base_url('contract/view_document/' . encrypt_id($document->DOCUMENTOCO_ID)) ?>" target="_blank">
                                                                Ver 
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
                        </div>
                    </div>
                </div>                        
                <!-- FIN INICIO PERFIL-->
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
</div>


<!-- END CONTENT -->
