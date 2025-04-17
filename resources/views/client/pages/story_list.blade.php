@extends('client.layout')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-900 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Title -->
            <div class="mb-8">
                <h1
                    class="text-3xl font-bold text-gray-900 dark:text-white inline-block border-b-2 border-primary-500 pb-1">
                    {{ $title }}
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Browse through our collection of {{ strtolower($title) }}
                </p>
            </div>

            <!-- Stories Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                @foreach ($stories as $story)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('client.story', ['slug' => $story->slug]) }}" class="block">
                            <div class="relative aspect-w-2 aspect-h-3">
                                <img src="{{ asset($story->thumbnail) }}" alt="{{ $story->title }}"
                                    class="object-cover w-full h-full" loading="lazy">
                                <div class="absolute top-0 right-0 p-2 flex space-x-1">
                                    @if ($story->status_story == 'Hoàn thành' || $story->status_story == 'Completed')
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
                                @if ($story->author)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">{{ $story->author }}</p>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination - If stories are paginated -->
            @if (method_exists($stories, 'links') && $stories instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-10 flex justify-center">
                    {{ $stories->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
@endsection