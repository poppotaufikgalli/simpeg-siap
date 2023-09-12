<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Nominatif</title>
	<style type="text/css">
		@page {
	        size: A4 landscape;
	    }
		body {
    		font-size: 10pt; 
		}
		
		table {
		  	border-collapse: collapse;
		  	page-break-inside: avoid;
		  	padding-bottom: 10px;
		}
		td{
			vertical-align:top;
		}
		th, td{
			padding-left: 5px;
			padding-right: 5px;
		}
		th {
			background-color: lightgray;
		}
		div{
			padding-left: 5px;
			padding-right: 5px;
		}

	</style>
</head>
<body>
	<div>
		<table style="width:100%">
			<tr>
				<td>
					<h1 style="text-align: center">DAFTAR NOMINATIF PERSONEL {{$id_jenis_personel == 2 ? 'MILITER' : 'PNS'}} DI LINGKUNGAN KOARMADA 1</h1>
				</td>
				<td width="10%">
					<img src="{{ public_path('assets/img/Lambang_Satuan_Koarmada_I.png') }}" alt="app_logo" height="100">
				</td>		
			</tr>
		</table>
		
		<div style="display: table ; width: 100%;">
			<div style="display: table-row">
				<div style="width: 5%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					NO
				</div>
				<div style="width: 15%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					NAMA<br>TEMPAT TANGGAL LAHIR
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					PANGKAT/GOL<br>TMT
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					NIP
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					SATKER
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					JENIS KELAMIN
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					JABATAN<br>TMT<br>DASAR
				</div>
				<div style="width: 7%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					STATUS
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					AGAMA
				</div>
				<div style="width: 10%; border: 1px solid black; display: table-cell; text-align: center; vertical-align: middle; background-color: lightgray;">
					STATUS RUMAH
				</div>
			</div>
			@if($list)
				@foreach($list as $key=> $value)
				<div style="display: table-row">
					<div style="width: 5%; border: 1px solid black; display: table-cell; text-align: center;">
						{{$key+1}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->namapeg}}<br>{{$value->ktlahir}}, {{$value->tlahir != '' ? date("d-m-Y", strtotime($value->tlahir)) : ''}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->golongan_ruang}} ({{$value->nama_pangkat}})
						<br>{{$value->tmtpang != '' ? date("d-m-Y", strtotime($value->tmtpang)) : ''}}
						<br>{{$value->singkatan_korps}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->nip}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->nama_opd}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->kjkel == 1 ? "Laki-Laki" : "Perempuan"}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->njab}}
						<br>{{$value->tmtjab != '' ? date("d-m-Y", strtotime($value->tmtjab)) : ''}}
						<br>{{$value->nskjabat}} - {{$value->tskjabat}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->nkawin}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->nagama}}
					</div>
					<div style="border: 1px solid black; display: table-cell;">
						{{$value->stts_rumah}}
					</div>
				</div>
				@endforeach
			@endif
		</div>
	</div>
</body>
</html>