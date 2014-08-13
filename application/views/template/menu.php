<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if ($this->session->userdata('logged_in')){ ?>
                <a class="navbar-brand">Cargue de Documentos</a>
            <?php }else{ ?>
                <a href="<?php echo base_url("login") ?>" class="navbar-brand">Volver a Inicio de Sesion</a>
            <?php } ?>
        </div>
        <div class="navbar-collapse collapse">

            <?php if ($this->session->userdata('politicas')): ?>
                <!--MENU CONSTRUCTOR DE ITEMS-->
                <ul class="nav navbar-nav">
                    <li class="" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Agregar Nuevo Documento<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("particles") ?>">Documento Especificos</a></li>
                            <li><a href="<?php echo base_url("question/view") ?>">Educaci&oacute;n Formal</a></li>
                            <li><a href="<?php echo base_url("question/view") ?>">Educaci&oacute;n no Formal</a></li>
                            <li><a href="<?php echo base_url("question/view") ?>">Experiencia Laboral</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url("question/add") ?>">Certificado de Cargue de Documentos</a></li>
                </ul>
            <?php endif; ?>

            <?php if ($this->session->userdata('logged_in')): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario: <strong><?php echo $this->session->userdata('USUARIO_NOMBRES') . ' ' . $this->session->userdata('USUARIO_APELLIDOS'); ?></strong><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('login/logout'); ?>">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>  
            <?php endif; ?>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container theme-showcase">