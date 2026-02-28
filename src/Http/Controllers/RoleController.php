<?php

namespace Atif\RoleManager\Http\Controllers;

use Atif\RoleManager\Http\Requests\StoreRoleRequest;
use Atif\RoleManager\Http\Requests\UpdateRoleRequest;
use Atif\RoleManager\Services\RoleService;
use Atif\RoleManager\Services\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * RoleController constructor.
     *
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the roles.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = $this->roleService->getAllRoles();
        $permissions = $this->permissionService->getAllPermissions();
        return view('RoleManager::roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return View
     */
    public function create(): View
    {
        return view('RoleManager::roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->roleService->createRole($request->validated());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $role = $this->roleService->findRoleById($id);
        return view('RoleManager::roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, int $id): RedirectResponse
    {
        $this->roleService->updateRole($id, $request->validated());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->roleService->deleteRole($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
