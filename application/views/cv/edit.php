<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Hojas <small>de Vida</small>
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
                    <a href="<?php echo base_url('cv') ?>">
                        Hojas de Vida
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="">
                        Editar
                    </a>
                </li>                 
            </ul>             
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix">
        </div>

        <div class="row ">

            <div class="col-md-12 col-sm-12">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                <?php } ?>            
                <?php echo validation_errors(); ?>            
            </div>

            <div class="col-md-12 col-sm-12">

                <div class="portlet box purple">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Editar Hoja de Vida
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="update_cv" action="<?php echo base_url('cv/update/' . encrypt_id($registro[0]->HV_ID)); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Nombres
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_NOMBRES" value="<?php echo $registro[0]->HV_NOMBRES; ?>" id="HV_NOMBRES" placeholder="Nombres" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Apellidos
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_APELLIDOS" value="<?php echo $registro[0]->HV_APELLIDOS; ?>" id="HV_APELLIDOS" placeholder="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Tipo de Documento
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('HV_TIPODOCUMENTO', array("CC" => "CC"), $registro[0]->HV_TIPODOCUMENTO, 'class="form-control"'); ?>
                                        </div>
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Documento
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_NUMERODOCUMENTO" value="<?php echo $registro[0]->HV_NUMERODOCUMENTO; ?>" id="HV_NUMERODOCUMENTO" placeholder="Documento" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Correo Electronico
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_CORREO" value="<?php echo $registro[0]->HV_CORREO; ?>" id="HV_CORREO" placeholder="Correo Electronico" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Genero
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('HV_GENERO', array("F" => "Femenino", "M" => "Masculino"), $registro[0]->HV_GENERO, 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Fecha de Nac
                                        </label>
                                        <div class="col-md-9">
                                            <input name="HV_FECHADENACIMIENTO" value="<?php echo $registro[0]->HV_FECHADENACIMIENTO; ?>" id="HV_FECHADENACIMIENTO" class="form-control form-control-inline input-medium date-picker" size="16" type="text"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Direccion de Resi.
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_DIRECCIONRESIDENCIA" value="<?php echo $registro[0]->HV_DIRECCIONRESIDENCIA; ?>" id="HV_DIRECCIONRESIDENCIA" placeholder="Direccion de Residencia" class="form-control">
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Departamento de Nacimiento
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('HV_LUGARDENACIMIENTO_DTO', $depar, '', 'onchange="get_city(this.value,\'HV_LUGARDENACIMIENTO\')"  id="HV_LUGARDENACIMIENTO_DTO" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Municipio de Nacimiento
                                        </label>
                                        <div class="col-md-9" id='space_HV_LUGARDENACIMIENTO'>
                                            <?php echo form_dropdown('HV_LUGARDENACIMIENTO', $citys, $registro[0]->HV_LUGARDENACIMIENTO, 'id="HV_LUGARDENACIMIENTO" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Departamento de Residencia
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('HV_LUGARDERESIDENCIA_DTO', $depar, '', 'onchange="get_city(this.value,\'HV_LUGARDERESIDENCIA\')" id="HV_LUGARDERESIDENCIA_DTO" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>                                


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Municipio de Residencia
                                        </label>
                                        <div class="col-md-9" id='space_HV_LUGARDERESIDENCIA'>
                                            <?php echo form_dropdown('HV_LUGARDERESIDENCIA', $citys, $registro[0]->HV_LUGARDERESIDENCIA, 'id="HV_LUGARDERESIDENCIA" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div> 


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Tele. Fijo
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_TELEFONOFIJO" value="<?php echo $registro[0]->HV_TELEFONOFIJO; ?>" id="HV_TELEFONOFIJO" placeholder="Telefono Fijo" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Celular
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="HV_CELULAR" value="<?php echo $registro[0]->HV_CELULAR; ?>" id="HV_CELULAR" placeholder="Celular" class="form-control">
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                                Estado
                                            </label>
                                            <div class="col-md-9">
                                                <?php echo form_dropdown('HV_ESTADO', $states, $registro[0]->HV_ESTADO, 'class="form-control"'); ?>
                                            </div>
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
    <!-- END CONTENT -->


    <script>
        var FormValidation = function() {
            // basic validation
            var handleValidation1 = function() {
                // for more info visit the official plugin documentation: 
                // http://docs.jquery.com/Plugins/Validation

                var form1 = $('#update_cv');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        HV_NOMBRES: {
                            required: true
                        },
                        HV_APELLIDOS: {
                            required: true
                        },
                        HV_NUMERODOCUMENTO: {
                            required: true
                        },
                        HV_LUGARDENACIMIENTO: {
                            required: true
                        },
                        HV_LUGARDERESIDENCIA: {
                            required: true
                        }
                    },
                    invalidHandler: function(event, validator) { //display error alert on form submit              
                        success1.hide();
                        error1.show();
                        Metronic.scrollTo(error1, -200);
                    },
                    highlight: function(element) { // hightlight error inputs
                        $(element)
                                .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    unhighlight: function(element) { // revert the change done by hightlight
                        $(element)
                                .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },
                    /*success: function(label) {
                     label
                     .closest('.form-group').removeClass('has-error'); // set success class to the control group
                     },*/
                    submitHandler: function(form) {
                        success1.show();
                        error1.hide();
                        $("#" + form1).submit();
                    }
                });
            }
            return {
                //main function to initiate the module
                init: function() {
                    handleValidation1();
                }
            };

        }();
    </script>
