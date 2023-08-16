@include('layouts.admin.header')
@yield('content')
@yield('js-content')
@include('layouts.admin.footer')
<script>
	window.onload = (event)=> {
	 	var errors = {!!$errors!!};
	 	var lserror = Object.values(errors);
	 	//console.log(e)
	 	const notyf = new Notyf();
	 	if(lserror.length > 0){
	 		for (var i = lserror.length - 1; i >= 0; i--) {
	 			notyf.error(lserror[i][0])
	 		}
	 	}
	}
</script>