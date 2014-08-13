<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="">
                <a href="">
                    <h4 class="list-group-item-heading">Paso 1</h4>
                    <p class="list-group-item-text">Documento Especificos <span class="badge">4</span></p>
                </a>
            </li>
            <li class="active">
                <a href="">
                    <h4 class="list-group-item-heading">Paso 2</h4>
                    <p class="list-group-item-text">Educaci&oacute;n Formal</p>
                </a>
            </li>
            <li class="">
                <a href="">
                    <h4 class="list-group-item-heading">Paso 3</h4>
                    <p class="list-group-item-text">Educaci&oacute;n no Formal</p>
                </a>
            </li>
            <li class="">
                <a href="">
                    <h4 class="list-group-item-heading">Paso 4</h4>
                    <p class="list-group-item-text">Experiencia Laboral</p>
                </a>
            </li>
            <li class="">
                <a href="">
                    <h4 class="list-group-item-heading">Paso 5</h4>
                    <p class="list-group-item-text">Descargar Certificado</p>
                </a>
            </li>            
        </ul>
    </div>
</div>

<div class="jumbotron">
    <div style="text-align: center">
<!--    <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">-->
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Bienvenido al Concurso Abierto de M&eacute;ritos</h2>
    <!--    <h4>VICERRECTORIA DE CALIDAD - CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>-->
    <p>Aplicativo de Cargue de Documentos.</p>
    <p>Convocatoria <strong><?php echo $this->session->userdata('CONVOCATORIA_NOMBRE'); ?></strong>.</p>
    <br>
    <p style="font-size: 15px !important; text-align: justify !important;">
        <strong>PASOS PARA REALIZAR EL CARGUE DE ARCHIVOS</strong>
        <br>
        Para cargar los documentos, se debe tener en cuenta el siguiente procedimiento:
        <br><br>
        <strong>1.</strong> Los documentos deben ser escaneados en formato pdf.
        <br>
        <strong>2.</strong> Aseg&uacute;rese que el tama&ntilde;o del archivo sea de m&aacute;ximo de 2MB.
        <br>
        <strong>3.</strong> Pulse el icono de la opci&oacute;n "Cargar o Modificar" correspondiente al archivo que se desea adjuntar, 
        desplace la barra de desplazamiento hacia abajo y seleccione el archivo que contiene el documento a adjuntar.
        <br>
        <strong>4.</strong> Finalmente, pulse el bot&oacute;n "Subir Documento de Identidad o Subir Libreta Militar (seg&uacute;n sea el caso)" y 
        aseg&uacute;rese que le aparezca el mensaje "archivo adjuntado exitosamente".
        <br><br>
    <div style="text-align: center;color: #bc0101;font-size: 13px !important;">
        TENGA EN CUENTA ESTAS RECOMENDACIONES PARA CADA DOCUMENTO QUE VAYA A ADJUNTAR, 
        DE ESTO DEPENDE EL &Eacute;XITO DE LA ENTREGA Y RECEPCI&Oacute;N DE SUS DOCUMENTOS.
    </div>
</p>    
</div>

<div class="page-header">
    <h1>Agregar Educaci&oacute;n Formal</h1>   
</div>

<!--<div class="well">
    <ul>
        <li>
            <strong>TENGA EN CUENTA:</strong>
        </li>
        <li>
            Si se requiere utilizar imagenes, solamente agregue archivos inferiores a 50KB.
        </li>
        <li>
            Si desea, puede utilizar el boton
            <button type="button" class="btn btn-default btn-sm btn-small"><i class="fa fa-arrows-alt icon-fullscreen"></i></button>
            para ampliar el campo de edicion.
        </li>   
    </ul>
</div>-->


<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td style="font-weight: bold !important;">
                        No. Folio
                    </td>
                    <td style="font-weight: bold !important;">
                        Modalidad
                    </td>
                    <td style="font-weight: bold !important;">
                        Universidad/Instituto
                    </td>
                    <td style="font-weight: bold !important;">
                        Titulo/Nombre programa
                    </td>
                    <td style="font-weight: bold !important;">
                        Folio
                    </td> 
                    <td style="font-weight: bold !important;">
                        Editar
                    </td>
                    <td style="font-weight: bold !important;">
                        Eliminar
                    </td>                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        TITULO DE BACHILLER
                    </td>
                    <td>
                        COLEGIO SAN JUDAS TADEO
                    </td>
                    <td>
                        BACHILLER ACADEMICO
                    </td>
                    <td style="padding: 1px !important;">
                        <button type="button" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-eye-open"></span>
                            Ver
                        </button>
                    </td>
                    <td style="padding: 1px !important;">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Editar
                        </button>
                    </td>
                    <td style="padding: 1px !important;">
                        <button type="button" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-remove"></span>
                            Eliminar
                        </button>
                    </td>                    
                </tr>
            </tbody>
        </table>
        </td>
        </tr>
        </table>
    </div>
</div>
<br><br>

<?php echo form_open('register/insert', 'id="register_insert" class="form-signin" role="form" method="POST" autocomplete="off"'); ?>

<table class="table table-bordered" style="background-color: #f4f4f4 !important;">
    <tr>
        <td>
            <div class="row">
                <div class="col-md-12">
                    <h4 style="text-align: center !important;color: #3071a9 !important;">
                        INGRESO Y ACTUALIZACI&Oacute;N DE ESTUDIOS
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Modalidad </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Semestres </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Graduado </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Obtenido en el Extranjero </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Universidad o Instituci&oacute;n </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Titulo </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>                  
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha Terminaci&oacute;n </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha Grado </label>
                        <?php echo form_dropdown('USUARIO_LUGARDERESIDENCIA', array('' => '--SELECCIONE PRIMERO UN DEPARTAMENTO--'), '', 'class="form-control" tabindex=10'); ?>
                    </div>
                </div>                  
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adjunto </label>
                        <?php echo form_upload('userfile', '', 'id="userfile_4" class="filebase"') ?>
                    </div>
                </div>                 
            </div>            

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Ingresar Estudio</button>
                    <a href="">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                    </a>
                </div>
            </div>
        </td>
    </tr>
</table>

<?php echo form_close(); ?>




<br><br><br><br>
<div class="row">
    <div class="col-md-6">
        <p style="text-align: left !important;">
            <a href="<?php echo base_url("particles") ?>" class="btn btn-info" role="button">
                Regresar al paso 1: Educaci&oacute;n Formal
            </a>        
        </p>
    </div>

    <div class="col-md-6">
        <p style="text-align: right !important;">
            <a href="<?php echo base_url("particles") ?>" class="btn btn-info" role="button">
                Ir al paso 3: Educaci&oacute;n No Formal
            </a>        
        </p>
    </div>    
</div>
<div class="row">
    <div class="col-md-12">
        <p style="text-align: center !important;">
            <a href="<?php echo base_url("login/logout") ?>" class="btn btn-danger btn-sm" role="button">
                Cerrar Sesi&oacute;n
            </a>        
        </p>
    </div>   
</div>


