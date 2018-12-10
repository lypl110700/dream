@extends('layout/header')
@section('content')
@endsection
  <body>
    <div class="x-body">
        <form action="{{url('roleAdd')}}" method="post" class="layui-form layui-form-pane">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="role_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>  
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="submit" lay-filter="add">增加</button>
              </div>
            </form>
    </div>
  </body>

</html>