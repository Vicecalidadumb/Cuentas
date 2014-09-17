

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Contratos
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
                    <a>
                        Agregar
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
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Agregar Registro
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="insert_contract" action="<?php echo base_url('contract/insert'); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Tipo de Contrato
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('TIPOCONTRATO_ID', $typecontracts, set_value('TIPOCONTRATO_ID'), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Hoja de Vida
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('HV_ID', $cvs, set_value('HV_ID'), 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Fecha de Inicio
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input name="CONTRATO_FECHAINI" value="<?php echo set_value('CONTRATO_FECHAINI') ?>" id="CONTRATO_FECHAINI" class="form-control form-control-inline input-medium date-picker" size="16" type="text"/>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Fecha de Final
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input name="CONTRATO_FECHAFIN" value="<?php echo set_value('CONTRATO_FECHAFIN') ?>" id="CONTRATO_FECHAFIN" class="form-control form-control-inline input-medium date-picker" size="16" type="text"/>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-7">
                                            Valor del contrato (Sin Puntos Ni Comas)
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="CONTRATO_VALOR" value="<?php echo set_value('CONTRATO_VALOR') ?>" id="CONTRATO_VALOR" placeholder="Valor del contrato" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Proyecto
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('PROYECTO_ID', $proyects, set_value('PROYECTO_ID'), 'class="form-control"'); ?>
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

                var form1 = $('#insert_contract');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        CONTRATO_FECHAINI: {
                            required: true,
                            date:true
                        },
                        CONTRATO_FECHAFIN: {
                            required: true,
                            date:true
                        },
                        CONTRATO_VALOR: {
                            required: true,
                            digits:true
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