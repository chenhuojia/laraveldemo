<ul id="dashboard-menu" class="nav nav-list collapse in">
	@php
    	$menus = session('admin_menu'); 
	@endphp
	@foreach($menus as $k=>$v)
    	@php
    		dd(route($v['route']));
    	@endphp
    	
    	
    @endforeach     
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