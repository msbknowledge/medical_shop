<style>
    /* Guaranteed 3-Column x 2-Row Layout for Medical Cards */
    .smart-progress-grid {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        gap: 16px !important;
        margin-bottom: 24px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .smart-card-link {
        display: block !important;
        text-decoration: none !important;
        color: inherit !important;
        height: 100% !important;
    }

    .smart-card-link:hover,
    .smart-card-link:focus {
        text-decoration: none !important;
        color: inherit !important;
    }

    .smart-progress-grid .topprograssstart {
        margin-bottom: 0 !important;
        height: 100% !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 14px 18px !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        min-height: 84px !important;
        box-sizing: border-box !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }

    .smart-progress-grid .topprograssstart:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08) !important;
        border-color: #cbd5e1 !important;
    }

    .smart-card-kpi-row {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 10px !important;
        width: 100% !important;
        margin-bottom: 12px !important;
    }

    .smart-card-kpi-title {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        min-width: 0 !important;
        flex: 1 !important;
    }

    .smart-card-kpi-title span {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
    }

    .smart-card-kpi-val {
        display: flex !important;
        align-items: baseline !important;
        gap: 4px !important;
        flex-shrink: 0 !important;
        white-space: nowrap !important;
    }

    .smart-card-kpi-val strong {
        font-size: 13.5px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
    }

    .smart-card-kpi-val small {
        font-size: 11px !important;
        font-weight: 500 !important;
        color: #64748b !important;
    }

    .smart-progress-track {
        height: 6px !important;
        background: #e2e8f0 !important;
        border-radius: 9999px !important;
        overflow: hidden !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .smart-progress-fill {
        height: 100% !important;
        border-radius: 9999px !important;
        transition: width 0.6s ease !important;
    }

    .progress-bar-aqua {
        background-color: #00c0ef !important;
    }

    .progress-bar-lris-blue {
        background-color: #17a2b8 !important;
    }

    .progress-bar-blue {
        background-color: #3b82f6 !important;
    }

    .progress-bar-red {
        background-color: #ef4444 !important;
    }

    .progress-bar-green {
        background-color: #10b981 !important;
    }

    .progress-bar-yellow {
        background-color: #f59e0b !important;
    }

    /* 2-Column Grid for Middle Charts */
    .smart-graph-grid {
        display: grid !important;
        grid-template-columns: 58% calc(42% - 16px) !important;
        gap: 16px !important;
        margin-bottom: 24px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .smart-graph-grid .box {
        margin-bottom: 0 !important;
        height: 100% !important;
    }

    /* 4-Column Grid for Lifetime Stats */
    .smart-stat-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 16px !important;
        margin-bottom: 24px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* 4-Column Grid for System Notice & Subscription License */
    .smart-license-grid {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 16px !important;
        align-items: stretch !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    .smart-license-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 16px 18px !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        height: 100% !important;
        box-sizing: border-box !important;
        min-height: 105px !important;
    }

    /* Modern Period Filter Toolbar */
    .smart-filter-toolbar {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 12px 18px !important;
        margin-bottom: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        flex-wrap: wrap !important;
        gap: 12px !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
    }

    .smart-period-pills {
        display: inline-flex !important;
        background: #f1f5f9 !important;
        padding: 4px !important;
        border-radius: 10px !important;
        gap: 4px !important;
    }

    .smart-period-btn {
        border: none !important;
        background: transparent !important;
        color: #64748b !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 6px 18px !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        outline: none !important;
    }

    .smart-period-btn:hover {
        color: #1e293b !important;
        background: rgba(255, 255, 255, 0.7) !important;
    }

    .smart-period-btn.active {
        background: #ffffff !important;
        color: var(--ss-primary, #6366f1) !important;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08) !important;
    }

    /* 4-Column Grid for Top Metrics (Screenshot Row 1) */
    .smart-metric-grid-4 {
        display: grid !important;
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
        gap: 16px !important;
        margin-bottom: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* 3-Column Grid for Balances & Health (Screenshot Row 2 & Row 3) */
    .smart-metric-grid-3 {
        display: grid !important;
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        gap: 16px !important;
        margin-bottom: 20px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* Modern Metric Card (Matching Screenshot exactly) */
    .smart-metric-card {
        background: #ffffff !important;
        border: 1px solid #edf2f7 !important;
        border-radius: 12px !important;
        padding: 18px 20px !important;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04) !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease !important;
        text-decoration: none !important;
        color: inherit !important;
        box-sizing: border-box !important;
        min-height: 120px !important;
    }

    .smart-metric-card:hover,
    .smart-metric-card:focus {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08) !important;
        border-color: #cbd5e1 !important;
        text-decoration: none !important;
        color: inherit !important;
    }

    .smart-metric-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 8px !important;
    }

    .smart-metric-title {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #475569 !important;
        margin: 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    .smart-metric-icon-wrap {
        width: 42px !important;
        height: 42px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        flex-shrink: 0 !important;
    }

    .smart-metric-value {
        font-size: 22px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        letter-spacing: -0.4px !important;
        line-height: 1.25 !important;
        margin-bottom: 4px !important;
    }

    .smart-metric-subtext {
        font-size: 11.5px !important;
        color: #94a3b8 !important;
        font-weight: 500 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    @media (max-width: 991px) {
        .smart-progress-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .smart-metric-grid-4 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .smart-metric-grid-3 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .smart-graph-grid {
            grid-template-columns: 1fr !important;
        }

        .smart-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .smart-license-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }

    @media (max-width: 640px) {
        .smart-progress-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .smart-metric-grid-4 {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .smart-metric-grid-3 {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .smart-stat-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .smart-license-grid {
            grid-template-columns: minmax(0, 1fr) !important;
        }

        .smart-filter-toolbar {
            flex-direction: column !important;
            align-items: stretch !important;
        }

        .smart-period-pills {
            width: 100% !important;
            justify-content: space-between !important;
        }

        .smart-period-btn {
            flex: 1 !important;
            text-align: center !important;
            padding: 6px 6px !important;
            font-size: 12px !important;
        }
    }
</style>


<div id="paynowModal1" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="text-align: center;">Payment</h3>


            </div>

            <table style="width:97%;height: 200px;margin:10px">
                <tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                        <!-- <h2>Googlepay QR Code...!!</h2> -->
                        <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="msbbilings QR code" height="400">
                    </td>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                        <!--<h2>Bank Transaction...!!</h2>-->
                        <!--<p><b>Bank: </b>Bank of Baroda</p>-->
                        <!--<p><b>A/C Name: </b>Logicmystery Technologies LLP</p>-->
                        <!--<p><b>A/C No: </b>36240200000161</p>-->
                        <!--<p><b>IFSC Code: </b>BARB0MEDINI</p>-->
                        <!--<p><b>A/C Type: </b>Current Account</p>-->


                    </td>
                </tr>
                <!--tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">Online Transaction..!!</td>
                    <td style="border: 1px dotted black;text-align: center;">
                <center>
                    <p><a href="https://www.instamojo.com/@logicmystery" target="_blank" class="btn btn-success" style="margin: 20px" >Pay Now</a></p>
                    <p style="font-size: 10px">* Gateway Charges apply...!!</p>
                </center>
                </td>

                </tr-->


            </table>
        </div>

    </div>

</div>
<div id="renewSubscription" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="text-align: center;">Your Subscription Will Expire 20/02/2026...!</h3>
            </div>
            <!-- <div class="modal-body">
            <p>Please Renew Your Subscription</p>
            </div> -->
            <script type="text/javascript">
                atOptions = {
                    'key': 'fe2fba551331bbf1ef39fcbf15780b0d',
                    'format': 'iframe',
                    'height': 50,
                    'width': 320,
                    'params': {}
                };
            </script>
            <table style="width:96%;height: 50px;margin:10px">
                <tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                        <p>Please Renew Your Subscription before expire date</p>
                        <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="msbbillings QR code" height="400">
                    </td>
                </tr>
            </table>
        </div>

    </div>

</div>
<!-- Module Dashboard Injected via Hook (e.g. antu/medical_helper.php for pharmacy) -->
<div class="row">
    <div class="col-lg-12">
        <?= execute_hook('dashboard'); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary borderwhite" style="margin-bottom: 24px; border-radius: 8px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);">
            <div class="box-header with-border" style="padding: 14px 20px; border-bottom: 1px solid #f1f5f9; text-align: center;">
                <h3 class="box-title" style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0; display: inline-block;">
                    Software License & Subscription Notice
                </h3>
            </div>
            <div class="box-body" style="padding: 18px 20px;">
                <!-- System Bulletin Bar -->
                <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(14, 165, 233, 0.05)); border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 14px; overflow: hidden;">
                    <span style="background: var(--ss-primary, #6366f1); color: #fff; padding: 4px 12px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; flex-shrink: 0; letter-spacing: 0.5px;">Notice</span>
                    <div style="flex: 1; min-width: 0; overflow: hidden;">
                        <marquee direction="left" style="font-size: 13.5px; font-weight: 500; color: #334155; margin: 0; display: block;" scrolldelay="120">
                            System is active with Smart Flow UI. For billing assistance, technical support or subscription renewal, please contact Support at +91 9382509991.
                        </marquee>
                    </div>
                </div>

                <!-- 4 Cards in Exactly 1 Grid Row -->
                <div class="smart-license-grid">
                    <!-- Card 1: Active Software Plan -->
                    <div class="smart-license-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            <i class="fa fa-cube" style="color: #6366f1; font-size: 14px;"></i> Active Software Plan
                        </div>
                        <div>
                            <div style="font-size: 17px; font-weight: 800; color: #0f172a; margin-bottom: 4px;"><?= PLAN_NAME ?></div>
                            <div style="font-size: 12px; color: #64748b;"><i class="fa fa-check-circle" style="color: #10b981;"></i> <?= str_ireplace(",", ", ", PLAN_PACKAGES) ?></div>
                        </div>
                    </div>

                    <!-- Card 2: Help Desk & Support -->
                    <div class="smart-license-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            <i class="fa fa-whatsapp" style="color: #25D366; font-size: 14px;"></i> Help Desk & Support
                        </div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">
                                <a href="https://wa.me/919382509991" target="_blank" style="color: #0284c7; text-decoration: none;">+91 9382509991</a>
                            </div>
                            <div style="font-size: 11.5px; color: #64748b;">Mon-Fri 12 PM - 6 PM (WhatsApp Only)</div>
                        </div>
                    </div>

                    <!-- Card 3: License Status -->
                    <div class="smart-license-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            <i class="fa fa-shield" style="color: #10b981; font-size: 14px;"></i> License Status
                        </div>
                        <div>
                            <div style="margin-bottom: 4px;">
                                <span class="label label-success" style="font-size: 12px; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                                    <i class="fa fa-check"></i> Active & Verified
                                </span>
                            </div>
                            <div style="font-size: 11.5px; color: #64748b;">Live Software License</div>
                        </div>
                    </div>

                    <!-- Card 4: Subscription Expiry -->
                    <div class="smart-license-card">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            <i class="fa fa-calendar" style="color: #ef4444; font-size: 14px;"></i> Subscription Expiry
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                                <span class="label label-important" style="font-size: 12.5px; padding: 5px 10px; border-radius: 6px; font-weight: 700;"><?= defined('DEACTIVATION_DATE') ? DEACTIVATION_DATE : date('Y-m-d', strtotime('+1 year')) ?></span>
                                <button class="btn btn-success btn-xs" id="paynow" style="font-size: 12px; padding: 5px 14px; font-weight: 600; border-radius: 6px;"><i class="fa fa-refresh"></i> Renew</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="deactive_date" value="<?= defined('DEACTIVATION_DATE') ? DEACTIVATION_DATE : '' ?>" style="display:none">
            </div>
        </div>
    </div>
</div>

<!-- Pay Now / Subscription Renewal Modal -->
<div id="paynowModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align: center; font-weight: 800; color: #0f172a; margin: 0;">
                    <i class="fa fa-qrcode" style="color: var(--ss-primary, #6366f1);"></i> Scan & Pay / Subscription Renewal
                </h4>
            </div>
            <div class="modal-body text-center" style="padding: 24px;">
                <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="msbbillings QR code" style="max-height: 340px; width: auto; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
                <div style="margin-top: 16px; font-size: 13.5px; color: #475569;">
                    Scan the QR code via Google Pay, PhonePe or Paytm to renew subscription.
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var nextmonth = "<?= date("Y-m-d", strtotime('+1 months')) ?>"
        var deactive_date = $('#deactive_date').val();
        $("#renewSubscription").modal('show');
        $("#renewSubscription").modal('hide');
        if (deactive_date <= nextmonth) {
            $("#renewSubscription").modal('show');
        }
        $("#paynowModal").modal('show');
        $("#paynowModal").modal('hide');
        $("#paynow").click(function() {
            $("#paynowModal").modal('show');
        });

        $('#paynow').on('click', function(e) {
            e.preventDefault();
            $('#paynowModal').modal('show');
        });
    });
</script>