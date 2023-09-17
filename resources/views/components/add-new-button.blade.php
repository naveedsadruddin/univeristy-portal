@permission(str_replace('.index', '.create', Route::currentRouteName()))
<div class="col text-right mb-2">
    <a href="{{ route($entity.'.create') }}" class="btn btn-round btn-primary btn-sm text-right"><i class="fa fa-plus"></i> Add New</a>
</div>
@endpermission
