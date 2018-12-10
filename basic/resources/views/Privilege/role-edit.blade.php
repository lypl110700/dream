@extends('layout/header')
@section('content')
@endsection
  <body>
    <div class="x-body">
        <form action="{{url('roleEdit')}}" method="post" class="layui-form layui-form-pane">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$id['id']}}">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="role_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="{{$info->role_name}}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="layui-input-block">
                                        <!-- $auth--所有的权限信息 -->
                                        <!-- $rule--用户拥有的权限 -->
                                        @foreach($auth as $k => $v)
    <input name="auth_id[]" lay-skin="primary" type="checkbox" value="{{$v->auth_id}}" title="{{$v->auth_name}}" >
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="submit" lay-filter="add">修改</button>
              </div>
            </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
            return false;
          });
          
          
        });
    </script>

  </body>

</html>