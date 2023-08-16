<div class="toast-container position-fixed top-0 end-0 p-3">
  @if(isset ($errors) && count($errors) > 0)
    <div id="liveToast" class="toast align-items-center border border-danger text-danger" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex align-items-center">
        <span class="ms-2">
          <i class="bi bi-exclamation-circle-fill"></i>  
        </span>
        
        <div class="toast-body">
          <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-danger me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if(Session::get('success', false))
    @php ($data = Session::get('success'))
    @if (is_array($data))
      @foreach ($data as $msg)
        <div id="liveToast" class="toast align-items-center border border-success text-success" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <span class="ms-2">
              <i class="bi bi-check-circle-fill"></i>
            </span>
            <div class="toast-body">
              {{ $msg }}
            </div>
            <button type="button" class="btn-close btn-close-success me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endforeach
    @else
      <div id="liveToast" class="toast align-items-center border border-success text-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center">
          <span class="ms-2">
            <i class="bi bi-check-circle-fill"></i>
          </span>
          <div class="toast-body">
            {{ $data }}
          </div>
          <button type="button" class="btn-close btn-close-success me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    @endif
  @endif
</div>