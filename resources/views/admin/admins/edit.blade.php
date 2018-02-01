@extends('admin.public.common')
@section('title', 'Page Title')
@section('content')
<div class="header">
    <h1 class="page-title">更新管理员</h1>
</div>
<ul class="breadcrumb">
    <li><a href="/admin/index">Home</a> <span class="divider">/</span></li>
    <li class="active">更新管理员</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">                
		<div class="btn-toolbar">
    		<button class="btn btn-primary" onClick="location='/admin/admins'"><i class="icon-list"></i>管理员列表</button>
      		<div class="btn-group">
      		</div>
		</div>
    <div class="well">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form method="post" action="/admin/admins/{{$admin['id']}}">
            	{{ csrf_field() }}
            	{{method_field('PUT')}}
                <label>用户名</label>
                <input type="text" name="username"  value="{{$admin['name']}}" class="input-xxlarge">
                <label>密码</label>
                <input type="password" name="password"  value="" class="input-xxlarge">
                <label>状态</label>
                @if($admin['status']==1)
                <input type="radio" name="status"  value="1" checked >正常
                <input type="radio" name="status"  value="2" >禁用
                @else
                <input type="radio" name="status"  value="1"  >正常
                <input type="radio" name="status"  value="2" checked>禁用
                @endif
                <label class="col-sm-2 control-label">所属角色：</label>
                <div class="input-group col-sm-2">
                    @foreach($roles as $k=>$item)
                        <input type="checkbox" name="role_id[]" value="{{$item['id']}}"  @if(in_array($item->id,$rolesID)) checked="checked" @endif > {{$item['name']}}
                    @endforeach
                </div>
                <label></label>
                <input class="btn btn-primary" type="submit" value="提交" />
            </form>
          </div>
      </div>
    </div>
</div>
@endsection