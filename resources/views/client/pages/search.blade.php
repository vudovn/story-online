@extends('client.layout')

@section('content')
    <div class="container mx-auto px-4 pt-6 pb-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Search Results for "{{ $query }}"</h1>
            <p class="text-gray-600 dark:text-gray-300">Found {{ count($stories) }} stories matching your search.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6">
            <form action="{{ route('client.search') }}" method="GET" class="flex space-x-2">
                <div class="flex-grow">
                    <input type="text" name="key_word" value="{{ $query }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 dark:text-white"
                        placeholder="Search stories..." />
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Search
                </button>
            </form>
        </div>

        @if(count($stories) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                @foreach($stories as $story)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <a href="{{ route('client.story', $story->slug) }}" class="block">
                            <div class="h-100 overflow-hidden">
                                <img src="{{ $story->thumbnail ?? 'https://placehold.co/600x400?text=No+Image' }}"
                                    alt="{{ $story->title }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1 line-clamp-1">
                                    {{ $story->title }}</h3>
                                <div class="flex items-center mb-2">
                                    <span
                                        class="inline-block px-2 py-1 text-xs rounded-full {{ $story->status_story == 'Completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }}">
                                        {{ $story->status_story }}
                                    </span>
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $story->new_chapter ?? 0 }}
                                        chapters</span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                    {!! strip_tags($story->description) !!}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-2">No Results Found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">We couldn't find any stories matching "{{ $query }}".</p>
                <a href="{{ route('client.index') }}"
                    class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Back to Home
                </a>
            </div>
        @endif
    </div>
@endsection
