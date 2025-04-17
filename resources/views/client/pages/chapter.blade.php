@extends('client.layout')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <!-- Story and Chapter Title -->
            <div class="text-center mb-8">
                <a href="{{ route('client.story', $chapter->story->slug) }}" class="">
                    <h1 class="text-2xl md:text-3xl font-bold text-primary-600 dark:text-primary-400 mb-2">
                        {{ $chapter->story->title }}
                    </h1>
                </a>
                <a href="{{ route('client.chapter', [$chapter->story->slug, "chuong-$chapter->index"]) }}"
                    class="">
                    <p class="text-lg text-gray-800 dark:text-gray-200">Chapter {{ $chapter->index }}: {{ $chapter->title }}
                    </p>
                </a>
            </div>

            <!-- Top Navigation -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-3">
                    @if ($previous_chapter)
                                    @php
                                        $slug_previous_chapter = 'chuong-' . $previous_chapter->index ?? $chapter->index;
                                    @endphp
                                    <a href="{{ route('client.chapter', [$chapter->story->slug, $slug_previous_chapter]) }}"
                                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                            Previous
                                        </span>
                                    </a>
                    @endif

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Chapter List
                            </span>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute z-10 mt-2 w-64 md:w-80 max-h-96 overflow-y-auto bg-white dark:bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="py-1">
                                @foreach ($chapters as $item)
                                                            @php
                                                                $slug_url_chapter = 'chuong-' . $item->index;
                                                            @endphp
                                                            <a href="{{ route('client.chapter', [$item->story->slug, $slug_url_chapter]) }}"
                                                                class="block px-4 py-2 text-sm {{ $chapter->id == $item->id ? 'bg-primary-100 dark:bg-primary-900 text-primary-900 dark:text-primary-100' : 'text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                                                Chapter {{ $item->index }}: {{ $item->title }}
                                                            </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if ($next_chapter)
                                    @php
                                        $slug_next_chapter = 'chuong-' . $next_chapter->index ?? $chapter->index;
                                    @endphp
                                    <a href="{{ route('client.chapter', [$chapter->story->slug, $slug_next_chapter]) }}"
                                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <span class="flex items-center">
                                            Next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </a>
                    @endif
                </div>
            </div>

            <!-- Chapter Content -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 md:p-8 mb-8">
                <div id="chapter-content" class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                    {!! $chapter->content !!}
                </div>
            </div>

            <!-- Keyboard Navigation Tip -->
            <div class="mb-8 text-center">
                <div
                    class="px-4 py-3 bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-md hidden md:block">
                    <p class="text-sm font-medium">You can use arrow keys (← →) to navigate between chapters</p>
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class="mb-12">
                <div class="flex items-center justify-center space-x-3">
                    @if ($previous_chapter)
                                    @php
                                        $slug_previous_chapter = 'chuong-' . $previous_chapter->index ?? $chapter->index;
                                    @endphp
                                    <a href="{{ route('client.chapter', [$chapter->story->slug, $slug_previous_chapter]) }}"
                                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                            Previous
                                        </span>
                                    </a>
                    @endif

                    <a href="{{ route('client.story', $chapter->story->slug) }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            Story Info
                        </span>
                    </a>

                    @if ($next_chapter)
                                    @php
                                        $slug_next_chapter = 'chuong-' . $next_chapter->index ?? $chapter->index;
                                    @endphp
                                    <a href="{{ route('client.chapter', [$chapter->story->slug, $slug_next_chapter]) }}"
                                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <span class="flex items-center">
                                            Next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </a>
                    @endif
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>

    <!-- Reading Settings Button -->
    <div class="fixed bottom-20 right-6 z-10">
        <button type="button" id="settingsButton"
            class="p-3 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>

    <!-- Reading Settings Panel -->
    <div style="
                                z-index: 100;
                            " id="settingsPanel"
        class="fixed inset-y-0 right-0 w-80 bg-white dark:bg-gray-800 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-20">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Reading Settings</h3>
                <button id="closeSettings"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-6">
                <!-- Font Family -->
                <div>
                    <label for="font-family" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Font
                        Family</label>
                    <select id="font-family"
                        class="w-full p-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="'Palatino Linotype', serif" style="font-family: 'Palatino Linotype', serif;">Palatino Linotype</option>
                        <option value="Bookerly, serif" style="font-family: 'Bookerly', serif;">Bookerly</option>
                        <option value="Minion, serif" style="font-family: 'Minion', serif;">Minion</option>
                        <option value="'Segoe UI', sans-serif" style="font-family: 'Segoe UI', sans-serif;">Segoe UI</option>
                        <option value="Roboto, sans-serif" style="font-family: 'Roboto', sans-serif;">Roboto</option>
                        <option value="'Roboto Condensed', sans-serif" style="font-family: 'Roboto Condensed', sans-serif;">Roboto Condensed</option>
                        <option value="'Patrick Hand', sans-serif" style="font-family: 'Patrick Hand', sans-serif;">Patrick Hand</option>
                        <option value="'Noticia Text', sans-serif" style="font-family: 'Noticia Text', sans-serif;">Noticia Text</option>
                        <option value="'Times New Roman', serif" style="font-family: 'Times New Roman', serif;">Times New Roman</option>
                        <option value="Verdana, sans-serif" style="font-family: 'Verdana', sans-serif;">Verdana</option>
                        <option value="Tahoma, sans-serif" style="font-family: 'Tahoma', sans-serif;">Tahoma</option>
                        <option value="Arial, sans-serif" style="font-family: 'Arial', sans-serif;">Arial</option>
                    </select>
                </div>

                <!-- Font Size -->
                <div>
                    <label for="font-size" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Font
                        Size: <span id="font-size-value">16px</span></label>
                    <input type="range" id="font-size" min="10" max="30" value="16"
                        class="w-full h-2 bg-gray-300 dark:bg-gray-600 rounded-lg appearance-none cursor-pointer">
                </div>

                <!-- Line Height -->
                <div>
                    <label for="line-height" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Line
                        Height: <span id="line-height-value">1.6</span></label>
                    <input type="range" id="line-height" min="1" max="3" step="0.1" value="1.6"
                        class="w-full h-2 bg-gray-300 dark:bg-gray-600 rounded-lg appearance-none cursor-pointer">
                </div>
            </div>
        </div>
    </div>
@endsection