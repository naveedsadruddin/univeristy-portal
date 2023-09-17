@permission(str_replace('.index', '.destroy', Route::currentRouteName()))
<button type="button" onclick="event.preventDefault();if(confirm('Are you sure you want to delete this record?')){
document.getElementById('delete-form-{{ $id }}').submit();}" title="Delete record" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
<form action="{{ route(str_replace('.index', '', Route::currentRouteName()).'.destroy', [$entity => $id]) }}" method="post" id="delete-form-{{ $id }}">
    @csrf
    @method('DELETE')
</form>
@endpermission
