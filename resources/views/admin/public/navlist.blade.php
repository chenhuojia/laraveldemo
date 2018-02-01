<ul id="dashboard-menu" class="nav nav-list collapse in">
	@php
    	$menus = session('admin_menu'); 
	@endphp
	@foreach($menus as $k=>$v)
    	@if($v['route']=='admin.index')
         <li class="">
         	<a class="home" href="javasctipt:" status=0>{{$v['name']}}</a>
         	 <ul class="itemslist" style="display: none">
         	 	<li><a class="" href="{{route($v['route'])}}">{{$v['name']}}</a></li>
         	</ul>
         </li>
       	@else
        <li class="">
         	<a class="home" href="javasctipt:" status=0>{{$v['name']}}</a>
         	 <ul class="itemslist" style="display: none">
         	 	@if(isset($v['children']))
         	 		@foreach($v['children'] as $kk=>$vv)
         	 			<li><a href="{{route($vv['route'])}}">{{$vv['name']}}</a></li>
         	 		@endforeach
         	 	@else
         	 		<li><a class="" href="{{$v['route']?route($v['route']):''}}">{{$v['name']}}</a></li>
         	 	@endif
         	</ul>         	
         </li>
        @endif
    	
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