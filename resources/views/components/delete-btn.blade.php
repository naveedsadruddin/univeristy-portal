
<button type="button" onclick="event.preventDefault();
document.getElementById('delete-form-{{ $id }}').submit();" title="Delete Record" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
<form action="/courses/{{$id}}" method="post" id="delete-form-{{ $id }}">
    @csrf
    @method('DELETE')
</form>
