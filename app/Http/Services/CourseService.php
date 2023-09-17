<?php namespace App\Http\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class CourseService {

    protected $model , $roleSevice;
    public function __construct()
    {
        $this->model = new Course();
        $this->roleSevice = new RoleService();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $records = $this->model;

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
        $record->title = $title;
        $record->description = $description;
        $record->user_id = $user_id;
        $record->start_date = $start_date;
        $record->end_date = $end_date;
        $record->save();
        return $record;
    }

    public function edit($data, $id)
    {
        extract($data);
        $record = $this->fetch($id);
        $record->title = $title;
        $record->description = $description;
        $record->user_id = $user_id;
        $record->start_date = $start_date;
        $record->end_date = $end_date;
        $record->save();
        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        return $record->delete();
    }
}
