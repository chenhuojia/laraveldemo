@extends('admin.public.common')
@section('title', 'Page Title')
@section('content')
<div class="header">
   <h1 class="page-title">角色列表</h1>
</div>
<ul class="breadcrumb">
    <li><a href="/admin/index">Home</a> <span class="divider">/</span></li>
    <li class="active">List</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="btn-toolbar">
            <button class="btn btn-primary" onClick="location='/admin/role/create'"><i class="icon-plus"></i>添加角色</button>
          <div class="btn-group">
          </div>
        </div>
        <div class="well">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>角色名称</th>
                  <th>角色描述</th>
                  <th>排序</th>
                  <th>状态</th>
                  <th style="width: 26px;">操作</th>
                </tr>
              </thead>
              <tbody>
              @foreach($roles as $k=>$item)
                <tr>
                  <td>{{$item['id']}}</td>
                  <td>
                  	{{$item['name']}}
                  </td>
                  <td>{{$item['remark']}}</td>
                  <td>{{$item['order']}}</td>
                  <td>
                    @if($item->status == 1)
                        <span class="text-navy">正常</span>
                    @elseif($item->status == 2)
                        <span class="text-danger">锁定</span>
                    @endif
                  </td>
                  <td width="20%">
                      <a href="/admin/role/access/{{$item['id']}}"><i class="icon-tasks"></i> 权限设置</a>
                      <a href="/admin/role/{{$item['id']}}/edit"><i class="icon-pencil"></i></a>
                      <a href="#myModal" role="button" data-toggle="modal" data-id="{{$item['id']}}" class="deleteButtou"><i class="icon-remove"></i></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
        </div>
        <div class="pagination">
         
        </div>
        <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete Confirmation</h3>
            </div>
            <div class="modal-body">
                <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button class="btn btn-danger" id='btn-delete-obj' data-dismiss="modal" data-obj="" data-obj-id="" onclick="deleteObj(this)">Delete</button>
            </div>
        </div>
        <footer>
            <hr>
            <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
            <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            

            <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
        </footer>   
    </div>
</div>
<script>
	var deleteTr,deleteTrId;
	$('.deleteButtou').click(function(){
		var id=$(this).attr('data-id'),
			parentTr=$(this).parent().parent();
		deleteTr=parentTr;
		deleteTrId=id;
	})
	
	function deleteObj(obj){
		if(deleteTr && deleteTrId){
			$.ajax({
				url:'/admin/role/'+deleteTrId,
				type:'delete',
				dataType:'json',
				headers: {
			        'token': 1223
			    },
				success:function(e){
					$(deleteTr).remove();
					return true;	
				},
				error:function(obj,e,data){
					var objs = eval('(' + obj.responseText+ ')');
					alert(objs.msg);
					return false;	
				}
			})
			
		}
		
		/* if(deleteTr && deleteTrId){
			$(deleteTr).remove();	
		} */
		//console.log(deleteTr,deleteTrId);
	}
</script>
@endsection