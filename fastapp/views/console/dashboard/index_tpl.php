<div class="index-wrapper">
    <div class="widget-area row-fluid">
        <div class="box span12">
            <div class="box-header well" data-original-title="">
                <h2><i class="fa fa-bullhorn" style="color: var(--ss-primary);"></i> Subscription & System Notification</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-close btn-round"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(14, 165, 233, 0.05)); border: 1px solid var(--ss-border); border-radius: 12px; padding: 10px 16px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                    <span style="background: var(--ss-primary); color: #fff; padding: 4px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Notice</span>
                    <marquee direction="left" style="vertical-align: middle; font-size: 14px; font-weight: 500; color: var(--ss-text-body); margin: 0;" scrolldelay="120">   
                        We have updated our system for smoothness and better security. All customers are requested to change the user account password as early as possible! Please call 9382509991 in case of any issue.
                    </marquee>
                </div>

                <div class="row-fluid" style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <div class="span3" style="margin-left: 0;">
                        <div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 14px; padding: 18px; box-shadow: var(--ss-shadow-xs); height: 100%;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: var(--ss-text-muted); font-size: 12px; font-weight: 700; text-transform: uppercase;">
                                <i class="fa fa-cube" style="color: var(--ss-primary); font-size: 14px;"></i> Active Plan
                            </div>
                            <div style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-bottom: 6px;"><?= PLAN_NAME ?></div>
                            <div style="font-size: 12px; color: var(--ss-text-muted);"><i class="fa fa-check-circle" style="color: var(--ss-success);"></i> <?= str_ireplace(",",", ",PLAN_PACKAGES) ?></div>
                        </div>
                    </div>

                    <div class="span3" style="margin-left: 0;">
                        <div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 14px; padding: 18px; box-shadow: var(--ss-shadow-xs); height: 100%;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: var(--ss-text-muted); font-size: 12px; font-weight: 700; text-transform: uppercase;">
                                <i class="fa fa-whatsapp" style="color: #25D366; font-size: 14px;"></i> Support Desk
                            </div>
                            <div style="font-size: 14px; font-weight: 700; color: var(--ss-text-main); margin-bottom: 4px;">+91 9382509991</div>
                            <div style="font-size: 11.5px; color: var(--ss-text-muted);">Mon-Fri 12 PM - 6 PM (WhatsApp Only)</div>
                        </div>
                    </div>

                    <div class="span3" style="margin-left: 0;">
                        <div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 14px; padding: 18px; box-shadow: var(--ss-shadow-xs); height: 100%;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: var(--ss-text-muted); font-size: 12px; font-weight: 700; text-transform: uppercase;">
                                <i class="fa fa-shield" style="color: var(--ss-success); font-size: 14px;"></i> Account Status
                            </div>
                            <div style="margin-top: 4px;">
                                <span class="label label-success" style="font-size: 12px; padding: 4px 12px;"><i class="fa fa-check"></i> Active</span>
                            </div>
                        </div>
                    </div>

                    <div class="span3" style="margin-left: 0;">
                        <div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 14px; padding: 18px; box-shadow: var(--ss-shadow-xs); height: 100%;">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: var(--ss-text-muted); font-size: 12px; font-weight: 700; text-transform: uppercase;">
                                <i class="fa fa-calendar" style="color: var(--ss-danger); font-size: 14px;"></i> Expiry Date
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-top: 4px;">
                                <span class="label label-important" style="font-size: 12px; padding: 4px 10px;"><?= DEACTIVATION_DATE ?></span>
                                <button class="btn btn-success" id="paynow" style="font-size: 12px; padding: 5px 12px;"><i class="fa fa-refresh"></i> Renew</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="deactive_date" value="<?= DEACTIVATION_DATE ?>" style="display:none">
            </div>
        </div>
    </div>
    <div class="widget-area row-fluid">
        <?= execute_hook('dashboard');?>
    </div>
</div>

<div id="paynowModal" class="modal fade">

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
                    <img src="<?=base_url();?>msb/g-pay4500.jpeg" alt="msbbilings QR code" height="400">
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
<div id="renewSubscription" class="modal fade" >

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
		'key' : 'fe2fba551331bbf1ef39fcbf15780b0d',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	
</script>
            <table style="width:96%;height: 50px;margin:10px">
                <tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                    <p>Please Renew Your Subscription before expire date</p>
                    <img src="<?=base_url();?>msb/g-pay4500.jpeg" alt="msbbillings QR code" height="400">
                    </td>
                </tr>
            </table>
        </div>

    </div>

</div>
<script>

$(document).ready(function(){
    var nextmonth = "<?= date("Y-m-d", strtotime('+1 months'))?>"
    var deactive_date = $('#deactive_date').val();
    $("#renewSubscription").modal('show');
    $("#renewSubscription").modal('hide');
    if(deactive_date <= nextmonth){
    $("#renewSubscription").modal('show');
    }
    $("#paynowModal").modal('show');
    $("#paynowModal").modal('hide');
    $("#paynow").click(function(){
        $("#paynowModal").modal('show');
    });
});

</script>
