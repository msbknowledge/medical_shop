<!-- content ends -->
</div><!--/#content.span10-->

</div><!--/fluid-row-->

<hr>

<!-- ==================================================
     Standard Application Modals (Bootstrap 3 / Flow UI)
     ================================================== -->
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

<div class="modal fade" id="subscription_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-id-card-o"></i> Subscription</h4>
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

<!-- Multi Branch Switch Modal -->
<div class="modal fade" id="multiBranchSwitchModal" tabindex="-1" role="dialog" aria-labelledby="multiBranchSwitchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="multiBranchSwitchModalLabel"><i class="fa fa-exchange"></i> Switch Branch</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group" style="margin-bottom:0;">
                    <li class="list-group-item active"><i class="fa fa-check-circle"></i> <strong>Main Pharmacy Branch</strong> (Current)</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<footer style="margin-top: 30px; padding: 18px 0; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 13px;">
    <div class="row-fluid">
        <div class="span6">© <?=date('Y')?> Medical Shop Billing - All Rights Reserved</div>
        <div class="span6 text-right" style="text-align: right;">Powered By <a target="_blank" href="https://billings.msbknowledge.in" style="color: #6366f1; font-weight: 600;"><img style="height: 32px; vertical-align: middle; margin-left: 6px;" src="<?= cdn_url() ?>msb/msbbillingslogo.png" alt="MSB Logo" /></a></div>
    </div>
</footer>
</div><!--/.fluid-container-->

<!-- ==================================================
     Backend JavaScript Libraries (Bootstrap 3, Select2, Toastr, DatePicker)
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

<!-- FastApp Application Console Scripts -->
<script src="<?= cdn_url(); ?>assets/custom/fastapp.js"></script>

<script type="text/javascript">
    $(function () {
        if ($.fn.selectpicker) {
            $('.languageselectpicker').selectpicker();
        }
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000"
            };
        }
    });

    function set_languages(lang_id) {
        if (typeof toastr !== 'undefined') {
            toastr.success("Language preference updated.");
        }
    }

    function markc(id) {
        if (typeof toastr !== 'undefined') {
            toastr.info("Task marked complete.");
        }
    }
</script>

<? execute_hook('footer');?>
</body>
</html>
