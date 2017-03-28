/**
 * 登录页
 */
var Login = function () {
	
	var actionAlert = function(r,container){
		Metronic.alert({
			type: r.status ? 'success' : 'danger',
			icon:  r.status ? 'check' : 'warning',
            message: r.info,
            container: container+' .form-alert',
            place: 'prepend',
            closeInSeconds: 4
        });
	};
		
	var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'span',
	            errorClass: 'help-block', 
	            focusInvalid: false,
	            rules: {
	                hy_username: {
	                    required: true,
	                    digits:true
	                },
	                hy_password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },
	            messages: {
	                hy_username: {
	                    required: "用户名不可为空！"
	                },
	                hy_password: {
	                    required: "密码不可为空！"
	                }
	            },
	            invalidHandler: function (event, validator) {
	            },
	            highlight: function (element) {
	                $(element).closest('.form-group').addClass('has-error');
	            },
	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },
	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },
	            submitHandler: function (form) {
	    			Metronic.blockUI({
	    				message: '请稍后...',
	    				target: $('.login-form'),
                        cenrerY: true,
                        boxed: true,
                        overlayColor: 'none'
	                });
	    			var account = $.trim($('[name="hy_username"]').val());
        			var pwd = crypto_sha1($.trim($('[name="hy_password"]').val())+$('#login-addon').val());
        			$.ajax({
        				url: $.U('ajax?q=login'),
        				data: {u: crypto_aes(account, $('#login-key').val()), p: crypto_aes(pwd, pwd.substr(5, 32))},
        				type: 'POST',
        				timeout: 5000,
        				success: function(r){
        					actionAlert(r, '.login-form');
    	        			if(!r.status){
            					Metronic.unblockUI($('.login-form'));
    	        				$('[name="hy_password"]').val('').focus();
    	        				return false;
    	        			}else{
    	        				if($('[name="remember"]').prop('checked')){
    	        					$.store.set('HyFrame_loginAccount',account);
    	        				}else{
    	        					$.store.remove('HyFrame_loginAccount');
    	        				}
    	        				$.store.set('_homyit_token_counter_', r.data);
    	        				var seed = crypto_sha1(pwd+'#'+r.data).substr(7, 32);
    	        				$.store.set('_homyit_token_seed_', seed);
    	        				setTimeout(function(){
    	        					location.href = $.U('Index/index');
    	        				}, 100);
    	        			}
    	            	},
    	            	error: function(){
    	            		actionAlert({status: false, info: '登录失败，请重试！'}, '.login-form');
    	            		setTimeout(function(){
    	            			location.reload();
	        				}, 1500);
    	            		Metronic.unblockUI($('.login-form'));
    	            	}
        			});        					
	            	return false;
	            }
	        });
	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit();
	                }
	                return false;
	            }
	        });
	}

	// 载入上次记住的账号
	var initRember = function(){
		var account = $.store.get('HyFrame_loginAccount');
    	if(account) {
    		$('[name="hy_username"]').val(account);
    		$('[name="remember"]').attr('checked',true);
    		$.uniform.update('[name="remember"]');
    		$('[name="hy_password"]').focus();
    	}else{
    		$('[name="hy_username"]').focus();
    	}
	};
    
	var checkBrowerVersion = function(){
		// 浏览器版本检查
		if(/msie\s[67]/.test(navigator.userAgent.toLowerCase())){
			var html=['<h3 class="text-danger">检测到您的浏览器不支持HTML5的某些功能，这会影响到您访问本站的体验。',
			          '强烈推荐您使用Chrome内核（如最新版360安全浏览器、360极速浏览器、',
			          '猎豹浏览器等的极速模式、谷歌等）浏览器、火狐等现代浏览器登录系统！</h3>'].join('');
			bootbox.alert(html);
		}
	}
	
    return {
        init: function () {
        	checkBrowerVersion();
        	initRember();
            handleLogin();
        }
    };

}();