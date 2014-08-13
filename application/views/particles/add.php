<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="row form-group">
    <div class="col-xs-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="active"><a href="">
                    <h4 class="list-group-item-heading">Paso 1</h4>
                    <p class="list-group-item-text">Documento Especificos (4)</p>
                </a></li>
            <li class=""><a href="">
                    <h4 class="list-group-item-heading">Paso 2</h4>
                    <p class="list-group-item-text">Educaci&oacute;n Formal</p>
                </a></li>
            <li class=""><a href="">
                    <h4 class="list-group-item-heading">Paso 3</h4>
                    <p class="list-group-item-text">Educaci&oacute;n no Formal</p>
                </a>
            </li>
            <li class=""><a href="">
                    <h4 class="list-group-item-heading">Paso 4</h4>
                    <p class="list-group-item-text">Experiencia Laboral</p>
                </a>
            </li>
            <li class=""><a href="">
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
    <h1>Agregar Documento Obligatorio</h1>   
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

<?php
//echo '<pre>'.print_r($documents_particles_user,true).'</pre>';
$document_1_ancla = '';
$document_1_image = 'sin_documento_de_identidad.jpg';

$document_2_ancla = '';
$document_2_image = 'sin_libreta_militar.jpg';

$document_3_ancla = '';
$document_3_image = 'sin_matricula_profesional.jpg';

$document_4_ancla = '';
$document_4_image = 'sin_licencia_de_conduccion.jpg';

foreach ($documents_particles_user as $document) {
    switch ($document->TIPO_DOCUMENTO_ID) {
        case 1:
            $document_1_ancla = 'href="particles/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
            $document_1_image = 'documento_cargado.jpg';
            break;
        case 2:
            $document_2_ancla = 'href="particles/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
            $document_2_image = 'documento_cargado.jpg';
            break;
        case 3:
            $document_3_ancla = 'href="particles/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
            $document_3_image = 'documento_cargado.jpg';
            break;
        case 4:
            $document_4_ancla = 'href="particles/view_document/' . encrypt_id($document->DOCUMENTO_ID) . '"';
            $document_4_image = 'documento_cargado.jpg';
            break;
    }
}
?>


<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <td>
                    <?php echo form_open_multipart('particles/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                    <?php echo form_hidden('TIPO_DOCUMENTO_ID', '1'); ?>
                    <table>
                        <tr>
                            <td>
                                <a <?php echo $document_1_ancla; ?> target="_blank">
                                    <img class="img-rounded" alt="<?php echo $document_1_image; ?>" src="<?php echo base_url('images/vice/' . $document_1_image); ?>" style="width: 140px; height: 140px;">
                                </a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Documento de Identidad </label>
                                    <?php echo form_upload('userfile_1', '', 'id="userfile_1" class="filebase"') ?>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-<?php echo ($document_1_ancla != '') ? 'info' : 'success'; ?>">
                                        Subir <?php echo ($document_1_ancla != '') ? 'de nuevo el' : ''; ?> Documento de Identidad
                                    </button>
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo form_open_multipart('particles/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                    <?php echo form_hidden('TIPO_DOCUMENTO_ID', '2'); ?>                    
                    <table>
                        <tr>
                            <td>
                                <a <?php echo $document_2_ancla; ?> target="_blank">
                                    <img class="img-rounded" alt="<?php echo $document_2_image; ?>" src="<?php echo base_url('images/vice/' . $document_2_image); ?>" style="width: 140px; height: 140px;">
                                </a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Libreta Militar </label>
                                    <?php echo form_upload('userfile_2', '', 'id="userfile_2" class="filebase"') ?>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-<?php echo ($document_2_ancla != '') ? 'info' : 'success'; ?>">
                                        Subir <?php echo ($document_2_ancla != '') ? 'de nuevo la' : ''; ?> Libreta Militar
                                    </button>                                    
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </td>
            </tr> 
            <tr>
                <td>
                    <?php echo form_open_multipart('particles/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                    <?php echo form_hidden('TIPO_DOCUMENTO_ID', '3'); ?>                    
                    <table>
                        <tr>
                            <td>
                                <a <?php echo $document_3_ancla; ?> target="_blank">
                                    <img class="img-rounded" alt="<?php echo $document_3_image; ?>" src="<?php echo base_url('images/vice/' . $document_3_image); ?>" style="width: 140px; height: 140px;">
                                </a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tarjeta/Matricula Profesional </label>
                                    <?php echo form_upload('userfile_3', '', 'id="userfile_3" class="filebase"') ?>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-<?php echo ($document_3_ancla != '') ? 'info' : 'success'; ?>">
                                        Subir <?php echo ($document_3_ancla != '') ? 'de nuevo la' : ''; ?> Tarjeta/Matricula Profesional
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </td>
            </tr>  
            <tr>
                <td>
                    <?php echo form_open_multipart('particles/insert', 'id="particles_insert" class="form-signin" role="form" method="POST"'); ?>
                    <?php echo form_hidden('TIPO_DOCUMENTO_ID', '4'); ?>                    
                    <table>
                        <tr>
                            <td>
                                <a <?php echo $document_4_ancla; ?> target="_blank">
                                    <img class="img-rounded" alt="<?php echo $document_4_image; ?>" src="<?php echo base_url('images/vice/' . $document_4_image); ?>" style="width: 140px; height: 140px;">
                                </a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Licencia de Conducci&oacute;n </label>
                                    <?php echo form_upload('userfile_4', '', 'id="userfile_4" class="filebase"') ?>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-<?php echo ($document_4_ancla != '') ? 'info' : 'success'; ?>">
                                        Subir <?php echo ($document_4_ancla != '') ? 'de nuevo la' : ''; ?> Licencia de Conducci&oacute;n
                                    </button>                                    
                                </div> 
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </td>
            </tr>             
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p style="text-align: right !important;">
            <a href="<?php echo base_url("formal") ?>" class="btn btn-info" role="button">
                Ir al paso 2: Educaci&oacute;n Formal
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