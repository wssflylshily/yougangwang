
var Base = function() {
    this.waiting = false;
}

Base.prototype.initForm = function(uri) {
    var self = this;
    var uri = uri || false;

    // ajax提交
    $(document).on('submit', '.main-form', function() {
        var self = $(this);
        self.find('button[type="submit"]').addClass('disabled');

        $(this).ajaxSubmit({
//            type:"post",        //提交方式
//            dataType:"json",    //数据类型
//            url:"${basePath}/login.action", //请求url
            success: function(response) {
                if (response.result !== true) {
                    self.find('button[type="submit"]').removeClass('disabled');
                    /*$.notifyBar({html: response.message, cls : 'error'});*/
                    $.toaster({ priority : 'danger', title : '失败', message : response.message });
                    return;
                }

                /*$.notifyBar({html: response.message, cls : 'success'});*/
                $.toaster({ priority : 'success', title : '成功', message : response.message });

                if (response.go_url) {
                    setTimeout(function() {
                        window.location.href = response.go_url;
                    }, 3000);
                } else if (uri) {
                    if (uri == 'edit') {
                        uri += '/' + response.new_id;
                    }

                    setTimeout(function() {
                        window.location.href = uri;
                    }, 3000);
                }
            },
            error: function () {
                self.find('button[type="submit"]').removeClass('disabled');
                /*$.notifyBar({html: '请求失败请重新提交', cls : 'error'});*/
                $.toaster({ priority : 'danger', title : '失败', message : response.message });
            }
        });

        return false;
    });
}

Base.prototype.disableCaptcha = function(target, second) {
    this.waiting = true;
    target.css({'backgroundColor': '#ccc'});
    alert('由于刷新页面，之前的验证码已失效');

    // 每秒递减等待时间
    var func = function() {
        target.text(second-- + '秒后可重试');
    }

    func();
    var timer = setInterval(func, 1000);

    // 60秒后可再次使用
    setTimeout(function() {
        self.waiting = false;
        target.removeAttr('style');
        target.text('获取验证码');
        clearInterval(timer);
    }, second * 1000);
}

Base.prototype.sendCaptcha = function(target) {
    var self = this;

    var data = {
        mobile  : $('input[name="mobile"]').val(),
        _token  : $('#csrfToken').val()
    };

    if (self.waiting === true) {
        alert('请稍候...验证码每60秒只能发送一次');
        return false;
    }
    self.waiting = true;
    target.css({'backgroundColor': '#ccc'});

    $.post('/common/captcha/sms', data, function(response) {
        if (response.result !== true) {
            $.toaster({ priority : 'danger', title : '失败', message : response.message });
            self.waiting = false;
            target.removeAttr('style');
            return false;
        }

        $.toaster({ priority : 'success', title : '成功', message : response.message });

        // 每秒递减等待时间
        var second = 60;
        var func = function() {
            target.text(second-- + '秒后可重试');
        }

        func();
        var timer = setInterval(func, 1000);

        // 60秒后可再次使用
        setTimeout(function() {
            self.waiting = false;
            target.removeAttr('style');
            target.text('获取验证码');
            clearInterval(timer);
        }, 60000);
    }).complete(function(){
        //
    }).error(function(){
        $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
        self.waiting = false;
        target.removeAttr('style');
    });
}
