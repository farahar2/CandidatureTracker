<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">
                        {{ __('Welcome back,') }} {{ Auth::user()->name }} 👋
                    </h3>
                    <p class="text-gray-500">
                        {{ __('Track your job applications and interviews from one place.') }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('applications.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            {{ __('View my applications') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>