<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container-fluid" style="padding: 0;">
            <div class="row-fluid" style="margin: 0;">
                <div class="bgoffsetbg">  
                    <!-- Left Side: Password Recovery Form (Smart School 4-col Style) -->
                    <div class="col-lg-4 col-md-5 col-sm-12 nopadding">  
                        <div class="loginbg">  
                            <div class="form-top">
                                <div class="form-top-left logowidth">
                                    <div class="ss-brand-badge" style="display: inline-flex; align-items: center; gap: 8px; background: #eef2ff; color: #6366f1; font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 9999px; margin-bottom: 14px; border: 1px solid rgba(99, 102, 241, 0.2);">
                                        <i class="fa fa-key"></i> Password Recovery
                                    </div>
                                    <img src="<?= cdn_url() ?>msb/msbbillingslogo.png" alt="Medical Shop Logo" style="height: 44px; width: auto; object-fit: contain; display: block; margin-bottom: 12px;" />    
                                </div>
                            </div>
                            <div class="form-bottom">
                                <h3 class="font-white bolds" style="font-size: 22px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">Reset Password</h3>
                                <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;">Enter your registered username to receive recovery instructions</p>
                                
                                <div class="alert alert-info" style="border-radius: 8px; font-size: 13px; padding: 10px 14px; margin-bottom: 16px;">
                                    <div>Please enter your registered Username / Email.</div>
                                </div>

                                <form action="<?= console_url() ?>user/forgot_password" id="signin_form" class="form-horizontal" onsubmit="return validate_signin_form(this);" method="post">
                                    <div class="form-group has-feedback" style="position: relative; margin-bottom: 18px;">                                            
                                        <input type="text" name="username" placeholder="Username / Email" value="" class="form-username form-control" id="username" autofocus from-validation="required" style="height: 46px; padding: 10px 40px 10px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; width: 100%; box-sizing: border-box; font-size: 13.5px;">
                                        <span class="fa fa-envelope form-control-feedback" style="position: absolute; right: 0; top: 0; width: 40px; height: 46px; display: flex; align-items: center; justify-content: center; color: #94a3b8; pointer-events: none;"></span>
                                        <span class="help-inline" style="display:none; color: #ef4444; font-size: 12px; margin-top: 4px;">Please Enter Username</span>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <a href="<?= console_url('user/login'); ?>" class="forgot" style="color: #6366f1; font-weight: 600; text-decoration: none; font-size: 13px;">
                                            <i class="fa fa-arrow-left"></i> Back to Login
                                        </a>
                                    </div>

                                    <button type="submit" class="btn btn-primary" style="width: 100%; height: 46px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none; border-radius: 8px; color: #fff; font-size: 14.5px; font-weight: 700; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35); cursor: pointer; transition: all 0.2s ease;">
                                        Send Reset Link <i class="fa fa-paper-plane" style="margin-left: 6px;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side: Support & Assistance Showcase -->
                    <div class="col-lg-8 col-md-7 col-sm-12 nopadding-2">
                        <div class="d-flex align-items-center text-wrap flex-column justify-content-center bg-position-sm-left bg-position-lg-center" style="background: url('<?= cdn_url() ?>assets/backend/images/login_bg.jpg') no-repeat center center / cover; position: relative;">  
                            <!-- Overlay tint -->
                            <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(135deg, rgba(15, 23, 42, 0.82) 0%, rgba(30, 27, 75, 0.75) 100%); z-index: 1;"></div>
                            
                            <div class="bg-shadow-remove" style="position: relative; z-index: 2; width: 85%; max-width: 600px; padding: 20px;">
                                <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(99, 102, 241, 0.35); padding: 5px 14px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 16px; color: #c7d2fe; border: 1px solid rgba(255, 255, 255, 0.2);">
                                    <i class="fa fa-shield"></i> Security Verification
                                </div>
                                
                                <h3 class="h3" style="color: #ffffff; font-size: 26px; font-weight: 800; margin: 0 0 18px 0; text-align: left; letter-spacing: -0.02em;">Need Account Assistance?</h3>
                                
                                <div class="loginright" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 16px; padding: 24px;">
                                    <div class="messages"> 
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-info-circle" style="color: #818cf8; margin-right: 6px;"></i> Password Retrieval Protocol</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">Once requested, a secure password reset link or temporary passcode will be generated for your verified shop staff account.</p>
                                        
                                        <div class="logdivider" style="background: rgba(255, 255, 255, 0.12); width: 100%; height: 1px; margin: 14px 0;"></div>
                                        
                                        <h4 style="font-weight: 700; font-size: 15px; color: #ffffff; margin: 0 0 6px 0;"><i class="fa fa-headphones" style="color: #34d399; margin-right: 6px;"></i> Help Desk & Customer Care</h4>
                                        <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.8); margin: 0;">For urgent password recovery or credential resets, please contact our support team:</p>
                                        
                                        <div style="background: rgba(255, 255, 255, 0.08); padding: 12px 16px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.1); margin-top: 12px;">
                                            <div style="font-size: 13px; font-weight: 700; color: #ffffff;"><i class="fa fa-whatsapp" style="color: #25d366; margin-right: 6px;"></i> WhatsApp Support: +91 9382509991</div>
                                            <div style="font-size: 12px; color: rgba(255, 255, 255, 0.7); margin-top: 4px;">Service Hours: Monday – Saturday (10:00 AM – 7:00 PM)</div>
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
</div>

<script>
    function validate_signin_form(targetForm){
        if(validate_form(targetForm,
        {
            beforeValidation : function(targetObject){
                $(targetObject).parent().children('.help-inline').hide().css('color','#333333');
            },
            onValidationError : function (targetObject){
                $(targetObject).parent().children('.help-inline').show().css('color','red');
            },
            captchaValidator :function (targetObject){return validate_captcha(targetObject);},
            duplicateValidator :function (targetObject){return duplicate_check(targetObject);}
                
        })){
            ajax_signin_form_submit(targetForm);
        }
        return false;
    }
    
    function ajax_signin_form_submit(targetForm){
        $.post($(targetForm).attr('action'), $(targetForm).serialize(), function(respData){
            //console.log($(targetForm).attr('action'));
            if(respData.status =='success'){
                $('.alert').removeClass('alert-info alert alert-error')
                .addClass('progress progress-striped progress-success active')
                .children('div').addClass('bar').css({'width':'100%','height':'42px','line-height':'42px','text-align':'center'})
                .html(respData.message);
                setTimeout(function(){
                    window.location = '<?= console_url() ?>';
                }, 1000);
               
            } else {
                $('.alert').removeClass('alert-info').addClass('alert-error').children('div').html(respData.message);
            }
        }, 'json');
    }
    
    function validate_captcha(targetObject){
        var success=false;
        $.ajax({
            type: "POST",
            async: false,
            url: "captcha_check",
            dataType:'json',
            data: { captcha: $(targetObject).val()}
        })
        .done(function(respData){
            console.log(respData);
            if(respData.status =='success')
                success=true;
            else
                success=false;
        });
        return success;
    }
    
    function refresh_captcha(){
        $.post('refresh_captcha', {data:'refresh'}, function(respData){
            $('.captchaContainer').html(respData);
        },'html');
    }
    
    function duplicate_check(targetObject){
        return true;
    }
</script>