<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DRH</title>
	<style type="text/css">
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
		<p style="text-align: right;">
			<img src="{{ public_path('assets/img/Lambang_Satuan_Koarmada_I.png') }}" alt="app_logo" height="100">
		</p>
		<h1 style="text-align: center">DAFTAR RIWAYAT HIDUP</h1>
		
		<table style="width: 100%">
			<tr>
				<td>
					<h3>1. Profil {{$id_jenis_personel == 2 ? 'Militer' : 'PNS'}}</h3>
				</td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="0" style="width: 100%">
						<tr style="border-bottom: 1px solid">
							<td width="5%">a.</td>
							<td width="20%">Nama</td>
							<td width="5%">:</td>
							<td width="70%">{{$profil['namapeg'] ?? ''}}</td>
							<td rowspan="7">&nbsp;</td>
							<td rowspan="7" style="border: 1px solid;">
								@if($profil['file_bmp'] != "")
									<img src="{{ public_path('storage/photo/'.$profil['file_bmp']) }}" alt="app_logo" height="100">
								@endif
							</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>b.</td>
							<td>Pangkat/Gol Ruang</td>
							<td>:</td>
							<td>{{$profil['golongan_ruang'] ?? ''}}-{{$profil['nama_pangkat'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>c.</td>
							<td>NRP/NIP</td>
							<td>:</td>
							<td>{{$profil['nip'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>d.</td>
							<td>Jabatan</td>
							<td>:</td>
							<td>{{$profil['njab'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>e.</td>
							<td>Satker</td>
							<td>:</td>
							<td>{{$profil['nama_opd'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>f.</td>
							<td>Tempat, Tanggal Lahir</td>
							<td>:</td>
							<td>{{$profil['ktlahir'] ?? ''}}, {{$profil['tlahir'] != '' ? date("d-m-Y", strtotime($profil['tlahir'])) : ''}}</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;">g.</td>
							<td style="border-bottom: 1px solid;">Agama</td>
							<td style="border-bottom: 1px solid;">:</td>
							<td style="border-bottom: 1px solid;">{{$profil['nagama'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>h.</td>
							<td>Alamat</td>
							<td>:</td>
							<td colspan="3">
								<table border="0" style="width: 100%">
									<tr style="border-bottom: 1px solid;">
										<td width="30%">Jalan</td><td width="5%">:</td><td>{{$profil['aljalan'] ?? ''}}</td>
									</tr>
									<tr style="border-bottom: 1px solid;">
										<td>Desa/Kelurahan</td><td>:</td><td>{{$profil['aldes'] ?? ''}}</td>
									</tr>
									<tr style="border-bottom: 1px solid;">
										<td>Kecamatan</td><td>:</td><td>{{$profil['alkec'] ?? ''}}</td>
									</tr>
									<tr style="border-bottom: 1px solid;">
										<td>Kabupaten/Kota</td><td>:</td><td>{{$profil['alkab'] ?? ''}}</td>
									</tr>
									<tr>
										<td>Provinsi</td><td>:</td><td>{{$profil['alprop'] ?? ''}}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>i.</td>
							<td>No. Telepon/HP</td>
							<td>:</td>
							<td colspan="3">{{$profil['altelp'] ?? ''}}</td>
						</tr>
						<tr style="border-bottom: 1px solid;">
							<td>j.</td>
							<td>Email</td>
							<td>:</td>
							<td colspan="3">{{$profil['email'] ?? ''}}</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		<table style="width: 100%">
			<tr>
				<td><h3>2. Pangkat Golongan Ruang {{$id_jenis_personel == 2 ? 'Militer' : 'PNS'}}</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						@if(isset($pangkat))
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Pangkat/Gol</th>
								<th width="20%">TMT</th>
								<th width="20%">No. SK</th>
								<th width="20%">Tgl. SK</th>
								<th width="15%">Jenis KP</th>
							</tr>
							@foreach($pangkat as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->npangkat}} - {{$value->golru}}</td>
									<td align="center">{{$value->tmtpang != "" ? date('d-m-Y',strtotime($value->tmtpang)) : ''}}</td>
									<td align="center">{{$value->nskpang}}</td>
									<td align="center">{{$value->tskpang != "" ? date('d-m-Y',strtotime($value->tskpang)) : ''}}</td>
									<td align="center">{{$value->nama_jenis_kp}}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						@endif
					</table>
				</td>
			</tr>
		</table>

		<table style="width: 100%">
			<tr>
				<td><h3>3. Riwayat Pendidikan Umum</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						@if(isset($pendum))
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Tingkat Pend.</th>
								<th width="20%">Jurusan</th>
								<th width="20%">Nama Sekolah</th>
								<th width="20%">Tempat</th>
								<th width="15%">Tahun</th>
							</tr>
							@foreach($pendum as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->ntpu}}</td>
									<td>{{$value->njur}}</td>
									<td>{{$value->nsek}}</td>
									<td align="center">{{$value->tempat}}</td>
									<td align="center">{{$value->tsttb != "" ? date('Y',strtotime($value->tsttb)) : ''}}</td>
								</tr>
							@endforeach
						@endif
					</table>
				</td>
			</tr>
		</table>

		<table style="width: 100%">
			<tr>
				<td><h3>4. Riwayat Penempatan Jabatan</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						@if(isset($jabatan))
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Nama Jabatan</th>
								<th width="20%">Satker</th>
								<th width="20%">TMT</th>
								<th width="20%">No SK</th>
								<th width="15%">Eselon</th>
							</tr>
							@foreach($jabatan as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->njab}}</td>
									<td>{{$value->nopd}}</td>
									<td align="center">{{$value->tmtjab != "" ? date('d-m-Y',strtotime($value->tmtjab)) : ''}}</td>
									<td>{{$value->nskjabat}}</td>
									<td align="verifikasiModal">{{$value->neselon}}</td>
								</tr>
							@endforeach
						@endif
					</table>		
				</td>
			</tr>
		</table>
		<table style="width: 100%">
			<tr>
				<td><h3>5. Riwayat Pendidikan Kepemimpinan</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						@if(isset($diklat))
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Nama Diklat</th>
								<th>Angkatan</th>
								<th width="20%">Tempat</th>
								<th width="20%">Panitia</th>
								<th width="20%">Waktu Pelaksanaan</th>
							</tr>
							@foreach($diklat as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value['ndiklat']}}</td>
									<td align="center">{{$value['angkatan']}}</td>
									<td align="center">{{$value['tempat']}}</td>
									<td>{{$value['pan']}}</td>
									<td align="center">
										{{$value['tmulai'] != "" ? date('d-m-Y',strtotime($value['tmulai'])) : ''}}<br>
										{{$value['takhir'] != "" ? date('d-m-Y',strtotime($value['takhir'])) : ''}}
									</td>
								</tr>
							@endforeach
						@endif
					</table>
				</td>
			</tr>
		</table>

		<table style="width: 100%">
			<tr>
				<td><h3>6. Riwayat Pendidikan/Kursus</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						@if(isset($diklat_a))
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Nama Diklat</th>
								<th>Jenis</th>
								<th width="20%">Tempat</th>
								<th width="20%">Panitia</th>
								<th width="20%">Waktu Pelaksanaan</th>
							</tr>
							@foreach($diklat_a as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->ndiklat}}</td>
									<td>{{$value->njdiklat}}</td>
									<td align="center">{{$value->tempat}}</td>
									<td>{{$value->pan}}</td>
									<td align="center">
										{{$value->tmulai != "" ? date('d-m-Y',strtotime($value->tmulai)) : ''}}<br>
										{{$value->takhir != "" ? date('d-m-Y',strtotime($value->takhir)) : ''}}
									</td>
								</tr>
							@endforeach
						@endif
					</table>
				</td>
			</tr>
		</table>
		
		<table style="width: 100%">
			<tr>
				<td><h3>7. Riwayat Keluarga</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						<tr>
							<th width="5%">No.</th>
							<th width="30%">Hubungan</th>
							<th width="35%">Nama</th>
							<th width="30%">TTL</th>
						</tr>
						@if(isset($keluarga))
							@foreach($keluarga as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->njenis}}</td>
									<td>{{$value->nama_kel}}</td>
									<td>{{$value->ktlahir ?? ''}}, {{$value->tlahir != '' ? date("d-m-Y", strtotime($value->tlahir)) : ''}}</td>
								</tr>
							@endforeach
						@else
						<tr>
							<td>&nbsp;</th>
							<td>&nbsp;</th>
							<td>&nbsp;</th>
							<td>&nbsp;</th>
						</tr>
						@endif
					</table>
				</td>
			</tr>
		</table>
		
		<table style="width: 100%">
			<tr>
				<td><h3>8. Riwayat SKP</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						<tr>
							<th width="5%">No.</th>
							<th width="20%">Tahun</th>
							<th width="20%">Priode Penilaian</th>
							<th>Total Nilai</th>
							<th>Capaian Kinerja Organisasi</th>
							<th>Prediket Kinerja Pegawai</th>
						</tr>
						@if(isset($dp3))
							@foreach($dp3 as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td align="center">{{$value['thnilai']}}</td>
									<td align="center">
										{{$value['mulai'] != "" ? date('d-m-Y',strtotime($value['mulai'])) : ''}}<br>
										{{$value['selesai'] != "" ? date('d-m-Y',strtotime($value['selesai'])) : ''}}
									</td>
									<td align="center">{{$value['ntotal']}}</td>
									<td align="center">{{$value['capaian_kinerja_org']}}</td>
									<td align="center">{{$value['prediket_kinerja_peg']}}</td>
								</tr>
							@endforeach
						@else
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						@endif
					</table>
				</td>
			</tr>
		</table>
		
		<table style="width: 100%">
			<tr>
				<td><h3>9. Riwayat Penghargaan/Tanda Jasa</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						<tr>
							<th width="5%">No.</th>
							<th width="20%">Nama Penghargaan</th>
							<th width="20%">Jenis Penghargaan</th>
							<th width="20%">Asal Perolehan</th>
							<th width="20%">No. SK</th>
							<th>Tgl. SK</th>
						</tr>
						@if(isset($pengargaan))
							@foreach($pengargaan as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->nbintang}}</td>
									<td>{{$value->njenis_penghargaan}}</td>
									<td>{{$value->aoleh}}</td>
									<td>{{$value->nsk}}</td>
									<td>{{$value->tsk}}</td>
								</tr>
							@endforeach
						@else
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						@endif
					</table>
				</td>
			</tr>
		</table>
		
		<table style="width: 100%">
			<tr>
				<td><h3>10. Riwayat Pencantuman Gelar</h3></td>
			</tr>
			<tr>
				<td style="padding-left: 30px;">
					<table border="1" style="width: 100%">
						<tr>
							<th width="5%">No.</th>
							<th width="20%">Tahun</th>
							<th width="35%">Pejabat Penetap</th>
							<th width="30%">Tk Pend/Jurusan</th>
						</tr>
						@if(isset($tumlar))
							@foreach($tumlar as $key => $value)
								<tr>
									<td>{{$key+1}}.</td>
									<td>{{$value->tsk != "" ? date('Y',strtotime($value->tsk)) : ''}}</td>
									<td>{{$value->npej}}</td>
									<td>{{$value->ntpu}} - {{$value->njur}}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						@endif
					</table>
				</td>
			</tr>
		</table>	
	</div>
</body>
</html>