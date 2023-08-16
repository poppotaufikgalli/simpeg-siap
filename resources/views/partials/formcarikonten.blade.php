<form class="d-flex flex-column gap-2" method="post" action="{{route('carikonten', $jns)}}" style="max-width: 30vw;">
	@csrf
	<h4 class="h-title">CARI {{strtoupper($hal)}}</h4>
	<input class="form-control rounded-0" name="sjns" type="hidden" placeholder="" value="{{isset($jns) ? $jns : ''}}" />
	<input class="form-control rounded-0" name="sjudul" type="search" placeholder="Cari Judul" value="{{isset($sjudul) ? $sjudul : ''}}" />
	<button class="w-100 btn btn-primary rounded-0" type="submit">
		<i class="bi bi-search"></i>
		Cari
	</button>
</form>	