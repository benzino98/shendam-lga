@extends('admin.layouts.app')

@section('title', $role->name)
@section('page-title', 'View Role')

@section('content')
    <div class="space-y-6">
        <!-- Role Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $role->name }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.roles.edit', $role) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this role?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                        <p class="text-gray-900">{{ $role->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Users Count</label>
                        <span class="inline-block px-2 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $role->users->count() }} {{ Str::plural('user', $role->users->count()) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Permissions Count</label>
                        <span class="inline-block px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $role->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($role->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                        <p class="text-gray-900">{{ $role->description }}</p>
                    </div>
                @endif

                <!-- Permissions -->
                @if($role->permissions->count() > 0)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Permissions</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            @foreach($role->permissions as $permission)
                                <span class="px-3 py-1 bg-[#142F32]/10 text-[#142F32] text-sm font-semibold rounded-full">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Users -->
                @if($role->users->count() > 0)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Users with this Role</h3>
                        <div class="space-y-2">
                            @foreach($role->users as $user)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-sm font-medium text-[#142F32] hover:underline">
                                        {{ $user->name }}
                                    </a>
                                    <span class="text-xs text-gray-500">{{ $user->email }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Roles
            </a>
            <a href="{{ route('admin.roles.edit', $role) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Role
            </a>
        </div>
    </div>
@endsection
