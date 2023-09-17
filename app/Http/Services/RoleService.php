<?php namespace App\Http\Services;

use jeremykenedy\LaravelRoles\Models\Role;

class RoleService {

    protected $model;
    public function __construct()
    {
        $this->model = new Role();
    }

    public function list()
    {
        $pagination = session()->get('pagination') ?? 10;
        return $this->model->latest()->paginate($pagination);
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function fetchBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->slug = str_slug($slug, '.');
        $record->status = $status;
        $record->description = $description ?? null;
        $record->save();

        if(isset($permissions) && $permissions)
            $record->attachPermission($permissions);
        return $record;
    }

    public function edit($data, $id)
    {
        extract($data);
        $record = $this->fetch($id);
        $record->name = $name;
        $record->status = 1;
        $record->slug = str_slug($slug, '.');
        $record->description = $description ?? null;
        $record->save();

        if(isset($permissions) && $permissions)
            $record->syncPermissions($permissions);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        return $record->delete();
    }

    public function all()
    {
        return $this->model->get();
    }
    public function fetchBySlugWithRelations($slug , $relations = [])
    {
        return $this->model->where('slug', $slug)->with($relations)->first();
    }
}
