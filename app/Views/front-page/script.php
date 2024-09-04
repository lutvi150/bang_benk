 <!-- Load javascripts at bottom, this will reduce page load time -->
 <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
 <!--[if lt IE 9]>
    <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/respond.min.js"></script>  
    <![endif]-->
 <!-- Modal -->
 <div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title alert-heading">Hello</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="alert alert-info" role="alert">
                     <strong>Notif</strong>
                     <p class="alert-text"></p>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/jquery.min.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
 <!-- END CORE PLUGINS -->

 <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/assets/plugins/zoom/jquery.zoom.min.js" type="text/javascript"></script><!-- product zoom -->
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/corporate/scripts/layout.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/theme/metronic-ui/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
 <script src="<?= base_url() ?>assets/sweetalert2/dist/sweetalert2.js"></script>
 <script src="<?= base_url() ?>assets/js/front-page.js" type="text/javascript"></script>
 <script type="text/javascript">
     let url = '<?= base_url() ?>';
     jQuery(document).ready(function() {
         Layout.init();
         Layout.initOWL();
         Layout.initImageZoom();
         Layout.initTouchspin();
         Layout.initTwitter();
     });
 </script>