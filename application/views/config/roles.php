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

<div class="page-header">
    <h1 style="color:#2aabd2">
        Agregar Usuario al Sistema
    </h1>
</div>



<div class="row">
    <div class="col-md-12">
        <h1>
            Permisos del Rol 
            <small style="color:#f37720 !important">
                <script>
                    function redirect(route) {
                        window.location.href = "<?php echo base_url(); ?>" + "/umb_items/config/roles/" + route
                    }
                </script>
                <?php
                echo form_dropdown('rol_id_select', $roles, $id_rol, 'class="form-control" style="color: #F37720 !important;" onchange="redirect(this.value)"');
                ?>
            </small>
        </h1>  
        <?php echo form_open('config/roles_update', 'id="form_roles_update"') ?>
        <?php echo form_hidden('rol_id', $id_rol) ?>
        <table class="table table-striped">

                <tr>
                    <th>Modulo</th>
                    <th>Ver</th>
                    <th>Agregar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>

                <?php
                foreach ($permissions as $permission) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $permission['name']; ?>
                        </td>
                        <td style="text-align: center;background-color:<?php echo ($permission['permissions']['permission_view'] == 0) ? '#B91D47' : '#00A300'; ?>">
                            <?php
                            echo form_checkbox('permission_view_' . $permission['id'], '1', $permission['permissions']['permission_view']);
                            ?>
                        </td>
                        <td style="text-align: center;background-color:<?php echo ($permission['permissions']['permission_add'] == 0) ? '#B91D47' : '#00A300'; ?>">
                            <?php
                            echo form_checkbox('permission_add_' . $permission['id'], '1', $permission['permissions']['permission_add']);
                            ?>                            
                        </td> 
                        <td style="text-align: center;background-color:<?php echo ($permission['permissions']['permission_edit'] == 0) ? '#B91D47' : '#00A300'; ?>">
                            <?php
                            echo form_checkbox('permission_edit_' . $permission['id'], '1', $permission['permissions']['permission_edit']);
                            ?>                             
                        </td> 
                        <td style="text-align: center;background-color:<?php echo ($permission['permissions']['permission_delete'] == 0) ? '#B91D47' : '#00A300'; ?>">
                            <?php
                            echo form_checkbox('permission_delete_' . $permission['id'], '1', $permission['permissions']['permission_delete']);
                            ?>                            
                        </td>                     
                    </tr>
                    <?php
                }
                ?>

        </table>
        
        <button type="submit" class="btn btn-success">Actualizar</button>
        
        <?php echo form_close(); ?>
    </div>
</div>