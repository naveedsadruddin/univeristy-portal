@if ($message)
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false" style="position: absolute; top: 75px; right: 5px;">
  <div class="toast-header">
    <svg class="bd-placeholder-img rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="{{ $type === 'success' ? '#1E98D5' : '#e74a3b'}}"></rect></svg>
    <strong class="mr-auto">{{ $title }}</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">{{ $message }}</div>
</div>
@endif