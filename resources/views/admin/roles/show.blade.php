@extends('admin.public.common')
@section('title', 'Page Title')
@section('content')
<div class="header">
    <h1 class="page-title">更新管理员</h1>
</div>
<ul class="breadcrumb">
    <li><a href="/index">Home</a> <span class="divider">/</span></li>
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
            <form method="post" action="/admin/role/{{$role['id']}}">
            	{{ csrf_field() }}
            	{{method_field('PUT')}}
                <label>角色昵称</label>
                <input type="text" name="name"  value="{{$role['name']}}" class="input-xxlarge">
                 @if ($errors->has('name'))
                	<span class="help-block m-b-none" style='color:red;'><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                @endif
                <label>角色描述</label>
                 <textarea name="remark" class="form-control" rows="5" cols="20" data-msg-required="请输入角色描述">{{$role['remark']}}</textarea>
                <label>状态</label>
                @if($role['status']==1)
                <input type="radio" name="status"  value="1" checked >正常
                <input type="radio" name="status"  value="2" >禁用
                @else
                <input type="radio" name="status"  value="1"  >正常
                <input type="radio" name="status"  value="2" checked>禁用
                @endif
                <label class="col-sm-2 control-label">排序：</label>               
                <div class="input-group col-sm-2">
                   <input type="number" name="order"  value="{{$role['order']}}" class="input-xxlarge">
                </div>
                <label></label>
                <input class="btn btn-primary" type="submit" value="提交" />
            </form>
          </div>
      </div>
    </div>
</div>
@endsection