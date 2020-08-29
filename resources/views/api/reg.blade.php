<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="user_name"
                   placeholder="请输入用户名">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="firstpwd" name="email"
                   placeholder="请输入邮箱">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="firstpwd" name="user_pwd"
                   placeholder="请输入密码">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="firstpwd" name="user_pwdraw"
                   placeholder="请输入密码">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" id="but" class="btn btn-default">注册</button>
        </div>
    </div>
</form>
<script>
    $('#but').click(function () {
        var admin_name = $('input[name=admin_name]').val();
        var pwd = $('input[name=pwd]').val();


        $.post('http://vue.1912.com/api/register',{admin_name:admin_name,pwd:pwd},function (res) {
            if(res.code=='100001'){
                alert(res.msg);
            }
        },'json')

    })
</script>

</body>
</html>
