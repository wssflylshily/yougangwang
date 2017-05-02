var User = function()
{
    this.waiting = false;
}

User.prototype.hotSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要特卖的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要设置为热卖商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

//  $.post('/admin/user/delete', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
////        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}

//取消特卖
User.prototype.deletehotSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要特卖的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要设置为热卖商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

//  $.post('/admin/user/delete', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
////        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}

User.prototype.startSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });
    alert(selected);

    if (selected.length < 1) {
        alert('您没有选中要启用的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要启用选中的商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    //self.waiting = true;

//  $.post('/admin/stocks/active', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
// //        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}
User.prototype.endSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要禁用的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要禁用选中的商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

//  $.post('/admin/user/delete', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
////        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}
User.prototype.tuijianSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要推荐的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要推荐选中的商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

//  $.post('/admin/user/delete', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
////        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}
User.prototype.deleteSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="pro_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要删除的商品');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要删除选中的商品吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

//  $.post('/admin/user/delete', data, function(response) {
//      if (response.result !== true) {
//          $.toaster({ priority : 'danger', title : '失败', message : response.message });
//          return false;
//      }
//
//      $.toaster({ priority : 'success', title : '成功', message : response.message });
////        window.location.reload();
//  }).complete(function(){
//      self.waiting = false;
//  }).error(function(){
//      $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
//  });
}
