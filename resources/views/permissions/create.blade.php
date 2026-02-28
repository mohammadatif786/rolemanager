@extends(config('RoleManager.layout', 'layouts.app'))

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-3xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">Create New Permission</h2>
            <p class="mt-2 text-sm text-slate-600">Define a new permission for granular access control.</p>
        </div>
    </div>

    <div class="bg-white/60 backdrop-blur-md shadow-xl ring-1 ring-slate-900/5 sm:rounded-2xl overflow-hidden border border-white/20">
        <form action="#" method="POST" class="p-8">
            @csrf
            <div class="space-y-8">
                <div>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-semibold leading-6 text-slate-900">Permission Name</label>
                            <div class="mt-2 relative">
                                <input type="text" name="name" id="name" autocomplete="off" 
                                    class="block w-full rounded-xl border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200" 
                                    placeholder="e.g. edit-articles">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-slate-500">Use kebab-case for naming permissions (e.g., 'create-post', 'delete-user').</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="guard" class="block text-sm font-semibold leading-6 text-slate-900">Guard Name</label>
                            <div class="mt-2">
                                <select id="guard" name="guard" 
                                    class="block w-full rounded-xl border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200 bg-white">
                                    <option value="web">Web</option>
                                    <option value="api">API</option>
                                </select>
                            </div>
                            <p class="mt-2 text-xs text-slate-500">Select the authentication guard for this permission.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-200/60 flex items-center justify-end gap-x-6">
                    <a href="{{ route('permissions.index') }}" class="text-sm font-semibold leading-6 text-slate-900 hover:text-slate-600 transition-colors">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
                        <svg class="-ml-0.5 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Permission
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
