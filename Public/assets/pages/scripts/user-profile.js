var userProfile = function() {
    //表单验证
    var check = function() {
        $('#form-pwd').validate({
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 30
                },
                confirm_pwd: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                old_password: {
                    required: "<span style='color:#ff371a;font-size:8px;'>密码不可为空！</span>"
                },
                password: {
                    required: "<span style='color:#ff4860;font-size:8px;'>密码不可为空！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为6个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为30个长度</span>"
                },
                confirm_pwd: {
                    required: "<span style='color:#ff564d;font-size:8px;'>密码不可为空！</span>",
                    equalTo: "<span style='color:#ff564d;font-size:8px;'>两次输入密码不同！</span>"
                }

            },
            submitHandler: function (form) {
                var old_password = $.trim( $('#old_password').val() );
                var password = $.trim( $('#password').val() );
                var confirm_pwd= $.trim( $('#confirm_pwd').val() );
                var pwd = crypto_sha1($.trim($('#old_password').val()) + $('#login-addon').val());
                $.ajax({
                    url: 'ajax?q=pwdMe',
                    type: 'POST',
                    data: {
                        p: crypto_aes(pwd, pwd.substr(5, 32)),
                        password:password,
                        confirm_pwd:confirm_pwd
                    },
                    success: function (item) {
                        $.actionAlert(item);
                    }
                })
            }

        });

        $('#form-base').validate({
            rules: {
                userNo: {
                    minlength: 3,
                    maxlength: 11
                },
                phone: {
                    number: true,
                    minlength: 7,
                    maxlength: 11

                },
                qq: {
                    number: true,
                    minlength: 5,
                    maxlength: 10
                },
                email: {
                    email: true
                },
                hometown: {
                    maxlength: 30
                },
                github: {
                    maxlength: 100
                }
            },
            messages: {
                userNo: {
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为3个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为11个长度</span>"

                },
                phone: {
                    number: "<span style='color:#ff371a;font-size:8px;'>必须是数字！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为7个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为11个长度</span>"

                },
                qq: {
                    number: "<span style='color:#ff371a;font-size:8px;'>必须是数字！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为5个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为10个长度</span>"
                },
                email: {
                    email: "<span style='color:#ff564d;font-size:8px;'>要符合邮箱的格式！</span>"

                },
                hometown: {
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为30个长度</span>"
                },
                github: {
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为100个长度</span>"
                }
            },
            submitHandler: function (form) {
                var userNo = $.trim($('#user_no').val());
                var name = $.trim($('#name').val());
                var phone = $.trim($('#phone').val());
                var qq = $.trim($('#qq').val());
                var email = $.trim($('#email').val());
                var hometown = $.trim($('#hometown').val());
                var github = $.trim($('#github').val());
                $.ajax({
                    url: 'ajax?q=updateMe',
                    data: {
                        userNo: userNo,
                        phone: phone,
                        qq: qq,
                        email: email,
                        hometown: hometown,
                        github: github,
                        name: name
                    },
                    success: function (item) {
                        $.actionAlert(item);
                    }
                })
            }

        });
    }
    return {
        init: function () {
            check();
        }
    };
}();

