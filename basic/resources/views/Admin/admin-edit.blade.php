@extends('layout/header')
@section('content')
@endsection
  
  <body>
    <div class="x-body">
        <form  method="post" action="{{url('adminEdit')}}">
          {{csrf_field()}}
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>登录名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="username" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="@if(isset($info)) {{$info->back_user}} @endif">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div>
          </div>
     
         
              <label  class="layui-form-label">
                  <span class="x-red">*</span>请选择角色
              </label>
              
                @foreach($role['dataList'] as $k => $v)
                  <input type="checkbox"  name="role_name[]"  value="{{$v->rid}}" @if($info->rid==$v->rid) checked @endif>{{$v->role_name}}
                 @endforeach 
              
              
       
       <input type="hidden" name="id" value="@if(isset($info)) {{$info->id}} @endif">
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="password" required lay-verify="pass"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  5到16个字符
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>确认密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass" required lay-verify="repass"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
         
              <input type="submit" class="layui-btn" lay-filter="add" value="修改">
         
      </form>
    </div>
  </body>

</html>