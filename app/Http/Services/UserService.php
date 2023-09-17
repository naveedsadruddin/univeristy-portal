<?php namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UserService {

    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $records = $this->model;

        if(isset($role) && $role)
            $records = $records->whereHas('roles', function($q) use ($role) {
                $q->where('slug', $role);
            });

        return $records->with($relations)->paginate($pagination);
    }

    public function fetch($id, $relations = array())
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->email = $email;
        $record->password = Hash::make($password);
        $record->status = $status ?? 1;
        $record->save();
        $record->attachRole($roles);
        return $record;
    }

    public function edit($data, $id)
    {
        extract($data);
        $record = $this->fetch($id);
        $record->name = $name;

        if(auth()->user()->isAdmin())
            $record->email = $email;

        $record->password = (isset($password) && $password) ? Hash::make($password) : $record->password;
        $record->status = $status;
        $record->save();

        $record->syncRoles($roles);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        $record->detachAllRoles();
        return $record->delete();
    }
}
