<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{CourseEdit, UserEdit, Coursestore};
use App\Http\Services\{CourseService, RoleService, RouterService};
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct()
    {
        $this->entity = 'courses';
        $this->router = 'courses.index';
        $this->service = new CourseService();
        $this->routerService = new RouterService();
        $this->middleware('pagination.parse')->only('index');
    }

    public function index(Request $request)
    {
        $entity = $this->entity;
        $records = $this->service->list(['user'], $request->all());

        return view('courses.index', compact('records', 'entity'));
    }

    public function create()
    {
        $roles = array();
        $entity = $this->entity;
        $roleService = new RoleService();
        $users = $roleService->fetchBySlugWithRelations('instructor' ,['users'])->users;
        return view('courses.'.'.create', compact('entity', 'users'));
    }

    public function store(CourseStore $request)
    {
        $data = $request->validated();
        $message = 'Record successfully created.';
        $error = false;

        try {
            \DB::beginTransaction();
            $this->service->create($data);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            $error = true;
            $message = $e->getMessage();
        }
        return $this->routerService->redirect($this->router, $error, $message);
    }

    public function edit($id)
    {
        $roles = array();
        $record = $this->service->fetch($id , ['user']);
        $entity = $this->entity;
        $roleService = new RoleService();
        $users = $roleService->fetchBySlugWithRelations('instructor' ,['users'])->users;
        return view($this->entity.'.edit', compact('record', 'entity', 'users'));
    }

    public function update(CourseEdit $request, $id)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            \DB::beginTransaction();
            $this->service->edit($data, $id);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            $error = true;
            $message = $e->getMessage();
        }
        return $this->routerService->redirect($this->router, $error, $message);
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
        return $this->routerService->redirect($this->router, $error, $message);
    }
}
