<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!--            class="start active open"-->

            <li class="<?php echo strstr($content, 'desk') ? 'active open' : ''; ?>">
                <a href="<?php echo base_url('desk'); ?>">
                    <i class="icon-home"></i>
                    <span class="title">Inicio</span>
                </a>
            </li>

            <?php if (know_permission_role('USU', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'user') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-user"></i>
                        <span class="title">Usuarios del Sistema</span>
                        <?php echo strstr($content, 'user') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'user') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url('user'); ?>">
                                Listado de Usuarios
                            </a>
                        </li>
                        <?php if (know_permission_role('USU', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('user/add'); ?>">
                                    Agregar Usuario
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (know_permission_role('ROL', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'config') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">Sistema</span>
                        <?php echo strstr($content, 'config') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'config') ? 'open' : ''; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url('config/roles'); ?>">
                                Roles</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (know_permission_role('HVI', 'permission_view')): ?>
                <li class="<?php echo strstr($content, '---') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-doc"></i>
                        <span class="title">Admin de Hojas de Vida</span>
                        <?php echo strstr($content, '--') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url(''); ?>">
                                Listado de Hojas de Vida
                            </a>
                        </li>
                        <?php if (know_permission_role('HVI', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url(''); ?>">
                                    Agregar Hoja de Vida
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (know_permission_role('CON', 'permission_view')): ?>
                <li class="<?php echo strstr($content, '---') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-notebook"></i>
                        <span class="title">Contratos</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url(''); ?>">
                                Listado de Contratos
                            </a>
                        </li>
                        <?php if (know_permission_role('CON', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url(''); ?>">
                                    Agregar Contrato
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (know_permission_role('COR', 'permission_view')): ?>
                <li class="<?php echo strstr($content, '---') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-calendar"></i>
                        <span class="title">Admin de Cortes</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url('cut'); ?>">
                                Listado de Cortes
                            </a>
                        </li>
                        <?php if (know_permission_role('COR', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('cut/add'); ?>">
                                    Agregar Corte
                                </a>
                            </li> 
                        <?php endif; ?>
                    </ul>
                </li> 
            <?php endif; ?>

            <?php if (know_permission_role('DCO', 'permission_view')): ?>
                <li class="<?php echo strstr($content, '---') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-docs"></i>
                        <span class="title">Documentos</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url(''); ?>">
                                Buscar Documento
                            </a>
                        </li>
                        <?php if (know_permission_role('COR', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url(''); ?>">
                                    Agregar a Corte
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>  
            <?php endif; ?>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>