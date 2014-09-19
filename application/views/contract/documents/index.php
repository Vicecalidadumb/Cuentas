<link href="<?php echo base_url('/assets/admin/pages/css/profile.css'); ?>" rel="stylesheet" type="text/css"/>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Documentos del <small>Contrado</small>
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
                    <a href="<?php echo base_url('contract') ?>">
                        Contratos
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="">
                        Documentos del Contrado
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
            <div class="col-md-8 col-sm-8">
                <?php //echo '<pre>' . print_r($registro, true) . '</pre>'; ?>
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Documentos del Contrado
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
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
<!--                                        <a href="<?php echo base_url('cv/edit/' . encrypt_id($registro[0]->HV_ID)) ?>" class="profile-edit">
                                            Editar
                                        </a>-->
                                    </li>
<!--                                    <li>
                                        <a href="">
                                            Contratos 
                                            <span>0</span>
                                        </a>
                                    </li>-->
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
                                                <i class="fa fa-money"></i> $<?php echo number_format($registro[0]->CONTRATO_VALOR,2,'.','.') ?>
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

            <div class="col-md-4 col-sm-4">
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Agregar Documento
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php //echo '<pre>' . print_r($documents, true) . '</pre>'; ?>
                        <form enctype="multipart/form-data" id="insert_document_cv" action="<?php echo base_url('contract/insert_document_contract/' . encrypt_id($registro[0]->CONTRATO_ID)); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Tipo de Documento
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('TIPODOCUMENTO_ID', $typedocuments, set_value('TIPODOCUMENTO_ID'), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Observaci&oacute;n
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="DOCUMENTOCO_OBSERVACION" id="DOCUMENTOCO_OBSERVACION" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Archivo (.PDF) Max. 2MB
                                        </label>
                                        <div class="col-md-9">
                                            <br>
                                            <?php echo form_upload('userfile', '', 'id="userfile" class="filebase"') ?>
                                        </div>
                                    </div>  
                                </div>



                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Guardar</button>
                                        <a href="<?php echo base_url('cv') ?>">
                                            <button type="button" class="btn default">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>                

            </div>            
        </div>
    </div>
</div>
<!-- END CONTENT -->
