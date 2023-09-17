<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{RoleEdit, RoleStore};
use App\Http\Services\{PermissionService, RoleService, RouterService};

class RoleController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct(){
        $this->entity = 'roles';
        $this->router = 'roles.index';
        $this->service = new RoleService();
        $this->routerService = new RouterService();
        $this->middleware('pagination.parse')->only('index');
    }

    public function index()
    {
        $entity = $this->entity;
        $records = $this->service->list();
        return view($this->router, compact('entity', 'records'));
    }

    public function create()
    {
        $entity = $this->entity;
        $permissionService = new PermissionService();
        $permissions = $permissionService->all();
        return view($this->entity.'.create', compact('entity', 'permissions'));
    }

    public function store(RoleStore $request)
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
        $entity = $this->entity;
        $record = $this->service->fetch($id);
        $permissionService = new PermissionService();
        $permissions = $permissionService->all();
        return view($this->entity.'.edit', compact('entity', 'record', 'permissions'));
    }

    public function update(RoleEdit $request, $id)
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
