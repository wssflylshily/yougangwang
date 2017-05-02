var Cart = function()
{
    this.waiting = false;
}

Cart.prototype.count = function() {
    var data = {
        _token: $('#csrfToken').val(),
    };

    $.post('/cart/count', data, function(response) {
        if (response.result !== true) {
            return false;
        }

        $('.cart .list_num').text(response.cart_count);
    }).complete(function() {
        //
    }).error(function(){
        //
    });
}

Cart.prototype.add = function(goods_id, buy_number) {
    var self = this;

    if (buy_number == 0) {
        alert('购买数量不能为0');
    }


    var data = {
        _token: $('#csrfToken').val(),
        goods_id: goods_id,
        buy_number: buy_number
    };

    $.post('/cart/add', data, function(response) {
        if (response.result !== true) {
            $.toaster({ priority : 'danger', title : '失败', message : response.message });
            return false;
        }

        $.toaster({ priority : 'success', title : '成功', message : response.message });
        $('.cart .list_num').text(response.cart_count);
    }).complete(function() {
        //
    }).error(function(xhr){
        // console.log(xhr);
        if (xhr.status == 401) {
            $.confirm("", "登陆后才可以添加购物车，确认登陆？", function() {
                $.toast("去登陆");
                window.location.href="/login";
            }, function() {
                //取消操作
            });
        }
        //$.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
    });
}

Cart.prototype.deleteSelected = function(selected, target)
{
    var self = this;
    var type;

    if (typeof(selected) == "undefined") {
        var selected = [];
        var target   = [];
        var seller   = [];
        $('input:checked[name="onecheck[]"]').each(function() {
            selected.push($(this).val());

            var $car_list =$(this).closest('dl.car_list');
            if ($car_list.find('input[name="c_all"]').prop("checked") && $.inArray($car_list.find('input[name="c_all"]').data('rel'), seller == -1)) {
                target.push($car_list);
                seller.push($car_list.find('input[name="c_all"]').data('rel'));
            } else {
                target.push($(this).closest('dd.clear'));
            }
        });

        type = 'multi';
    } else {
        var selected = [selected];
        type = 'single';
    }

    if (selected.length < 1) {
        alert('您没有选中要删除的现货');
        return;
    }

    var data = {
        goods_id: selected,
        _token  : $('#csrfToken').val()
    };

    /*if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;*/

    $.post('/cart/delete', data, function(response) {
        if (response.result !== true) {
            $.toaster({ priority : 'danger', title : '失败', message : response.message });
            return false;
        }

        $.toaster({ priority : 'success', title : '成功', message : response.message });

        if (type == "multi") {
            $(target).each(function() {
                var $el = this;
                $el.slideUp(500, function() {
                    $el.remove();
                    $('.seller-cnt').text($('.shop_car dl.car_list').size());
                    $('.cart .list_num').text($('.shop_car dd.clear').size());
                });
            });
        } else if (type == "single") {
            if (target.closest('dl.car_list').find('dd').size() > 1) {
                var $el = target.closest('dd.clear');
            } else {
                var $el = target.closest('dl.car_list');
            }

            $el.slideUp(500, function() {
                $el.remove();
                $('.seller-cnt').text($('.shop_car dl.car_list').size());
                $('.cart .list_num').text($('.shop_car dd.clear').size());
            });
        } else {
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        }

        setTimeout(function() {
            allcheck();
        }, 1000);
    }).complete(function(){
        self.waiting = false;
    }).error(function(){
        $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
    });
}

//Cart.prototype.checkoutSelected = function(selected, target)
//{
//    var self = this;
//    var type;
//
//    if (typeof(selected) == "undefined") {
//        var selected = [];
//        var target   = [];
//        var seller   = [];
//        $('input:checked[name="onecheck[]"]').each(function() {
//            selected.push($(this).val());
//
//            var $car_list =$(this).closest('dl.car_list');
//            if ($car_list.find('input[name="c_all"]').prop("checked") && $.inArray($car_list.find('input[name="c_all"]').data('rel'), seller == -1)) {
//                target.push($car_list);
//                seller.push($car_list.find('input[name="c_all"]').data('rel'));
//            } else {
//                target.push($(this).closest('dd.clear'));
//            }
//        });
//
//        type = 'multi';
//    }
//
//    if (selected.length < 1) {
//        alert('您没有选中要删除的现货');
//        return;
//    }
//
//    var data = {
//        goods_id: selected,
//        _token  : $('#csrfToken').val()
//    };
//
//    if (self.waiting === true) {
//        alert('请稍候...有其他操作正在执行');
//    }
//    self.waiting = true;
//
//    $.post('/cart/checkout', data, function(response) {
//        if (response.result !== true) {
//            $.toaster({ priority : 'danger', title : '失败', message : response.message });
//            return false;
//        }
//
//        $.toaster({ priority : 'success', title : '成功', message : response.message });
//
//        if (type == "multi") {
//            $(target).each(function() {
//                var $el = this;
//                $el.slideUp(500, function() {
//                    $el.remove();
//                    $('.seller-cnt').text($('.shop_car dl.car_list').size());
//                    $('.cart .list_num').text($('.shop_car dd.clear').size());
//                });
//            });
//        } else {
//            setTimeout(function() {
//                window.location.reload();
//            }, 3000);
//        }
//
//        setTimeout(function() {
//            allcheck();
//        }, 1000);
//    }).complete(function(){
//        self.waiting = false;
//    }).error(function(){
//        $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//    });
//}
