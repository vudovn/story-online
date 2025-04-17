@extends('client.layout')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content Area -->
                <div class="w-full lg:w-3/4">
                    <!-- Category Header -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white inline-block border-b-2 border-primary-500 pb-1">
                            {{ $category->name }}
                        </h1>
                        <p class="mt-3 text-gray-600 dark:text-gray-400">
                            Explore our collection of {{ strtolower($category->name) }} stories. 
                            @if($category->description)
                                {{ $category->description }}
                            @else
                                Find the best {{ strtolower($category->name) }} stories on our platform, from completed works to the latest updates.
                            @endif
                        </p>
                        
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Related Categories: </span>
                            @foreach(get_category()->take(5)->where('id', '!=', $category->id) as $related)
                                <a href="{{ route('client.category', $related->slug) }}" 
                                   class="text-sm px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-gray-700 dark:text-gray-300 hover:bg-primary-100 dark:hover:bg-primary-900 transition duration-200">
                                    {{ $related->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Story Count and Sort Options -->
                    <div class="flex flex-col sm:flex-row justify-between items-center bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-6">
                        <p class="text-gray-700 dark:text-gray-300 mb-3 sm:mb-0">
                            <span class="font-medium">{{ $stories->total() }}</span> stories found
                        </p>
                        
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Sort by:</span>
                            <select class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg px-3 py-1 text-sm border-0 focus:ring-2 focus:ring-primary-500" 
                                    onchange="window.location.href=this.value">
                                <option value="{{ route('client.category', ['slug' => $category->slug]) }}" 
                                        {{ request()->get('sort', 'updated_at') == 'updated_at' ? 'selected' : '' }}>
                                    Latest Update
                                </option>
                                <option value="{{ route('client.category', ['slug' => $category->slug, 'sort' => 'title']) }}"
                                        {{ request()->get('sort') == 'title' ? 'selected' : '' }}>
                                    Title
                                </option>
                                <option value="{{ route('client.category', ['slug' => $category->slug, 'sort' => 'view']) }}"
                                        {{ request()->get('sort') == 'view' ? 'selected' : '' }}>
                                    Most Viewed
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Stories Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($stories as $item)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col h-full">
                                <a href="{{ route('client.story', ['slug' => $item->slug]) }}" class="block flex-grow">
                                    <div class="relative aspect-w-2 aspect-h-3">
                                        <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}"
                                            class="object-cover w-full h-full" loading="lazy">
                                        <div class="absolute top-0 right-0 p-2 flex space-x-1">
                                            @if ($item->status_story == 'Hoàn thành' || $item->status_story == 'Completed')
                                                <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded">Full</span>
                                            @endif
                                            @if ($item->feature == 1)
                                                <span class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded">Hot</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $item->title }}</h3>
                                        @if ($item->author)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">{{ $item->author }}</p>
                                        @endif
                                        
                                        @if ($item->new_chapter)
                                            <div class="mt-2 text-xs text-primary-600 dark:text-primary-400">
                                                <span class="font-medium">Chapter {{ $item->new_chapter }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="mt-2 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>{{ number_format($item->view) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10 flex justify-center">
                        {{ $stories->appends(request()->except('page'))->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/4">
                    <!-- Categories Widget -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-20">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                            Story Categories
                        </h2>
                        <ul class="space-y-2">
                            @foreach (get_category() as $cat)
                                <li>
                                    <a href="{{ route('client.category', $cat->slug) }}" 
                                       class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 {{ $cat->id == $category->id ? 'font-medium text-primary-600 dark:text-primary-400' : '' }}">
                                        <svg class="w-3 h-3 mr-2 {{ $cat->id == $category->id ? 'text-primary-600 dark:text-primary-400' : 'text-gray-400 dark:text-gray-600' }}" 
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                                </div>
                    
                    <!-- Hot Stories in this Category -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mt-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                            Hot in {{ $category->name }}
                        </h2>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($stories->where('feature', 1)->take(5) as $hotStory)
                                <div class="py-3">
                                    <a href="{{ route('client.story', $hotStory->slug) }}" class="flex items-start group">
                                        <img src="{{ asset($hotStory->thumbnail) }}" alt="{{ $hotStory->title }}" 
                                             class="w-12 h-16 object-cover rounded mr-3 group-hover:opacity-90 transition duration-200">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition duration-200">{{ $hotStory->title }}</h3>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $hotStory->status_story == 'Completed' ? 'Completed' : 'Ongoing' }} · {{ number_format($hotStory->view) }} views
                                            </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection