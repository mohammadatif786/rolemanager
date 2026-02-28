<?php

namespace Atif\RoleManager\Services;

use Atif\RoleManager\Models\Permission;
use Illuminate\Support\Collection;

class PermissionService
{
    /**
     * Get all permissions.
     *
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        return Permission::all();
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data): Permission
    {
        return Permission::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? config('RoleManager.guard', 'web'),
        ]);
    }

    /**
     * Update an existing permission.
     *
     * @param int|Permission $permission
     * @param array $data
     * @return bool
     */
    public function updatePermission($permission, array $data): bool
    {
        if (!$permission instanceof Permission) {
            $permission = Permission::findOrFail($permission);
        }

        return $permission->update([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? $permission->guard_name,
        ]);
    }

    /**
     * Delete a permission.
     *
     * @param int|Permission $permission
     * @return bool
     */
    public function deletePermission($permission): bool
    {
        if (!$permission instanceof Permission) {
            $permission = Permission::findOrFail($permission);
        }

        return $permission->delete();
    }

    /**
     * Find a permission by ID.
     *
     * @param int $id
     * @return Permission
     */
    public function findPermissionById(int $id): Permission
    {
        return Permission::findOrFail($id);
    }
}
