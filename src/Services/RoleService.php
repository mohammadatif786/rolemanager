<?php

namespace Atif\RoleManager\Services;

use Atif\RoleManager\Models\Role;
use Illuminate\Support\Collection;

class RoleService
{
    /**
     * Get all roles.
     *
     * @return Collection
     */
    public function getAllRoles(): Collection
    {
        return Role::with('permissions')->get();
    }

    /**
     * Create a new role.
     *
     * @param array $data
     * @return Role
     */
    public function createRole(array $data): Role
    {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? config('RoleManager.guard', 'web'),
        ]);

        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return $role;
    }

    /**
     * Update an existing role.
     *
     * @param int|Role $role
     * @param array $data
     * @return bool
     */
    public function updateRole($role, array $data): bool
    {
        if (!$role instanceof Role) {
            $role = Role::findOrFail($role);
        }

        $updated = $role->update([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? $role->guard_name,
        ]);

        if ($updated && isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return $updated;
    }

    /**
     * Delete a role.
     *
     * @param int|Role $role
     * @return bool
     */
    public function deleteRole($role): bool
    {
        if (!$role instanceof Role) {
            $role = Role::findOrFail($role);
        }

        return $role->delete();
    }

    /**
     * Find a role by ID.
     *
     * @param int $id
     * @return Role
     */
    public function findRoleById(int $id): Role
    {
        return Role::findOrFail($id);
    }
}
