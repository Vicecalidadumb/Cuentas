<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php } ?>

<div class="jumbotron">
    <div style="text-align: center">
        <img src="<?php echo base_url('images/banner1.png'); ?>" style="width: 180px;">
        <img src="<?php echo base_url('images/marca-umb.png'); ?>" style="width: 280px;">  
    </div>
    <h2>Construcci&oacute;n de &Iacute;tems</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<?php echo form_open('question/view', 'class="form-signin" role="form" method="POST"'); ?>

<?php
$users['ALL'] ='Todos';

?>

<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label for="exampleInputEmail1">Usuario Constructor</label>
            <?php echo form_dropdown('USUARIO_ID', $users, '', 'class="form-control"'); ?>
        </div>

    </div>
</div>

<?php echo form_close(); ?>