<style>
    /* Ensure search results are visible */
    .search-result {
        position: absolute;
        z-index: 9999 !important;
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        width: 100%;
        max-height: 400px;
        overflow-y: auto;
    }

    .dark .search-result {
        background-color: #1F2937;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .list-group-item_search {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        transition: background-color 0.2s;
    }

    .list-group-item_search:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .dark .list-group-item_search:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
</style>

<header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('client.index') }}" class="flex items-center">
                    <img src="{{ setting()->site_logo }}" alt="Logo" class="h-10 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Categories Dropdown -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                        <span>Categories</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 z-10 mt-1 w-60 origin-top-left rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition ease-out duration-200 hidden group-hover:block">
                        <div class="p-2 max-h-96 overflow-y-auto">
                            @foreach (get_category() as $category)
                                <a href="{{ route('client.category', $category->slug) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Story Types Links -->
                <a href="{{ route('client.hot_stories') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                    Hot Stories
                </a>

                <a href="{{ route('client.latest_stories') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                    Latest Stories
                </a>

                <a href="{{ route('client.completed_stories') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                    Completed Stories
                </a>

                <!-- Search Bar -->
                <div class="relative flex-1 max-w-lg">
                    <form action="{{ route('client.search') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" name="key_word"
                                class="w-full bg-gray-100 dark:bg-gray-700 border-none rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 text-gray-700 dark:text-white placeholder-gray-500"
                                placeholder="Search stories...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <span class="text-sm text-indigo-600 dark:text-indigo-400">Search</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <!-- Sun icon -->
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                    <!-- Moon icon -->
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>

                <!-- User Account Menu -->
                <div class="relative group">
                    @auth
                        <button
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            <span>Account</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 z-10 mt-1 w-48 origin-top-right rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transform opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 transition ease-out duration-200 hidden group-hover:block">
                            <div class="py-1">
                                <a href="{{ route('auth.profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                    Profile
                                </a>
                                <a href="{{ route('auth.password.change') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                    Change Password
                                </a>
                                <form action="{{ route('auth.doLogout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('auth.login') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            Login / Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" id="mobile-menu-button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white rounded-md p-2">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div id="mobile-menu" class="md:hidden hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Mobile Search -->
            <div class="px-4 py-2">
                <form action="{{ route('client.search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="key_word"
                            class="w-full bg-gray-100 dark:bg-gray-700 border-none rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 text-gray-700 dark:text-white placeholder-gray-500"
                            placeholder="Search stories...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span class="text-sm text-indigo-600 dark:text-indigo-400">Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mobile Dark Mode Toggle -->
            <div class="px-4 py-2 flex items-center">
                <span class="text-sm text-gray-700 dark:text-gray-300 mr-2">Dark Mode</span>
                <button id="mobile-theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <!-- Sun icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Story Types Links -->
            <div class="px-4 py-2 space-y-2">
                <a href="{{ route('client.hot_stories') }}"
                    class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-orange-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                            clip-rule="evenodd" />
                    </svg>
                    Hot Stories
                </a>

                <a href="{{ route('client.latest_stories') }}"
                    class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                    Latest Stories
                </a>

                <a href="{{ route('client.completed_stories') }}"
                    class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Completed Stories
                </a>
            </div>

            <!-- Mobile Account Links -->
            <div class="px-4 py-2">
                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Account</div>
                <div class="space-y-2 pl-2">
                    @auth
                        <a href="{{ route('auth.profile') }}"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Profile
                        </a>
                        <a href="{{ route('auth.password.change') }}"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Change Password
                        </a>
                        <form action="{{ route('auth.doLogout') }}" method="POST"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            @csrf
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-5-5H3zm2 3a1 1 0 00-1 1v10h10v-5h-5V6H5z"
                                    clip-rule="evenodd" />
                            </svg>
                            <button type="submit" class="inline-block text-left">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('auth.login') }}"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>
                            Login
                        </a>
                        <a href="{{ route('auth.register') }}"
                            class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Categories -->
            <div class="px-4 py-2">
                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Categories</div>
                <div class="space-y-1 pl-2 max-h-60 overflow-y-auto">
                    @foreach (get_category() as $category)
                        <a href="{{ route('client.category', $category->slug) }}"
                            class="block py-1 text-sm text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Page announcement bar -->
<div class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white py-2">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm font-medium">Read stories online, read text stories, full stories, best stories.
            Complete collection and continuously updated.</p>
    </div>
</div>

<script>
    // Handle dark mode toggle
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    const themeToggleBtn = document.getElementById('theme-toggle');
    const mobileThemeToggleBtn = document.getElementById('mobile-theme-toggle');

    function toggleTheme() {
        // Toggle theme
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
            themeToggleDarkIcon.classList.add('hidden');
            themeToggleLightIcon.classList.remove('hidden');
        }
    }

    themeToggleBtn.addEventListener('click', toggleTheme);
    mobileThemeToggleBtn.addEventListener('click', toggleTheme);

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', !isHidden);
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (event) => {
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Search functionality
    document.addEventListener('DOMContentLoaded', function () {
        const searchInputs = document.querySelectorAll('input[name="key_word"]');
        const searchResults = document.querySelectorAll('.search-result');

        // Debug information
        console.log('Search inputs found:', searchInputs.length);
        console.log('Search result containers found:', searchResults.length);

        searchInputs.forEach((input, index) => {
            input.addEventListener('input', function () {
                const keyword = this.value.trim();
                console.log('Search keyword:', keyword);

                if (keyword.length < 2) {
                    if (searchResults[index]) {
                        searchResults[index].classList.add('hidden');
                    }
                    return;
                }

                // Find the closest search result container
                const resultContainer = input.closest('form').querySelector('.search-result');
                console.log('Result container found:', resultContainer ? true : false);

                if (!resultContainer) return;

                // Use the correct URL and payload structure
                fetch(`${window.WebTruyen.urlSearch}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': window.WebTruyen.csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        key_word: keyword
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Search results:', data);

                        if (data.status && data.stories) {
                            const resultList = resultContainer.querySelector('ul');
                            if (resultList) {
                                resultList.innerHTML = '';

                                if (data.stories.length > 0) {
                                    data.stories.forEach(story => {
                                        const li = document.createElement('li');
                                        li.className = 'list-group-item list-group-item_search px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2';

                                        const storyUrl = story.url || `/doc-truyen/${story.slug}`;
                                        li.innerHTML = `
                                        <img src="${story.thumbnail}" alt="" class="rounded" width="40" height="40">
                                        <a href="${storyUrl}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400">
                                            <div class="flex flex-col">
                                                <span class="font-medium">${story.title}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">${story.author || ''}</span>
                                            </div>
                                        </a>
                                    `;

                                        resultList.appendChild(li);
                                    });

                                    // Make sure to show the results
                                    resultContainer.classList.remove('hidden');
                                    // Force display style to block
                                    resultContainer.style.display = 'block';
                                    console.log('Showing search results');
                                } else {
                                    const li = document.createElement('li');
                                    li.className = 'list-group-item px-4 py-2 text-center text-gray-500 dark:text-gray-400';
                                    li.textContent = 'Không tìm thấy truyện nào';
                                    resultList.appendChild(li);
                                    resultContainer.classList.remove('hidden');
                                    // Force display style to block
                                    resultContainer.style.display = 'block';
                                }
                            }
                        } else if (resultContainer) {
                            resultContainer.classList.add('hidden');
                            resultContainer.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        if (resultContainer) {
                            resultContainer.classList.add('hidden');
                            resultContainer.style.display = 'none';
                        }
                    });
            });

            // Hide search results when clicking outside
            document.addEventListener('click', (event) => {
                const searchContainers = document.querySelectorAll('.search-result');
                searchContainers.forEach(container => {
                    if (container &&
                        !event.target.closest('input[name="key_word"]') &&
                        !container.contains(event.target)) {
                        container.classList.add('hidden');
                        container.style.display = 'none';
                    }
                });
            });
        });
    });
</script>