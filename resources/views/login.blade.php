<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">账户</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="admin_name"
                   placeholder="请输入账户">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="firstpwd" name="admin_pwd"
                   placeholder="请输入密码">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">登录</button>
        </div>
    </div>
</form>
<script>
    $('button').click(function () {
        var admin_name = $('input[name="admin_name"]').val();
        var admin_pwd = $('input[name="admin_pwd"]').val();
        $.post('http://1912.api.com/api/login',{admin_name:admin_name,admin_pwd:admin_pwd},
        function (res) {
            if(res.error_no=='00000'){
                alert(res.error_msg);
            }
        },'json')
    })
</script>
​
</body>
</html>
