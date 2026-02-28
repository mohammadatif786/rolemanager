<?php

namespace Atif\RoleManager\Http\Controllers;

use Atif\RoleManager\Http\Requests\StorePermissionRequest;
use Atif\RoleManager\Http\Requests\UpdatePermissionRequest;
use Atif\RoleManager\Services\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * PermissionController constructor.
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the permissions.
     *
     * @return View
     */
    public function index(): View
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('RoleManager::permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return View
     */
    public function create(): View
    {
        return view('RoleManager::permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $this->permissionService->createPermission($request->validated());
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $permission = $this->permissionService->findPermissionById($id);
        return view('RoleManager::permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, int $id): RedirectResponse
    {
        $this->permissionService->updatePermission($id, $request->validated());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->permissionService->deletePermission($id);
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
