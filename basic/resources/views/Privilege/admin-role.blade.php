@extends('layout/header')
@section('content')
@endsection
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{url('index')}}">首页</a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
         <a class="layui-btn" href="{{url('roleAdd')}}" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>增加</a>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <h1  style="display:@if(Session::has('msg')) block @else block @endif" >{{Session::get('msg')}}</h1>
        <span class="x-right" style="line-height:40px">共有数据：{{$info['count']}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>角色名称</th>
            <th>创建时间</th>
            <th style="display: @if(Session::get('userinfo')['is_super']==1) block @else none @endif ">操作</th>
        </thead>
        <tbody>
          @foreach($info['dataList'] as $k => $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->rid}}</td>
            <td>{{$v->role_name}}</td>
            <td>{{$v->create_time}}</td>
            <td class="td-manage">
              <a title="编辑"  href="/roleEdit?id={{$v->rid}}">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除"  href="/roleDel?id={{$v->rid}}">
                <i class="layui-icon">&#xe640;</i>
              </a>
               <a title="设置权限"  href="/setRule?id={{$v->rid}}">
                <i class="layui-icon">&#xe608;</i>
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

</html>