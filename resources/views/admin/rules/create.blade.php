@extends('admin.public.common')
@section('title', 'Page Title')
@section('content')
<div class="header">
    <h1 class="page-title">添加权限</h1>
</div>
<ul class="breadcrumb">
    <li><a href="/admin/index">Home</a> <span class="divider">/</span></li>
    <li class="active">添加权限</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">                
		<div class="btn-toolbar">
    		<button class="btn btn-primary" onClick="location='/admin/rule'"><i class="icon-list"></i>权限列表</button>
      		<div class="btn-group">
      		</div>
		</div>
    <div class="well">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form method="post" action="/admin/rule">
            	{{ csrf_field() }}
                <label>权限昵称</label>
                <input type="text" name="name"  value="" class="input-xxlarge">
                @if ($errors->has('name'))
                	<span class="help-block m-b-none" style='color:red;'><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                @endif
                <label>上级权限</label>
                <div class="input-group col-sm-2">
                   <select name="parent_id">
                   <option value="0">顶级权限</option>
                   	@foreach($rules as $k=>$v)
                   		<option value="{{$v['id']}}">{{$v['_name']}}</option>
                   	@endforeach
                   </select>
                </div> 
                <label>权限路径</label>
                <input type="text" name="route"  value="" class="input-xxlarge">
                @if ($errors->has('route'))
                	<span class="help-block m-b-none" style='color:red;'><i class="fa fa-info-circle"></i>{{$errors->first('route')}}</span>
                @endif             
                <label>状态</label>
                <input type="radio" name="status"  value="1" checked >启用
                <input type="radio" name="status"  value="2" >禁用
                <label>是否隐藏</label>
                <input type="radio" name="is_hidden"  value="1" checked >启用
                <input type="radio" name="is_hidden"  value="2" >禁用
                <label class="col-sm-2 control-label">排序：</label>               
                <div class="input-group col-sm-2">
                   <input type="number" name="sort"  value="0" class="input-xxlarge">
                </div>
                <label></label>
                <input class="btn btn-primary" type="submit" value="提交" />
            </form>
          </div>
      </div>
    </div>
</div>
@endsection