<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
<!--    <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">-->
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Bienvenido al Concurso Abierto de M&eacute;ritos</h2>
    <p>Aplicativo de Cargue de Documentos - Registro de Aspirantes</p>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Certificado de Inscripci&oacute;n
    </h1>
</div>


<table class="table table-striped">
    <tr>
        <td>PIN</td>          
        <td><strong><?php echo $user[0]->INSCRIPCION_PIN; ?></strong></td>

        <td></td>          
        <td></td>        
    </tr>    
    <tr>
        <td>Tipo de Documento</td>          
        <td><strong><?php echo $user[0]->USUARIO_TIPODOCUMENTO; ?></strong></td>

        <td>Numero de Documento</td>          
        <td><strong><?php echo $user[0]->USUARIO_NUMERODOCUMENTO; ?></strong></td>        
    </tr>
    <tr>
        <td>Nombres</td>          
        <td><strong><?php echo $user[0]->USUARIO_NOMBRES; ?></strong></td> 

        <td>Apellidos</td>          
        <td><strong><?php echo $user[0]->USUARIO_APELLIDOS; ?></strong></td>         
    </tr>
    <tr>
        <td>Correo Electronico</td>          
        <td><strong><?php echo $user[0]->USUARIO_CORREO; ?></strong></td> 

        <td>Genero</td>          
        <td><strong><?php echo ($user[0]->USUARIO_GENERO == 'M') ? 'MASCULINO' : 'FEMENINO'; ?></strong></td>         
    </tr>
    <tr>
        <td>Fecha de Nacimiento(YYYY/MM/DD)</td>          
        <td><strong><?php echo $user[0]->USUARIO_FECHADENACIMIENTO; ?></strong></td> 

        <td>Lugar de Nacimiento</td>          
        <td><strong><?php echo $user[0]->USUARIO_LUGARDENACIMIENTO_N; ?></strong></td>         
    </tr>
    <tr>
        <td>Direccion de Residencia</td>          
        <td><strong><?php echo $user[0]->USUARIO_DIRECCIONRESIDENCIA; ?></strong></td> 

        <td>Lugar de Residencia</td>          
        <td><strong><?php echo $user[0]->USUARIO_LUGARDERESIDENCIA; ?></strong></td>         
    </tr>
    <tr>
        <td>Telefono Fijo</td>          
        <td><strong><?php echo $user[0]->USUARIO_TELEFONOFIJO; ?></strong></td> 

        <td>Celular</td>          
        <td><strong><?php echo $user[0]->USUARIO_CELULAR; ?></strong></td>         
    </tr>
    <tr>
        <td>Telefono Fijo</td>          
        <td><strong><?php echo $user[0]->USUARIO_TELEFONOFIJO; ?></strong></td> 

        <td>Convocatoria</td>          
        <td><strong><?php echo $user[0]->CONVOCATORIA_NOMBRE; ?></strong></td>         
    </tr>
</table>
<div class="well" style="max-width: 400px; margin: 0 auto 10px;">
    <button type="button" class="btn btn-primary btn-lg btn-block">Descargar Certificado en Formato PDF</button>
</div>
<a href="<?php echo base_url(''); ?>">
    <button type="button" class="btn btn-success">Iniciar Sesion</button>
</a>
<br><br><br><br>