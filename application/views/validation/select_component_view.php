<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="alert alert-success">
    Por favor seleccionar un componente para buscar los items.
</div>        

<?php
//AGREGAR OPCION DE BUSQUEDA "TODOS"
$components['ALL'] = "TODOS";
?>

<?php echo form_open('question/select_component_view/' . $id_user, 'class="form-signin" role="form" autocomplete="off" method="POST"'); ?>
<div class="form-group">
    <label for="exampleInputEmail1">Componentes del usuario <?php echo $user[0]->USUARIO_NOMBRES . ' ' . $user[0]->USUARIO_APELLIDOS; ?>:</label>
    <?php echo form_dropdown('COMPONENTE_ID', $components, '', 'class="form-control"'); ?>
</div>
<button type="submit" class="btn btn-success">Seleccionar</button>
<?php echo form_close(); ?> 
<br><br><br><br>