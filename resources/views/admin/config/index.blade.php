@extends('layouts.admin.master')

@section('title', "Pengaturan")

@section('content')
	<!-- Begin Page Content -->
  <div class="container-fluid">
    @include('partials/toast')
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          Pengaturan
        </div>
      </div>
      <div class="card-body">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-menu-tab" data-bs-toggle="tab" data-bs-target="#nav-menu" type="button" role="tab" aria-controls="nav-menu" aria-selected="true">Menu</button>
            <button class="nav-link" id="nav-menu-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-menu-grid" type="button" role="tab" aria-controls="nav-menu-grid" aria-selected="false">Menu Grid</button>
            <button class="nav-link" id="nav-menu-sidebar-tab" data-bs-toggle="tab" data-bs-target="#nav-menu-sidebar" type="button" role="tab" aria-controls="nav-menu-sidebar" aria-selected="false">Sidebar</button>
            <button class="nav-link" id="nav-banner-tab" data-bs-toggle="tab" data-bs-target="#nav-banner" type="button" role="tab" aria-controls="nav-banner" aria-selected="false">Slider Banner</button>
            <button class="nav-link" id="nav-intro-tab" data-bs-toggle="tab" data-bs-target="#nav-intro" type="button" role="tab" aria-controls="nav-intro" aria-selected="false">Website Intro</button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active border p-3" id="nav-menu" role="tabpanel" aria-labelledby="nav-menu-tab" tabindex="0">
            @include('admin.config.partials.tab-menu')
          </div>
          <div class="tab-pane fade border p-3" id="nav-menu-grid" role="tabpanel" aria-labelledby="nav-menu-grid" tabindex="0">
            @include('admin.config.partials.tab-menu-grid')
          </div>
          <div class="tab-pane fade border p-3" id="nav-menu-sidebar" role="tabpanel" aria-labelledby="nav-menu-sidebar" tabindex="0">
            @include('admin.config.partials.tab-menu-sidebar')
          </div>
          <div class="tab-pane fade border p-3" id="nav-banner" role="tabpanel" aria-labelledby="nav-banner-tab" tabindex="0">
            @include('admin.config.partials.tab-banner')
          </div>
          <div class="tab-pane fade border p-3" id="nav-intro" role="tabpanel" aria-labelledby="nav-intro-tab" tabindex="0">
            @include('admin.config.partials.tab-intro')
          </div>
        </div>
      </div>
    </div>
    @include('partials.modalHapus')
  </div>
  <!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
  var ckeditorDiv;
  window.onload = (event)=> {
    let myAlert = document.querySelector('.toast');
    if(myAlert){
      let bsAlert = new bootstrap.Toast(myAlert);
      bsAlert.show(); 
    }

    var page = "{{Session::get('page')}}";
    const hash = (window.location.hash).replace(/[#]/g, "");

    const triggerEl = document.querySelector('#nav-tab button[data-bs-target="#nav-'+hash+'"]')
    if(triggerEl)
    {
      bootstrap.Tab.getOrCreateInstance(triggerEl).show() // Select tab by name 
    }

    //dropzone Lampiran
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("div#document-dropzone", { 
      url: "{{route('config.store', ['page' => 'intro'])}}",
      chunking: true,
      autoProcessQueue: true,
      maxFiles: 1,
      method: "POST",
      maxFilesize: 40000000000,
      chunkSize: 1000000,
      parallelChunkUploads: true,
      acceptedFiles: ".mp3",
    });

    /*myDropzone.on("addedfile", file => {
      let extension = file.name.split('.').pop();
      console.log(extension )
      document.querySelector('.nama_file').value += "."+extension;
    });*/

    myDropzone.on("sending", function(file, xhr, formData) {
      formData.append("_token", '{{ csrf_token() }}');
    });

    myDropzone.on("success", function(file, response) {
      //console.log("success", response)
      window.location.href = "#intro";
      location.reload()
      //console.log(response)
      //const modalUpload = document.getElementById('modalUpload');
      //const modalInputNamaFile = modalUpload.querySelector('.modal-body input.nama_file')
      //modalInputNamaFile.value = file.name
    });
  }
</script>
@endsection