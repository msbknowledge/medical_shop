<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr>

<!-- Standard Application Modals (Bootstrap 3 / Flow UI) -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-cog"></i> Settings</h4>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-text-o"></i> Form</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formAddEditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> <span>Record</span></h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> Details</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<footer style="margin-top: 30px; padding: 18px 0; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 13px;">
    <p class="pull-left"><?= isset($site_settings['site_setting_copyright']) ? $site_settings['site_setting_copyright'] : '© '.date('Y').' Medical Shop Billing' ?></p>
</footer>

</div><!--/.fluid-container-->

<!-- ==================================================
     Backend JavaScript Libraries
     ================================================== -->
<script src="<?= cdn_url(); ?>assets/backend/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/moment.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/datepicker/js/bootstrap-datetimepicker.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/jquery-ui.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/toast-alert/toastr.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/plugins/select2/select2.full.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/app.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/nprogress.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/dropify.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= cdn_url(); ?>assets/backend/dist/js/bootstrap-select.min.js"></script>
<script src="<?= cdn_url(); ?>js/jquery.cookie.js"></script>
<script src="<?= cdn_url(); ?>assets/custom/fastapp.js"></script>

<script>
<?php
 if (isset($widgets) && is_array($widgets))
     foreach ($widgets as $widget):
        ?>
           loadWidget('<?=$widget;?>');
    <?php endforeach; ?>
</script>
<?php execute_hook('footer');?>
</body>
</html>
