		@php($title = $meta['title'] ?? "Jaringan Dokumentasi Dan Informasi Hukum ( JDIH ) Kota Tanjungpinang adalah website resmi Pemerintah Kota Tanjungpinang yang berisikan Peraturan Perundang Undangan mulai Dari Pusat hingga daerah")
		@php($description = $meta['description'] ?? "Temen-teman juga bisa mendapatkan Bantuan Hukum Gratis, Mencari Informasi Persidangan, Menemukan Kamus Hukum Online, Informasi Hukum berbentuk Digital, Menemukan Solusi Permasalahan Hukum, Menghadirkan Kami Sebagai Pemateri,  Mengikuti Jadwal Pembelajaran Online yang tersedia, serta Melakukan Peminjaman Buku Hukum di Perpustakaan JDIH Kota Tanjungpinang")
		@php($img = $meta['image'] ?? 'assets/img/logo-tpi.png')
		@php($type = $meta['type'] ?? 'website')
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="{{$description}}" />
		<meta name="author" content="{{$title}}" />
		<meta property="og:url"           content="{{url()->full()}}" />
		<meta property="og:type"          content="{{$type}}" />
		<meta property="og:title"         content="{{$title}}" />
		<meta property="og:description"   content="{{$description}}" />
		<meta property="og:image"         content="{{asset($img)}}" />
		<title>{{$title}}</title>