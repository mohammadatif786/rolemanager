@extends(config('RoleManager.layout', 'layouts.app'))

@section('content')
<div x-data="{ 
    showCreateModal: false, 
    showEditModal: false,
    editingRole: { id: null, name: '', guard_name: 'web', permissions: [] },
    deleteRole(id, name) {
        if (confirm('Are you sure you want to delete the role `' + name + '`?')) {
            document.getElementById('delete-role-form-' + id).submit();
        }
    }
}" class="space-y-8">
    
    <!-- Page Header -->
    <div class="relative overflow-hidden rounded-3xl bg-white/40 backdrop-blur-xl border border-white/40 p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-50/50 blur-3xl"></div>
        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-x-5">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 shadow-xl shadow-indigo-200">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">System Roles</h1>
                    <p class="mt-1 text-sm font-medium text-slate-500">Manage organizational hierarchies and access control levels.</p>
                </div>
            </div>
            <div class="flex items-center gap-x-3">
                <button @click="showCreateModal = true" class="group relative inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-500 transition-all duration-200 active:scale-95">
                    <svg class="-ml-0.5 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Create New Role
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Table -->
    <div class="rounded-3xl bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/50">
                        <th class="px-8 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Role Identity</th>
                        <th class="px-8 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Security Guard</th>
                        <th class="px-8 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Created At</th>
                        <th class="px-8 py-5 text-right text-[11px] font-black uppercase tracking-widest text-slate-400">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($roles as $role)
                    <tr class="group hover:bg-slate-50/80 transition-all duration-200">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-x-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 font-bold group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                    {{ strtoupper(substr($role->name, 0, 2)) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900">{{ $role->name }}</span>
                                    <span class="text-[11px] font-medium text-slate-400 tracking-wide">ID: #{{ $role->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-flex items-center rounded-lg bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/10 uppercase tracking-wider">
                                {{ $role->guard_name }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-slate-600">{{ $role->created_at->format('M d, Y') }}</span>
                                <span class="text-[11px] text-slate-400">{{ $role->created_at->format('h:i A') }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end items-center gap-x-2">
                                <button @click="editingRole = { 
                                    id: {{ $role->id }}, 
                                    name: '{{ $role->name }}', 
                                    guard_name: '{{ $role->guard_name }}',
                                    permissions: {{ json_encode($role->permissions->pluck('name')) }}
                                }; showEditModal = true" class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white text-slate-400 shadow-sm ring-1 ring-inset ring-slate-200 hover:text-indigo-600 hover:ring-indigo-200 hover:bg-indigo-50 transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button @click="deleteRole({{ $role->id }}, '{{ $role->name }}')" class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white text-slate-400 shadow-sm ring-1 ring-inset ring-slate-200 hover:text-rose-600 hover:ring-rose-200 hover:bg-rose-50 transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                                <form id="delete-role-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 text-slate-200 mb-4">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900">No roles found</h3>
                                <p class="text-xs text-slate-500 mt-1">Get started by creating your first system role.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals Implementation -->
    
    <!-- Create Role Modal -->
    <div x-show="showCreateModal" 
         class="fixed inset-0 z-[60] overflow-y-auto" 
         x-cloak
         style="display: none;">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="showCreateModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-md transition-opacity" 
                 @click="showCreateModal = false"></div>

            <div x-show="showCreateModal"
                 x-transition:enter="ease-out duration-400"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2.5rem] bg-white px-8 pb-8 pt-10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl">
                
                <div class="absolute right-6 top-6">
                    <button @click="showCreateModal = false" class="rounded-2xl p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-x-5 mb-8">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-900">Define New Role</h3>
                        <p class="text-sm font-medium text-slate-500">Configure access levels and security context.</p>
                    </div>
                </div>

                <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Role Label</label>
                        <input type="text" name="name" required placeholder="e.g. Content Manager" class="block w-full rounded-2xl border-slate-200 py-3.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Guard Context</label>
                        <select name="guard_name" class="block w-full rounded-2xl border-slate-200 py-3.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                            <option value="web">Web Application</option>
                            <option value="api">API Endpoint</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-3">Assign Permissions</label>
                        <div class="grid grid-cols-2 gap-4 max-h-48 overflow-y-auto p-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                            @foreach($permissions as $permission)
                            <label class="flex items-center gap-x-3 cursor-pointer group">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="h-5 w-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 flex items-center gap-x-4">
                        <button type="button" @click="showCreateModal = false" class="flex-1 rounded-2xl bg-slate-100 py-4 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="flex-[2] rounded-2xl bg-indigo-600 py-4 text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-500 transition-all active:scale-95">
                            Create Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div x-show="showEditModal" 
         class="fixed inset-0 z-[60] overflow-y-auto" 
         x-cloak
         style="display: none;">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="showEditModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-md transition-opacity" 
                 @click="showEditModal = false"></div>

            <div x-show="showEditModal"
                 x-transition:enter="ease-out duration-400"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-[2.5rem] bg-white px-8 pb-8 pt-10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl">
                
                <div class="absolute right-6 top-6">
                    <button @click="showEditModal = false" class="rounded-2xl p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-x-5 mb-8">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-900">Modify Role</h3>
                        <p class="text-sm font-medium text-slate-500">Update identity and guard configuration.</p>
                    </div>
                </div>

                <form :action="'{{ route('roles.update', ['id' => '_ID_']) }}'.replace('_ID_', editingRole.id)" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Role Label</label>
                        <input type="text" name="name" x-model="editingRole.name" required class="block w-full rounded-2xl border-slate-200 py-3.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Guard Context</label>
                        <select name="guard_name" x-model="editingRole.guard_name" class="block w-full rounded-2xl border-slate-200 py-3.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                            <option value="web">Web Application</option>
                            <option value="api">API Endpoint</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-3">Assign Permissions</label>
                        <div class="grid grid-cols-2 gap-4 max-h-48 overflow-y-auto p-4 rounded-2xl border border-slate-100 bg-slate-50/50">
                            @foreach($permissions as $permission)
                            <label class="flex items-center gap-x-3 cursor-pointer group">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                       x-model="editingRole.permissions"
                                       class="h-5 w-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-indigo-500 transition-all">
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 flex items-center gap-x-4">
                        <button type="button" @click="showEditModal = false" class="flex-1 rounded-2xl bg-slate-100 py-4 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="flex-[2] rounded-2xl bg-indigo-600 py-4 text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-500 transition-all active:scale-95">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
