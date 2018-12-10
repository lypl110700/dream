@extends('layout/header')
@section('content')
@endsection  
  <body>
    <div class="x-body">
        <form action="{{url('setRule')}}" method="post" class="layui-form layui-form-pane">
               {{csrf_field()}}
               <input type="hidden" name="id" value="{{$rid['id']}}">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        设置权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="layui-input-block">
                                        @foreach($rule as $k => $v)
    <input name="auth_id[]" lay-skin="primary" type="checkbox" value="{{$v->auth_id}}" title="{{$v->auth_name}}">
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="submit" lay-filter="add">增加</button>
              </div>
            </form>
    </div>
  </body>
</html>