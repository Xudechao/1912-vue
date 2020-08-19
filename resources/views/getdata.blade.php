<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>AJAX文件</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
​
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="admin_name"
                   placeholder="请输入名称">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">文件</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="lastname" name="head">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">提交</button>
        </div>
    </div>
</form>

<script>
    //ajax实现接口上传文件
    $('button').click(function () {
        var admin_name = $('input[name="admin_name"]').val();
        $.get('http://vue.1912.com/api/geturlparam', {admin_name: admin_name}, function (res) {

        })
        $.get('http://vue.1912.com/api/getformpost', {admin_name: admin_name}, function (res) {

        })
        //接口上传文件
        var formData = new FormData();
        formData.append('admin_name', admin_name);
        formData.append('head', $('input[name="head"]')[0].files[0]);
        $.ajax({
            url: 'http://vue.1912.com/api/upload',
            type: 'POST',
            data: formData,
            processData: false, // 使数据不做处理
            contentType: false, // 不要设置Content-Type请求头
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    alert('上传成功！');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });

        var data = {admin_name:admin_name};
        data=JSON.stringify(data);

        //json请求头
        $.ajax({
            url: 'http://vue.1912.com/api/getjson',
            type: 'POST',
            data: data,
            contentType:"application/json;charset=utf-8",
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    alert('上传成功！');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    })

</script>
​
</body>
</html>
