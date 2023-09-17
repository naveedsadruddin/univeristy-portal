<?php namespace App\Http\Services;

use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EnrollmentService {

    protected $model , $roleSevice;
    public function __construct()
    {
        $this->model = new Enrollment();
    }

    public function list($relations = array())
    {
        $pagination = session()->get('pagination') ?? 10;
        $records = $this->model;

        return $records->with($relations)->paginate($pagination);
    }

    public function fetch($id, $relations = array())
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function create($data , $id)
    {
        extract($data);
        $record = $this->model;
        $record->user_id = Auth::user()->id;
        $record->course_id = $id;
        $record->date = Carbon::now()->toDateString();
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

    public function listUserEnrollments($relations = array()){
        $pagination = session()->get('pagination') ?? 10;
        $records = $this->model;

        return $records->where('user_id',Auth::user()->id)->with($relations)->paginate($pagination);
    }
}
