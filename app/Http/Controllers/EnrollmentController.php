<?php

namespace App\Http\Controllers;

use App\Http\Services\CourseService;
use App\Http\Services\EnrollmentService;
use App\Http\Services\RouterService;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    protected $entity, $router, $service, $routerService , $courseService;

    public function __construct()
    {
        $this->entity = 'enroll';
        $this->router = 'enroll.index';
        $this->service = new EnrollmentService();
        $this->routerService = new RouterService();
        $this->courseService = new CourseService();
        $this->middleware('pagination.parse')->only('index');
    }

    public function index(Request $request)
    {
        $entity = $this->entity;
        $records = $this->service->list(['user', 'course']);
        return view('enroll.index', compact('records', 'entity'));
    }

    public function create()
    {
        $entity = $this->entity;
        $records = $this->courseService->list(['user']);
        return view('enroll.'.'.create', compact('entity' , 'records'));
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $message = 'Record successfully created.';
        $error = false;
        try {
            \DB::beginTransaction();
                if(!Enrollment::where('user_id', Auth::user()->id)->where('course_id',$id)->get()){
                    $this->service->create($data , $id);
                }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            $error = true;
            $message = $e->getMessage();
        }
        $records = $this->service->list(['user', 'course']);

        return $this->routerService->redirect('user.enrollments', $error, $message );
    }


    public function destroy($id)
    {
        $error = false;
        $message = 'Record successfully deleted.';
        try {
            $this->service->delete($id);
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }
        $entity = $this->entity;
        $records = $this->service->list(['user', 'course']);
        return view('enroll.index', compact('records', 'entity'));
    }
    public function userEnrollments(Request $request)
    {
        $entity = $this->entity;
        $records = $this->service->listUserEnrollments(['user', 'course']);
        return view('enroll.index', compact('records', 'entity'));
    }

}
