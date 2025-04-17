@extends('client.layout')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Account Management
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Manage your profile and account settings
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Sidebar Navigation -->
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden rounded-lg">
                        <div class="px-4 py-5 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Account</h3>
                        </div>
                        <nav class="px-4 py-3">
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('auth.profile') }}"
                                        class="flex items-center px-3 py-2 text-sm font-medium rounded-md bg-primary-50 dark:bg-primary-900 text-primary-700 dark:text-primary-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Profile Information
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.password.change') }}"
                                        class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Change Password
                                    </a>
                                </li>
                                @if (Auth::user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <i class="fa-solid fa-user-shield mr-2"></i>
                                            Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('client.index') }}"
                                        class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Back to Website
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="md:col-span-3">
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden rounded-lg">
                        <div class="px-4 py-5 border-b border-gray-200 dark:border-gray-700 sm:px-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Profile Information</h3>
                        </div>

                        <!-- Success Message -->
                        @if (session('success'))
                            <div
                                class="mx-6 my-4 bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 rounded-md p-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Profile Edit Form -->
                        <form action="{{ route('auth.profile.update') }}" method="POST" class="px-4 py-5 sm:p-6">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Name
                                    </label>
                                    <input type="text" name="name" id="name" autocomplete="name" value="{{ $user->name }}"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Email address
                                    </label>
                                    <input type="email" name="email" id="email" autocomplete="email"
                                        value="{{ $user->email }}"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Account Type
                                    </label>
                                    <div class="mt-1 flex items-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Member Since
                                    </label>
                                    <div class="mt-1">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('F j, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection