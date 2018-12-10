@extends('layout/header')
@section('content')
@endsection
  <body>
    <div class="x-body">
        <form action="@if(isset($info)) {{url('ruleEdit')}} @else {{url('ruleAdd')}} @endif" method="post" class="layui-form layui-form-pane">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>权限名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="auth_name" required lay-verify="required"
                        autocomplete="off" class="layui-input" value="@if(isset($info)) {{$info->auth_name}} @endif">
                    </div>
                </div>
                <!--隐藏域存放要修改权限的id-->
                <input type="hidden" name="id" value="@if(isset($info)) {{$info->auth_id}} @endif">
             <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>权限规则
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="auth_rule" required lay-verify="required"
                        autocomplete="off" class="layui-input" value="@if(isset($info)) {{$info->auth_rule}} @endif">
                    </div>
                </div>

                <div class="layui-form-item">
                    <button class="layui-btn" lay-submit="submit" lay-filter="add">
                        @if(isset($info))
                            修改
                        @else
                            增加
                        @endif

                    </button>
                </div>
            </form>
    </div>
  </body>
</html>