@extends('client.layout')

@section('content')
    <input type="hidden" id="story_slug" value="{{ $story->slug }}">

    <div class="bg-gray-50 dark:bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Story Details Section -->
                <div class="w-full lg:w-2/3">
                    <!-- Story Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden mb-8">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h2
                                class="text-xl font-bold text-gray-900 dark:text-white inline-block border-b-2 border-primary-500 pb-1">
                                Story Information
                            </h2>
                        </div>

                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Book Cover -->
                                <div class="w-full md:w-1/4 flex justify-center">
                                    <div
                                        class="rounded-lg overflow-hidden shadow-lg transform transition-transform hover:scale-105 hover:shadow-xl">
                                        <img src="{{ asset($story->thumbnail) }}" alt="{{ $story->title }}"
                                            class="w-full object-cover aspect-[2/3]" loading="lazy">
                                    </div>
                                </div>

                                <!-- Story Details -->
                                <div class="w-full md:w-3/4">
                                    <h1
                                        class="text-2xl font-bold text-gray-900 dark:text-white text-center md:text-left border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                        {{ $story->title }}
                                    </h1>

                                    <!-- Story Description with toggle -->
                                    <div class="relative overflow-hidden transition-all duration-300" id="storyDescription">
                                        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                            {!! $story->description !!}
                                        </div>
                                    </div>

                                    <!-- Show More/Less Button -->
                                    <div class="flex justify-center mt-3">
                                        <button id="toggleDescription"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <span>Show More</span>
                                            <svg id="arrowDown" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg id="arrowUp" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 hidden"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Story Metadata -->
                                    <div class="mt-6 space-y-3">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-gray-900 dark:text-white w-24">Author:</span>
                                            <span class="text-gray-700 dark:text-gray-300">{{ $story->author }}</span>
                                        </div>

                                        <div class="flex items-start">
                                            <span
                                                class="font-semibold text-gray-900 dark:text-white w-24">Categories:</span>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($story->categories as $category)
                                                    <a href="{{ route('client.category', $category->slug) }}"
                                                        class="inline-block px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded text-xs hover:bg-primary-100 dark:hover:bg-primary-900 transition duration-200">
                                                        {{ $category->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="flex items-center">
                                            <span class="font-semibold text-gray-900 dark:text-white w-24">Status:</span>
                                            <span
                                                class="text-primary-600 dark:text-primary-400">{{ $story->status_story }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chapter List -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h2
                                class="text-xl font-bold text-gray-900 dark:text-white inline-block border-b-2 border-primary-500 pb-1">
                                Chapter List
                            </h2>
                        </div>

                        <div class="p-6">
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($chapters as $chapter)
                                    <li class="py-3">
                                        <a href="{{ route('client.chapter', [$story->slug, "chuong-$chapter->index"]) }}"
                                            class="flex items-start text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition duration-150">
                                            <span
                                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 dark:bg-gray-700 text-xs font-medium text-gray-800 dark:text-gray-200 mr-3 flex-shrink-0">
                                                {{ $chapter->index }}
                                            </span>
                                            <span class="font-medium">{{ $chapter->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $chapters->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/3">
                    <!-- Popular Stories -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden sticky top-20">
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h2
                                class="text-xl font-bold text-gray-900 dark:text-white inline-block border-b-2 border-primary-500 pb-1">
                                Hot Stories
                            </h2>
                        </div>

                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($top_view as $index => $item)
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center justify-center h-8 w-8 rounded-full text-white font-bold mr-3 flex-shrink-0
                                                            {{ $index == 0 ? 'bg-red-500' : '' }}
                                                            {{ $index == 1 ? 'bg-green-500' : '' }}
                                                            {{ $index == 2 ? 'bg-blue-500' : '' }}
                                                            {{ $index > 2 ? 'bg-gray-400' : '' }}">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <a href="{{ route('client.story', ['slug' => $item->slug]) }}"
                                                class="block text-gray-900 dark:text-white font-medium hover:text-primary-600 dark:hover:text-primary-400 mb-1">
                                                {{ $item->title }}
                                            </a>
                                            <div class="flex flex-wrap gap-1 text-xs text-gray-600 dark:text-gray-400">
                                                @foreach ($item->categories as $key => $category)
                                                    <a href="{{ route('client.category', $category->slug) }}"
                                                        class="hover:text-primary-600 dark:hover:text-primary-400">
                                                        {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const description = document.getElementById('storyDescription');
            const toggleButton = document.getElementById('toggleDescription');
            const arrowDown = document.getElementById('arrowDown');
            const arrowUp = document.getElementById('arrowUp');
            let expanded = false;

            // Set initial height
            description.style.maxHeight = '200px';

            toggleButton.addEventListener('click', function () {
                if (!expanded) {
                    description.style.maxHeight = description.scrollHeight + 'px';
                    arrowDown.classList.add('hidden');
                    arrowUp.classList.remove('hidden');
                    toggleButton.querySelector('span').textContent = 'Show Less';
                } else {
                    description.style.maxHeight = '200px';
                    arrowDown.classList.remove('hidden');
                    arrowUp.classList.add('hidden');
                    toggleButton.querySelector('span').textContent = 'Show More';
                }
                expanded = !expanded;
            });
        });
    </script>
@endsection