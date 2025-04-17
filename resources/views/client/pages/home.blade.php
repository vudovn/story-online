@extends('client.layout')

@section('content')
    <!-- Hot Stories Section -->
    <section id="hot-stories"
        class="py-12 bg-gradient-to-br from-primary-50 to-secondary-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <span class="border-b-2 border-primary-500 pb-1">Hot Stories</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                    </svg>
                </h2>
                <a href="{{ route('client.hot_stories') }}"
                    class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($hot_story as $story)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('client.story', ['slug' => $story->slug]) }}" class="block">
                            <div class="relative aspect-w-2 aspect-h-3">
                                <img src="{{ asset($story->thumbnail) }}" alt="{{ $story->title }}"
                                    class="object-cover w-full h-full" loading="lazy">
                                <div class="absolute top-0 right-0 p-2 flex space-x-1">
                                    @if ($story->status_story == 'Completed')
                                        <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded">Full</span>
                                    @endif
                                    @if ($story->feature == 1)
                                        <span class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded">Hot</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $story->title }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recommended Stories Section -->
    <section id="recommended-stories" class="py-8 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-primary-500">
                <div class="flex items-start gap-3 mb-4">
                    <div class="rounded-full bg-primary-100 dark:bg-primary-900 p-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            @auth
                                Recommended for you
                                <small class="block text-xs font-medium text-gray-600 dark:text-gray-400 mt-1">Based on your reading history</small>
                            @else
                                Recommended Stories
                            @endauth
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Stories that match your interests</p>
                    </div>
                </div>

                @if(!$recommended_stories->isEmpty())
                    <div class="overflow-x-auto pb-2">
                        <div class="flex space-x-4 pl-11">
                            @foreach ($recommended_stories as $story)
                                <div class="flex-shrink-0 w-32 sm:w-36">
                                    <a href="{{ route('client.story', ['slug' => $story->slug]) }}" class="block">
                                        <div class="bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-sm transition-transform duration-300 hover:shadow-md hover:-translate-y-1">
                                            <div class="relative aspect-w-2 aspect-h-3">
                                                <img src="{{ asset($story->thumbnail) }}" alt="{{ $story->title }}" class="object-cover w-full h-full" loading="lazy">
                                                <div class="absolute top-0 right-0 p-1 flex space-x-1">
                                                    @if ($story->status_story == 'Completed')
                                                        <span class="px-1 py-0.5 bg-green-500 text-white text-xs font-semibold rounded">Full</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-2">
                                                <h3 class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $story->title }}</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-4 pl-11">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Read more stories to get personalized recommendations!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- New Stories Column -->
                <div id="latest-stories" class="w-full lg:w-3/4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="border-b-2 border-primary-500 pb-1">Latest Stories</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </h2>
                            <a href="{{ route('client.latest_stories') }}"
                                class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">View
                                All</a>
                        </div>

                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($new_story as $story)
                                <div class="py-4">
                                    <div class="flex items-start">
                                        <div class="flex-grow">
                                            <div class="flex items-center mb-1">
                                                <svg class="w-3 h-3 text-gray-400 dark:text-gray-600 mr-2"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                                <a href="{{ route('client.story', $story->slug) }}"
                                                    class="text-base font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 truncate">
                                                    {{ $story->title }}
                                                </a>

                                                <div class="flex ml-2">
                                                    @if ($story->status_story == "Completed")
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded">Full</span>
                                                    @endif
                                                    @if ($story->feature == 1)
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 ml-1 text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded">Hot</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="hidden md:flex flex-wrap text-xs text-gray-500 dark:text-gray-400 ml-5">
                                                <span class="mr-1">Categories:</span>
                                                @foreach ($story->categories as $index => $category)
                                                    <a href="{{ route('client.category', $category->slug)}}"
                                                        class="hover:text-primary-600 dark:hover:text-primary-400">
                                                        {{ $category->name }}{{ $index < count($story->categories) - 1 ? ',' : '' }}
                                                    </a>
                                                @endforeach
                                            </div>

                                            <div class="ml-5 mt-1">
                                                @if ($story->new_chapter)
                                                    @php $slug_url = "chuong-$story->new_chapter" @endphp
                                                    <a href="{{ route('client.chapter', [$story->slug, $slug_url]) }}"
                                                        class="text-xs text-primary-600 dark:text-primary-400 hover:underline">
                                                        Chapter {{ $story->new_chapter }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Categories Sidebar -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-20">
                        <h2
                            class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                            Story Categories
                        </h2>
                        <ul class="space-y-2">
                            @foreach (get_category() as $category)
                                <li>
                                    <a href="{{ route('client.category', $category->slug) }}"
                                        class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                                        <svg class="w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Completed Stories Section -->
    <section id="completed-stories" class="py-12 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <span class="border-b-2 border-primary-500 pb-1">Completed Stories</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </h2>
                <a href="{{ route('client.completed_stories') }}"
                    class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                @foreach ($end_story as $story)
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-sm transition-transform duration-300 hover:shadow-md hover:-translate-y-1">
                        <a href="{{ route('client.story', $story->slug) }}" class="block">
                            <img src="{{ $story->thumbnail }}" alt="{{ $story->title }}"
                                class="w-full aspect-[2/3] object-cover" loading="lazy">
                            <div class="p-4">
                                <h3 class="font-semibold text-sm text-gray-900 dark:text-white text-center truncate">
                                    {{ $story->title }}
                                </h3>
                                <div class="mt-2 flex justify-center">
                                    <span
                                        class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-medium rounded-full">
                                        Full - {{ $story->new_chapter }} chapters
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Smooth Scroll Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all links with hash
            const links = document.querySelectorAll('a[href*="#"]');

            // For each link
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    // Only prevent default if the link is to an ID on this page
                    const targetId = this.getAttribute('href').split('#')[1];
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        e.preventDefault();

                        // Scroll to the element
                        window.scrollTo({
                            top: targetElement.offsetTop - 100, // Offset for header
                            behavior: 'smooth'
                        });

                        // Update URL without reloading
                        history.pushState(null, null, '#' + targetId);
                    }
                });
            });

            // Check if URL has hash on page load and scroll to it
            if (window.location.hash) {
                const targetId = window.location.hash.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    setTimeout(() => {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }, 300);
                }
            }
        });
    </script>
@endsection