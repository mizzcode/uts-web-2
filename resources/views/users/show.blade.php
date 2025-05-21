<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Created At:</strong> {{ $user->created_at->format('d M Y H:i') }}
                    </div>
                    <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Edit</a>
                    <a href="{{ route('users.index') }}" class="ml-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>