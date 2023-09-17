<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{UserEdit, UserStore};
use App\Http\Services\{RoleService, RouterService, UserService};
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct()
    {
        $this->entity = 'users';
        $this->router = 'users.index';
        $this->service = new UserService();
        $this->routerService = new RouterService();
        $this->middleware('pagination.parse')->only('index');
    }

    public function index(Request $request)
    {
        $entity = $this->entity;
        $records = $this->service->list([], $request->all());
        $roleService = new RoleService();
        $roles = $roleService->all();
        return view('users.index', compact('records', 'roles', 'entity'));
    }

    public function create()
    {
        $roles = array();
        $entity = $this->entity;
        if(auth()->user()->isAdmin()){
            $roleService = new RoleService();
            $roles = $roleService->all();
        }
        return view('users.'.'.create', compact('entity', 'roles'));
    }

    public function store(UserStore $request)
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
        $record = $this->service->fetch($id);
        $entity = $this->entity;
        if(auth()->user()->isAdmin()){
            $roleService = new RoleService();
            $roles = $roleService->all();
        }
        return view($this->entity.'.edit', compact('record', 'entity', 'roles'));
    }

    public function update(UserEdit $request, $id)
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
