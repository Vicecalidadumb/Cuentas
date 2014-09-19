</div>

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date("Y") ?> &copy; Universidad Manuela Beltr&aacute;n - Vicerrector&iacute;a de Calidad.
    </div>
    <div class="page-footer-tools">
        <span class="go-top">
            <i class="fa fa-angle-up"></i>
        </span>
    </div>
</div>
<!-- END FOOTER -->


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url('/assets/global/plugins/jquery-1.11.0.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery-migrate-1.2.1.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js'); ?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('/assets/global/plugins/flot/jquery.flot.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/flot/jquery.flot.resize.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/flot/jquery.flot.categories.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery.pulsate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('/assets/admin/pages/scripts/components-pickers.js'); ?>"></script>


<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url('/assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/global/plugins/gritter/js/jquery.gritter.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('/assets/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/admin/layout/scripts/quick-sidebar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/admin/pages/scripts/index.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('/assets/admin/pages/scripts/tasks.js'); ?>" type="text/javascript"></script>


<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/jquery-validation/js/messages_es.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/jquery-validation/js/additional-methods.min.js'); ?>"></script>


<script src="<?php echo base_url('/assets/admin/pages/scripts/components-dropdowns.js'); ?>"></script>

<script src="<?php echo base_url('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/global/plugins/select2/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"></script>


<script src="<?php echo base_url('/assets/admin/pages/scripts/table-advanced.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('/js/script_umb.js'); ?>"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout

        ComponentsPickers.init();
        QuickSidebar.init() // init quick sidebar
        Index.init();
        Index.initDashboardDaterange();
        //Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        //Index.initCharts(); // init index page's custom scripts
        //Index.initChat();
        TableAdvanced.init();

        //Index.initMiniCharts();
        Index.initIntro();
        Tasks.initDashboardWidget();
        ComponentsDropdowns.init();
        FormValidation.init();

    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>