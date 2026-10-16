<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container-fluid" style="padding: 0;">
            <div class="row-fluid" style="margin: 0;">
                <div class="bgoffsetbg">  
                    <!-- Left Side: Login Form (Smart School 4-col Style) -->
                    <div class="col-lg-4 col-md-5 col-sm-12 nopadding">  
                        <div class="loginbg">  
                            <div class="form-top">
                                <div class="form-top-left logowidth">
                                    <div class="ss-brand-badge" style="display: inline-flex; align-items: center; gap: 8px; background: #eef2ff; color: #6366f1; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 9999px; margin-bottom: 14px; border: 1px solid rgba(99, 102, 241, 0.2);">
                                        <i class="fa fa-medkit"></i> Medical Shop Billing
                                    </div>
                                    <img src="<?= cdn_url() ?>msb/msbbillingslogo.png" alt="Medical Shop Logo" style="height: 44px; width: auto; object-fit: contain; display: block; margin-bottom: 12px;" />    
                                </div>
                            </div>
                            <div class="form-bottom">
                                <h3 class="font-white bolds" style="font-size: 22px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">Admin / Staff Login</h3>
                                <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;">Sign in to your pharmacy management portal</p>
                                
                                <div class="alert alert-info" style="border-radius: 8px; font-size: 13px; padding: 10px 14px; margin-bottom: 16px;">
                                    <div>Please login with your Username and Password.</div>
                                </div>

                                <form action="<?= console_url() ?>user/login" id="signin_form" class="form-horizontal" onsubmit="validate_signin_form(this); return false;" method="post">
                                    <div class="form-group has-feedback" style="position: relative; margin-bottom: 14px;">                                            
                                        <input type="text" name="username" placeholder="Username / Email" value="" class="form-username form-control" id="username" autofocus from-validation="required" style="height: 46px; padding: 10px 40px 10px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; width: 100%; box-sizing: border-box; font-size: 13.5px;">
                                        <span class="fa fa-envelope form-control-feedback" style="position: absolute; right: 0; top: 0; width: 40px; height: 46px; display: flex; align-items: center; justify-content: center; color: #94a3b8; pointer-events: none;"></span>
                                        <span class="help-inline" style="display:none; color: #ef4444; font-size: 12px; margin-top: 4px;">Please Enter Username</span>
                                    </div>
                                    <div class="form-group has-feedback" style="position: relative; margin-bottom: 16px;">                      
                                        <input type="password" value="" name="password" placeholder="Password" class="form-password form-control" id="password" from-validation="required" style="height: 46px; padding: 10px 40px 10px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; width: 100%; box-sizing: border-box; font-size: 13.5px;">
                                        <span class="fa fa-lock form-control-feedback" style="position: absolute; right: 0; top: 0; width: 40px; height: 46px; display: flex; align-items: center; justify-content: center; color: #94a3b8; pointer-events: none;"></span>
                                        <span class="help-inline" style="display:none; color: #ef4444; font-size: 12px; margin-top: 4px;">Please Enter Password</span>
                                    </div>

                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; font-size: 13px;">
                                        <label class="remember" for="remember" style="margin: 0; display: inline-flex; align-items: center; gap: 6px; font-weight: 500; color: #475569; cursor: pointer;">
                                            <input type="checkbox" name="remember" id="remember" style="margin: 0;" /> Remember me
                                        </label>
                                        <a href="<?= console_url('user/forgot_password'); ?>" class="forgot" style="color: #6366f1; font-weight: 600; text-decoration: none;"><i class="fa fa-key"></i> Forgot Password?</a>
                                    </div>

                                    <button type="submit" id="btn-login-submit" class="btn btn-primary" style="width: 100%; height: 46px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none; border-radius: 8px; color: #fff; font-size: 14.5px; font-weight: 700; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35); cursor: pointer; transition: all 0.2s ease;">
                                        Sign In <i class="fa fa-arrow-right" style="margin-left: 6px;"></i>
                                    </button>
                                </form>

                                <!-- Smart School Quick Role Selectors -->
                                <div class="btn-group btn-group-justified" style="margin-top: 18px; display: flex; gap: 6px;"> 
                                    <a href="javascript:void(0)" class="btn" onclick="copy('admin', 'admin123')" data-toggle="tooltip" title="Fill Admin" style="background: #0084B4; color: #fff; flex: 1; padding: 8px 4px; font-size: 11.5px; font-weight: 600; border-radius: 6px; text-align: center; text-decoration: none;"><i class="fa fa-user-secret"></i> Admin</a>
                                    <a href="javascript:void(0)" class="btn" onclick="copy('cashier', 'password')" data-toggle="tooltip" title="Fill Cashier" style="background: #1bbed3; color: #fff; flex: 1; padding: 8px 4px; font-size: 11.5px; font-weight: 600; border-radius: 6px; text-align: center; text-decoration: none;"><i class="fa fa-user-secret"></i> Cashier</a>
                                    <a href="javascript:void(0)" class="btn" onclick="copy('pharmacist', 'password')" data-toggle="tooltip" title="Fill Pharmacist" style="background: #10b981; color: #fff; flex: 1; padding: 8px 4px; font-size: 11.5px; font-weight: 600; border-radius: 6px; text-align: center; text-decoration: none;"><i class="fa fa-user-secret"></i> Staff</a>                                    
                                </div>
                                <span style="text-align: center; font-size: 11.5px; display: block; padding-top: 10px; color: #94a3b8;">*Note: Click a role button to prefill credentials for fast testing.</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side: Photographic Showcase (Smart School 8-col Style) -->
                    <div class="col-lg-8 col-md-7 col-sm-12 nopadding-2">
                        <div class="d-flex align-items-center text-wrap flex-column justify-content-center bg-position-sm-left bg-position-lg-center" style="background: url('<?= cdn_url() ?>assets/backend/images/login_bg.jpg') no-repeat center center / cover; position: relative;">  
                            <!-- Overlay tint -->
                            <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(135deg, rgba(15, 23, 42, 0.82) 0%, rgba(30, 27, 75, 0.75) 100%); z-index: 1;"></div>
                            
                            <div class="bg-shadow-remove" style="position: relative; z-index: 2; width: 85%; max-width: 600px; padding: 20px;">
                                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.35); padding: 5px 14px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 16px; color: #c7d2fe; border: 1px solid rgba(255, 255, 255, 0.2);">
                                    <i class="fa fa-star"></i> Enterprise Pharmacy Cloud
                                </div>
                                
                                <h3 class="h3" style="color: #ffffff; font-size: 26px; font-weight: 800; margin: 0 0 18px 0; text-align: left; letter-spacing: -0.02em;">What's New in Medical Shop Billing</h3>
                                
                                <div class="loginright" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 16px; padding: 24px; max-height: 380px; overflow-y: auto;">
                                    <div class="messages"> 
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-barcode" style="color: #818cf8; margin-right: 6px;"></i> High-Speed POS & Barcode Checkout</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">Instant barcode batch search, keyboard shortcuts, multiple payment modes, and rapid 2-inch/3-inch thermal bill printing.</p>
                                        
                                        <div class="logdivider" style="background: rgba(255, 255, 255, 0.12); width: 100%; height: 1px; margin: 14px 0;"></div>
                                        
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-calendar-check-o" style="color: #34d399; margin-right: 6px;"></i> Batch Tracking & Expiry Alerts</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">Automated FIFO drug dispensing protects against dispensing near-expiry medicine with proactive 30/60/90 days notifications.</p>
                                        
                                        <div class="logdivider" style="background: rgba(255, 255, 255, 0.12); width: 100%; height: 1px; margin: 14px 0;"></div>
                                        
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-line-chart" style="color: #38bdf8; margin-right: 6px;"></i> Stock & Profit Performance Analytics</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">Real-time inventory levels, re-order level triggers, supplier purchase records, and day-end net profit calculation.</p>
                                        
                                        <div class="logdivider" style="background: rgba(255, 255, 255, 0.12); width: 100%; height: 1px; margin: 14px 0;"></div>
                                        
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-shield" style="color: #fbbf24; margin-right: 6px;"></i> GST Ready Compliance & Cloud Backup</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">Standardized GST tax invoice formats, HSN/SAC code mapping, multi-rate tax computation, and automated database backups.</p>
                                    </div>  
                                </div>
                            </div>  
                        </div>  
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<script>
    function copy(username, password) {
        document.getElementById("username").value = username;
        document.getElementById("password").value = password;
        if (window.jQuery) {
            $('#username').parent().find('.help-inline').hide();
            $('#password').parent().find('.help-inline').hide();
        }
    }

    function validate_signin_form(targetForm) {
        var $form = window.jQuery ? $(targetForm || '#signin_form') : null;
        var username = document.getElementById("username") ? document.getElementById("username").value.trim() : "";
        var password = document.getElementById("password") ? document.getElementById("password").value.trim() : "";
        var valid = true;

        if (window.jQuery) {
            $('#username').parent().find('.help-inline').hide();
            $('#password').parent().find('.help-inline').hide();
        }

        if (username === '') {
            if (window.jQuery) {
                $('#username').parent().find('.help-inline').show();
            }
            document.getElementById("username").focus();
            valid = false;
        }
        if (password === '') {
            if (window.jQuery) {
                $('#password').parent().find('.help-inline').show();
            }
            if (valid) {
                document.getElementById("password").focus();
            }
            valid = false;
        }

        if (valid) {
            ajax_signin_form_submit($form || targetForm);
        }
        return false;
    }

    function ajax_signin_form_submit(targetForm) {
        var $form = $(targetForm || '#signin_form');
        var $btn = $('#btn-login-submit');
        var originalBtnHtml = $btn.html();

        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Signing in...');

        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json'
        }).done(function (respData) {
            if (typeof respData === 'string') {
                try {
                    respData = JSON.parse(respData);
                } catch(e) {}
            }

            if (respData && respData.status === 'success') {
                $('.alert')
                    .removeClass('alert-info alert-error alert-danger')
                    .addClass('alert-success')
                    .html('<div style="color: #10b981; font-weight: 700;"><i class="fa fa-check-circle"></i> ' + (respData.message || 'Login Successful! Redirecting...') + '</div>');
                
                $btn.html('<i class="fa fa-check"></i> Success! Redirecting...');
                
                setTimeout(function () {
                    window.location.href = '<?= console_url() ?>';
                }, 800);
            } else {
                $btn.prop('disabled', false).html(originalBtnHtml);
                var errMsg = (respData && respData.message) ? respData.message : 'Login failed. Please check your credentials.';
                $('.alert')
                    .removeClass('alert-info alert-success')
                    .addClass('alert-error alert-danger')
                    .html('<div style="color: #ef4444; font-weight: 600;"><i class="fa fa-exclamation-circle"></i> ' + errMsg + '</div>');
            }
        }).fail(function (xhr, status, error) {
            $btn.prop('disabled', false).html(originalBtnHtml);
            $('.alert')
                .removeClass('alert-info alert-success')
                .addClass('alert-error alert-danger')
                .html('<div style="color: #ef4444; font-weight: 600;"><i class="fa fa-exclamation-triangle"></i> Network or server error. Please try again.</div>');
        });
    }

    function validate_captcha(targetObject) {
        return true;
    }

    function refresh_captcha() {
    }

    function duplicate_check(targetObject) {
        return true;
    }
</script>
