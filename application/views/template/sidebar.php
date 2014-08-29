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
            <li >
                <a href="<?php echo base_url('desk'); ?>">
                    <i class="icon-home"></i>
                    <span class="title">Inicio</span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Usuarios del Sistema</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo base_url('user'); ?>">
                            Listado de Usuarios</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('user/add'); ?>">
                            Agregar Usuario</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">Sistema</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo base_url('config/rol'); ?>">
                            Roles</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="icon-doc"></i>
                    <span class="title">Admin de Hojas de Vida</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo base_url(''); ?>">
                            Listado de Hojas de Vida
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(''); ?>">
                            Agregar Hoja de Vida
                        </a>
                    </li>                    
                </ul>
            </li>

            <li>
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
                    <li>
                        <a href="<?php echo base_url(''); ?>">
                            Agregar Contrato
                        </a>
                    </li>                    
                </ul>
            </li>

            <li>
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
                    <li>
                        <a href="<?php echo base_url('cut/add'); ?>">
                            Agregar Corte
                        </a>
                    </li>                    
                </ul>
            </li> 

            <li>
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
                    <li>
                        <a href="<?php echo base_url(''); ?>">
                            Agregar a Corte
                        </a>
                    </li>                    
                </ul>
            </li>            

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>