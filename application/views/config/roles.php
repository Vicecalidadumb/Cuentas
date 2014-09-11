<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Roles <small>del Sistema</small>
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
                    <a href="<?php echo base_url('config/roles') ?>">
                        Roles
                    </a>
                </li>                    
            </ul>
<!--            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                        Acciones <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="<?php echo base_url('user/add') ?>">
                                Agregar un Nuevo Registro
                            </a>
                        </li>
                    </ul>
                </div>
            </div>            -->
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix">
        </div>

        <div class="col-md-12 col-sm-12">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>          
        </div>        

        <div class="row ">
            <div class="col-md-12 col-sm-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>Listado de Modulos
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <h1>
                            Permisos del Rol 
                            <small style="color:#f37720 !important">
                                <script>
                                    function redirect(route) {
                                        window.location.href = "<?php echo base_url(""); ?>" + "config/roles/" + route
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
            </div>
        </div>