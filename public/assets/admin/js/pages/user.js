var User = function()
{
    this.waiting = false;
}

User.prototype.deleteSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="user_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要删除的用户');
        return;
    }
    //console.log(selected);return;

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要删除选中的用户吗？')) {
        return;
    }

    if (self.waiting === true) {
        alert('请稍候...有其他操作正在执行');
    }
    self.waiting = true;

    $.post('/admin/user/delete', data, function(response) {
        if (response.result !== true) {
            console.log(response.message);
            $.toaster({ priority : 'danger', title : '失败', message : response.message });
            return false;
        }

        $.toaster({ priority : 'success', title : '成功', message : response.message });
//        window.location.reload();
    }).complete(function(){
        self.waiting = false;
    }).error(function(){
        $.toaster({ priority : 'danger', title : '失败', message : '网络错误' });
    });
}

User.prototype.startSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="user_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要启用的用户');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要启用选中的用户吗？')) {
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
User.prototype.endSelected = function()
{
    var self = this;

    var selected = [];
    $('input:checked[name="user_id[]"]').each(function() {
        selected.push($(this).val());
    });

    if (selected.length < 1) {
        alert('您没有选中要禁用的用户');
        return;
    }

    var data = {
        user_id: selected,
        _token  : $('#csrfToken').val()
    };

    if (!confirm('您确定要禁用选中的用户吗？')) {
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
