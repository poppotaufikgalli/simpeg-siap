<<!DOCTYPE html>
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
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
					<table style="width: 100%" border="1">
						<thead>
							<tr>
								<th>NO</th>
								<th width="15%">NAMA<br>TEMPAT TANGGAL LAHIR</th>
								<th>PANGKAT/GOL<br>TMT</th>
								<th>NIP</th>
								<th>SATKER</th>
								<th>JENIS KELAMIN</th>
								<th width="15%">JABATAN<br>TMT<br>DASAR</th>
								<th>STATUS</th>
								<th>AGAMA</th>
								<th>STATUS<br>RUMAH</th>
								<th width="30%">ALAMAT RUMAH</th>
							</tr>
						</thead>
						<tbody>
							@if($list)
								@foreach($list as $key=> $value)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{$value->namapeg}}<br>{{$value->ktlahir}}, {{$value->tlahir != '' ? date("d-m-Y", strtotime($value->tlahir)) : ''}}</td>
										<td align="center">
											{{$value->golongan_ruang}} ({{$value->nama_pangkat}})
											<br>{{$value->tmtpang != '' ? date("d-m-Y", strtotime($value->tmtpang)) : ''}}
											<br>{{$value->singkatan_korps}}
										</td>
										<td align="center">{{$value->nip}}</td>
										<td align="center">{{$value->nama_opd}}</td>
										<td align="center">{{$value->kjkel == 1 ? "Laki-Laki" : "Perempuan"}}</td>
										<td>
											{{$value->njab}}
											<br>{{$value->tmtjab != '' ? date("d-m-Y", strtotime($value->tmtjab)) : ''}}
											<br>{{$value->nskjabat}} - {{$value->tskjabat}}
										</td>
										<td align="center">{{$value->nkawin}}</td>
										<td align="center">{{$value->nagama}}</td>
										<td align="center">{{$value->stts_rumah}}</td>
										<td>
											{{$value->aljalan}}
											{{$value->aldes}}
											{{$value->alkec}}
											{{$value->alkab}}
											{{$value->alprop}}
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>