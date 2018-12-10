@extends('layout/header')
@section('content')
@endsection  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{url('index')}}">首页</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      

      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a class="layui-btn" href='{{url("adminAdd")}}' )"><i class="layui-icon"></i>添加</a> 
        
        <h3>@if(Session::has('msg')){{Session::get('msg')}}@endif</h3>
        <span class="x-right" style="line-height:40px">共有数据：{{$info['count']}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <input type="checkbox"  id="selAll" lay-skin="primary">
            </th>
            <th>ID</th>
            <th>登录名</th>
            <th>角色</th>
            <th>加入时间</th>
            <th>状态</th>
            <th style="display:@if(Session::get('userinfo')['is_super']==1 ) block @else none @endif">操作</th>
        </thead>
        <tbody>
        @foreach($info['dataList'] as $k => $v)
          <tr>
            <td>
              <input type="checkbox" lay-skin="primary"  value="{{$v->id}}" name='ids'>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->back_user}}</td>
            <td>{{$v->role_name}}</td>
            <td>{{$v->back_insert_time}}</td>
            <td class="td-status">
              <span class="layui-btn layui-btn-normal layui-btn-mini">@if($v->back_start_status==1)启用@else禁用@endif</span></td>
            <td class="td-manage">
              <a title="编辑" href="/adminEdit?id={{$v->id}}" >
                <i class="layui-icon">&#xe642;</i>
              </a>
<a title="删除"  href="/adminDel?id={{$v->id}}" style="display:@if($v->role_name=='超级管理员') none @else block @endif">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$info['dataList']->render()}}
        </div>
      </div>

    </div>

  </body>
  <script src="/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">

  $('#selAll').click(function(){
    //全选全不选
      if($(this).is(":checked")){
        $("input[name='ids']").prop("checked",true);
      }else{
        $("input[name='ids']").prop("checked",false);
      }
      //获取id
      /*var str='';
      $("input[name='ids']").each(function(){
          if($(this).is(":checked")){
            str += $(this).val()+','
          }
      })*/
  })
</script>
</html>