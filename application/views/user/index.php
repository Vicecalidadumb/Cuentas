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
    <h2>Usuarios del Sistema</h2>
    <h4>CONVOCATORIA No. 255 de 2013 CATASTRO DISTRITAL</h4>
</div>

<div class="page-header">
    <h1 style="color:#2aabd2">
        Listado de Usuarios del Sistema
        <a href="<?php echo base_url("user/add"); ?>">
            <button type="button" class="btn btn-primary btn-lg">Agregar Registro</button>
        </a>
    </h1>
</div>


<table class="table table-striped">
    <tr>
        <th>
            Nombres
        </th>
        <th>
            Apellidos
        </th>
        <th>
            Tipo de Documento
        </th>
        <th>
            Num. Documento / Usuario
        </th>  
        <th>
            Correo
        </th>            
        <th>
            Opciones
        </th>          
    </tr>

    <?php foreach ($users as $user) { ?>
        <tr>
            <td>
                <?php echo $user->USUARIO_NOMBRES ?>
            </td>
            <td>
                <?php echo $user->USUARIO_APELLIDOS ?>
            </td>
            <td>
                <?php echo $user->USUARIO_TIPODOCUMENTO ?>
            </td>
            <td>
                <?php echo $user->USUARIO_NUMERODOCUMENTO ?>
            </td>  
            <td>
                <?php echo $user->USUARIO_CORREO ?>
            </td>
            <td>
                <a href="<?php echo base_url("user/edit/" . encrypt_id($user->USUARIO_ID)); ?>">
                    <button type="button" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Editar
                    </button>
                </a>    
            </td>            
        </tr>  
    <?php } ?>

</table>