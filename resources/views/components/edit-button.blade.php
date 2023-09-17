@permission(str_replace('.index', '.edit', Route::currentRouteName()))
<a href="{{ route(str_replace('.index', '', Route::currentRouteName()).'.edit', [$entity => $id]) }}" title="Edit record" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
@endpermission
