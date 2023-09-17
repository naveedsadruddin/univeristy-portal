<a 
    href="{{ route(str_replace('-', '.', (isset($explicit) && $explicit ? $explicit : $entity)).'.create') }}" 
    title="Add New Record" class="btn btn-round btn-{{ $btnType ?? 'primary'}} float-right">
        <i class="fa fa-plus"></i> {{ $title ?? 'Add New'}}
</a>
