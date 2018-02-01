@extends('admin.public.common')
@section('title', 'Page Title')
@section('content')
<div class="header">
    <h1 class="page-title">添加权限</h1>
</div>
<ul class="breadcrumb">
 	<li><a href="/admin/index">Home</a> <span class="divider">/</span></li>
    <li class="active">添加角色</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">                
		<div class="btn-toolbar">
    		<button class="btn btn-primary" onClick="location='/admin/role'"><i class="icon-list"></i>角色列表</button>
      		<div class="btn-group">
      		</div>
		</div>
    <div class="well">
        <div class="col-sm-12">
        <div class="ibox-title">
            <h5>{{$role->name}} - 授权</h5>
        </div>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form class="form-horizontal m-t-md" action="/admin/role/group-access/{{$role->id}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        @foreach($datas as $k=>$item)
                            @if(empty($item->_data))
                                <tr class="b-group">
                                    <th width="10%">
                                        <label>
                                            &nbsp;&nbsp;{{$item->name}}&nbsp;
                                            <input type="checkbox" name="rule_id[]" value="{{$item->id}}" onclick="checkAll(this)" @if(in_array($item->id,$rules)) checked="checked" @endif>
                                        </label>
                                    </th>
                                    <td></td>
                                </tr>
                            @else
                                <tr class="b-group">
                                    <th width="10%">
                                        <label>
                                            &nbsp;&nbsp;{{$item->name}}&nbsp;<input type="checkbox" name="rule_id[]" value="{{$item->id}}" @if(in_array($item->id,$rules)) checked="checked" @endif onclick="checkAll(this)">
                                        </label>
                                    </th>
                                    <td class="b-child">
                                        @foreach($item->_data as $key=>$value)
                                            <table class="table table-striped table-bordered table-hover table-condensed">
                                                <tr class="b-group">
                                                    <th width="10%">
                                                        <label>
                                                            {{$value->name}}&nbsp;<input type="checkbox" name="rule_id[]" value="{{$value->id}}" @if(in_array($value->id,$rules)) checked="checked" @endif onclick="checkAll(this)">
                                                        </label>
                                                    </th>
                                                    <td>
                                                        @if(!empty($value->_data))
                                                            @foreach($value->_data as $val)
                                                                <label>
                                                                    &emsp;{{$val->name}} <input type="checkbox" name="rule_id[]" value="{{$val->id}}" @if(in_array($val->id,$rules)) checked="checked" @endif>
                                                                </label>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th></th>
                            <td>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保存</button>
                                <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
          </div>
      </div>
    </div>
</div>
@endsection