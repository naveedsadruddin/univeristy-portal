<?php namespace App\Http\Services;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionService {

    protected $model;
    public function __construct()
    {
        $this->model = new Permission();
    }

    public function list()
    {
        $pagination = session()->get('pagination') ?? 10;
        return $this->model->orderBy('id', 'desc')->paginate($pagination);
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->slug = str_slug($slug, '.');
        $record->description = $description ?? null;
        $record->save();
        return $record;
    }

    public function edit($data, $id)
    {
        extract($data);
        $record = $this->fetch($id);
        $record->name = $name;
        $record->slug = str_slug($slug, '.');
        $record->description = $description ?? null;
        $record->save();

        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        return $record->delete();
    }

    public function all()
    {
        return $this->model->all();
    }

}
