<ul id="dashboard-menu" class="nav nav-list collapse in">
     <li class="">
     	<a class="home" href="javasctipt:" status=0>首页</a>
     	 <ul class="itemslist" style="display: none">
     	 	<li><a class="" href="/index">首页</a></li>
     	</ul>
     </li> 
    <li class="">
     	<a class="home" href="javasctipt:" status=0>后台授权</a>
     	 <ul class="itemslist" style="display: none">
         	<li><a href="/admin/admins">管理員列表</a></li>
         	<li><a href="/admin/role">角色列表</a></li>
         	<li><a href="/admin/rule">权限列表</a></li>
     	</ul>
     </li>     
</ul>    

<script>
	$('.home').click(function(){
		if (Number($(this).attr('status')) === 0 ){
				$(this).parent().siblings().find('ul').slideUp(100);		
				$(this).next('ul').slideDown(100);
				$(this).parent().addClass('active');	
				$(this).parent().siblings().removeClass('active');
				$(this).attr('status',1)
			}else {
				$(this).next('ul').slideUp(100);
				$(this).attr('status',0)
			}
		})
</script>