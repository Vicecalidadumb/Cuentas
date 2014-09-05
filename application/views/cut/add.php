<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Agregar Corte <small>para Pagos</small>
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
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo base_url('cut/add') ?>">
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
                        <form id="insert_cut" action="<?php echo base_url('cut/insert'); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Nombre Administrativo
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="CORTE_NOMBREADMIN" value="<?php echo set_value('CORTE_NOMBREADMIN') ?>" id="CORTE_NOMBREADMIN" placeholder="Nombre Administrativo" class="form-control">
                                        <span class="help-block">
                                            Ingrese por favor un nombre administrativo para el nuevo corte.  
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Dia de Pago
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="CORTE_DIAPAGO" value="<?php echo set_value('CORTE_DIAPAGO') ?>" id="CORTE_DIAPAGO" placeholder="Dia de Pago" class="form-control">
                                        <span class="help-block">
                                            Ingrese por favor el dia de pago para este corte.  
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Dia de Inicio del Corte
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="CORTE_DIAINICIO" value="<?php echo set_value('CORTE_DIAINICIO') ?>" id="CORTE_DIAINICIO" placeholder="Dia de Inicio del Corte" class="form-control">
                                        <span class="help-block">
                                            Ingrese por favor un dia de inicio para este corte.  
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Dia Final del Corte
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" name="CORTE_DIAFIN" value="<?php echo set_value('CORTE_DIAFIN') ?>" id="CORTE_DIAFIN" placeholder="Dia Final del Corte" class="form-control">
                                        <span class="help-block">
                                            Ingrese por favor un Dia Final del Corte para el nuevo registro.  
                                        </span>
                                    </div>
                                </div>                                

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Guardar</button>
                                        <a href="<?php echo base_url('cut') ?>">
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

                var form1 = $('#insert_cut');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        CORTE_NOMBREADMIN: {
                            required: true
                        },
                        CORTE_DIAPAGO: {
                            required: true,
                            minlength: 1,
                            maxlength: 2,
                            min: 1,
                            max: 31,
                            digits: true
                        },
                        CORTE_DIAINICIO: {
                            required: true,
                            minlength: 1,
                            maxlength: 2,
                            min: 1,
                            max: 31,
                            digits: true
                        },
                        CORTE_DIAFIN: {
                            required: true,
                            minlength: 1,
                            maxlength: 2,
                            min: 1,
                            max: 31,
                            digits: true
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
                    success: function(label) {
                        label
                                .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },
                    submitHandler: function(form) {
                        success1.show();
                        error1.hide();
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
