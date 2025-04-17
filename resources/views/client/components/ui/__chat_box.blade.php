<div class="fixed bottom-4 right-4 z-50" id="chat-bubble">
  <button
    class="flex items-center justify-center w-14 h-14 rounded-full bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
    </svg>
  </button>
</div>

<div
  class="fixed bottom-4 right-4 z-50 w-80 md:w-96 h-[32rem] flex flex-col bg-white dark:bg-gray-800 rounded-lg shadow-2xl overflow-hidden transition-all duration-300 transform opacity-0 scale-95 hidden dark:text-gray-100"
  id="chat-wrapper">
  <div class="flex items-center justify-between px-4 py-3 bg-indigo-600 dark:bg-indigo-700 text-white" id="chat-header">
    <h2 class="text-lg font-semibold">Novel Assistant</h2>
    <div class="flex space-x-2">
      <button id="toggle-size"
        class="flex items-center justify-center w-7 h-7 text-white hover:bg-indigo-700 dark:hover:bg-indigo-800 rounded transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"></path>
        </svg>
      </button>
      <button id="toggle-theme"
        class="flex items-center justify-center w-7 h-7 text-white hover:bg-indigo-700 dark:hover:bg-indigo-800 rounded transition-colors">
        <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="hidden dark:block">
          <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
        </svg>
        <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="block dark:hidden">
          <circle cx="12" cy="12" r="4"></circle>
          <path d="M12 2v2"></path>
          <path d="M12 20v2"></path>
          <path d="M4.93 4.93l1.41 1.41"></path>
          <path d="M17.66 17.66l1.41 1.41"></path>
          <path d="M2 12h2"></path>
          <path d="M20 12h2"></path>
          <path d="M6.34 17.66l-1.41 1.41"></path>
          <path d="M19.07 4.93l-1.41 1.41"></path>
        </svg>
      </button>
      <button
        class="flex items-center justify-center w-7 h-7 text-white hover:bg-indigo-700 dark:hover:bg-indigo-800 rounded transition-colors"
        id="toggle-chat">−</button>
    </div>
  </div>

  <textarea id="system-instruction" class="hidden">
You are an intelligent assistant for a novel website, with direct access to the novel database. Your responsibilities:

1. Read and understand API endpoints:
   - get_all_story: Get list of stories
   - get_story: Get story details
   - get_completed_story: Get list of completed stories
   - get_hot_story: Get list of hot stories
   - get_all_category: Get list of categories
   - get_category: Get category details
   - get_search: Search for stories when users ask if a specific story exists, just get the name

2. Wait for user questions:
   - Don't automatically respond or suggest
   - Only respond when asked
   - Use data from API to answer accurately

3. When you receive a question:
   - Analyze the question to determine which API to call
   - Call the corresponding API to get data
   - Answer based on actual data from the API
   - Do not make assumptions or add information not in the API

4. Response:
   - Accurate, friendly, with Gen Z personality
   - NEVER mention that you are calling an API in your response. NEVER mention API names like "get_all_category", "get_story" or any endpoint
   - NEVER write things like "let me check the api", "calling API", "clicking this or that button"
   - Simply respond immediately with information from the API without mentioning that you're retrieving data
   - Keep answers concise, to the point, and focused on the information the user needs
   - Speak in Gen Z style but don't overdo it

5. IMPORTANT - URL formatting:
   - When listing categories or stories, MUST include the full URL from the API
   - List format: "• **Category/Story name**: http://full-url"
   - NEVER use placeholders like [URL_TEEN_NOVEL] or [URL]
   - ALWAYS use the full URL from the API, don't create or omit it
   - If displaying a list, each item MUST have the full URL from the API
   - URLs must be displayed exactly as they come from the API, without modification or shortening

6. Consistent category lists:
   - NEVER create category names not in the API data
   - Always display the exact category name in format: "• **Urban**: http://real-url" (don't add "Novel" before category name)
   - When user asks about "categories" or "novel categories", return the exact list from the API
   - MUST USE EXACT category names from the API, without additions or changes

Note:
- Only respond when asked
- Don't automatically suggest or recommend
- Use real data from API
- Don't add information not in the API
- ALWAYS display full URL for each item when listing
  </textarea>

  <div id="chat-container" class="flex-1 p-3 overflow-y-auto bg-gray-50 dark:bg-gray-900 space-y-3 scroll-smooth"></div>

  <div class="flex items-center p-3 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
    <input type="text" id="user-input" placeholder="Ask about novels you're interested in..."
      class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 dark:text-white dark:placeholder-gray-400" />
    <button id="send-button"
      class="px-4 py-2 bg-indigo-600 dark:bg-indigo-700 text-white rounded-r-md hover:bg-indigo-700 dark:hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m22 2-7 20-4-9-9-4Z"></path>
        <path d="M22 2 11 13"></path>
      </svg>
    </button>
  </div>
</div>

<script type="importmap">
    {
      "imports": {
        "@google/generative-ai": "https://esm.run/@google/generative-ai"
      }
    }
</script>



<script type="module">
  import { GoogleGenerativeAI } from "@google/generative-ai";

  const API_KEY = "{{ setting()->api_key ?? 'AIzaSyDZm040UpmEZGSfbN_dkpto_NKHl3csHH8' }}";
  const genAI = new GoogleGenerativeAI(API_KEY);
  const model = genAI.getGenerativeModel({
    model: "gemini-1.5-pro",
    generationConfig: {
      temperature: 0.7,
      topP: 0.9,
      topK: 40,
      maxOutputTokens: 8192,
    }
  });

  // Chat elements
  const chatContainer = document.getElementById("chat-container");
  const userInput = document.getElementById("user-input");
  const sendButton = document.getElementById("send-button");
  const systemInstructionInput = document.getElementById("system-instruction");

  // Chat box UI elements
  const chatWrapper = document.getElementById("chat-wrapper");
  const chatBubble = document.getElementById("chat-bubble");
  const toggleChat = document.getElementById("toggle-chat");
  const chatHeader = document.getElementById("chat-header");
  const toggleTheme = document.getElementById("toggle-theme");
  const toggleSize = document.getElementById("toggle-size");

  let chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
  let userPreferences = JSON.parse(localStorage.getItem('userPreferences') || '{}');
  let isChatOpen = true;
  let isExpanded = false;

  // Kiểm tra theme từ localStorage (đồng bộ với theme chính của trang web)
  const checkDarkMode = () => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  };

  // Khởi tạo theme khi load trang
  checkDarkMode();

  // Đồng bộ dark mode với trang chính
  toggleTheme.addEventListener("click", function () {
    if (localStorage.theme === 'dark') {
      localStorage.theme = 'light';
      document.documentElement.classList.remove('dark');
    } else {
      localStorage.theme = 'dark';
      document.documentElement.classList.add('dark');
    }
  });

  // Size toggle
  toggleSize.addEventListener("click", function () {
    isExpanded = !isExpanded;
    if (isExpanded) {
      chatWrapper.classList.add('expanded');
    } else {
      chatWrapper.classList.remove('expanded');
    }

    // Save in user preferences
    userPreferences.expanded = isExpanded;
    localStorage.setItem('userPreferences', JSON.stringify(userPreferences));
  });

  const SAFETY_SETTINGS = [
    { category: "HARM_CATEGORY_HARASSMENT", threshold: "BLOCK_NONE" },
    { category: "HARM_CATEGORY_HATE_SPEECH", threshold: "BLOCK_NONE" },
    { category: "HARM_CATEGORY_SEXUALLY_EXPLICIT", threshold: "BLOCK_NONE" },
    { category: "HARM_CATEGORY_DANGEROUS_CONTENT", threshold: "BLOCK_NONE" },
  ];

  const API_ENDPOINTS = {
    get_all_story: "{{ route('client.get_story') }}",
    get_story: "{{ route('client.get_story_by_slug', ['slug' => '__SLUG__']) }}".replace('__SLUG__', '{slug}'),
    get_completed_story: "{{ route('client.get_completed_story') }}",
    get_hot_story: "{{ route('client.get_hot_story') }}",
    get_all_category: "{{ route('client.get_category') }}",
    get_category: "{{ route('client.get_category_by_slug', ['slug' => '__SLUG__']) }}".replace('__SLUG__', '{slug}'),
    get_search: "{{ route('client.get_search') }}?keyword=",
  };

  const apiCache = new Map();
  const CACHE_DURATION = 1000 * 60 * 30; // 30 minutes

  // Chat toggle functionality
  toggleChat.addEventListener("click", toggleChatBox);

  // Direct chat bubble click handler instead of using toggleChatBox
  chatBubble.addEventListener("click", function () {
    // When clicking the chat bubble, always open the chat
    isChatOpen = true;
    chatWrapper.classList.remove('opacity-0', 'scale-95', 'hidden');
    chatWrapper.classList.add('opacity-100', 'scale-100');
    toggleChat.textContent = '−';
    chatBubble.classList.add('hidden');

    // If this is the first opening (no chat history), trigger AI introduction
    if (chatHistory.length === 0) {
      setTimeout(() => {
        sendAIIntroduction();
      }, 500);
    }

    // Save state
    localStorage.setItem('chatUIState', JSON.stringify({
      isChatOpen
    }));
  });

  chatHeader.addEventListener("click", function (e) {
    // Only toggle if clicking the header itself, not the buttons within it
    if (e.target === chatHeader || e.target.tagName === 'H2') {
      toggleChatBox();
    }
  });

  // Core chat functionality
  sendButton.addEventListener("click", handleSendMessage);
  userInput.addEventListener("keypress", (e) => e.key === "Enter" && handleSendMessage());

  // Initialize chat UI
  function initChatUI() {
    // Default to showing chat bubble and hiding chat window
    isChatOpen = false;
    chatWrapper.classList.add('opacity-0', 'scale-95', 'hidden');
    toggleChat.textContent = '+';
    chatBubble.classList.remove('hidden');

    // Apply saved preferences
    if (userPreferences.expanded) {
      isExpanded = true;
      chatWrapper.classList.add('expanded');
    }

    const savedState = localStorage.getItem('chatUIState');
    if (savedState) {
      const state = JSON.parse(savedState);
      isChatOpen = state.isChatOpen;

      // Apply saved state
      if (isChatOpen) {
        chatWrapper.classList.remove('opacity-0', 'scale-95', 'hidden');
        chatWrapper.classList.add('opacity-100', 'scale-100');
        toggleChat.textContent = '−';
        chatBubble.classList.add('hidden');
      }
    }

    // Load chat history if available
    if (chatHistory.length > 0) {
      chatHistory.forEach(entry => {
        if (entry.role === 'user') {
          appendMessage('user', entry.parts[0].text);
        } else if (entry.role === 'model') {
          appendMessage('bot', entry.parts[0].text);
        }
      });
      // Scroll to bottom
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Save state
    localStorage.setItem('chatUIState', JSON.stringify({
      isChatOpen
    }));
  }

  function toggleChatBox() {
    isChatOpen = !isChatOpen;

    if (isChatOpen) {
      chatWrapper.classList.remove('opacity-0', 'scale-95', 'hidden');
      chatWrapper.classList.add('opacity-100', 'scale-100');
      toggleChat.textContent = '−';
      chatBubble.classList.add('hidden');

      // If this is the first opening (no chat history), trigger AI introduction
      if (chatHistory.length === 0) {
        // Add small delay to make it feel more natural
        setTimeout(() => {
          sendAIIntroduction();
        }, 500);
      }
    } else {
      chatWrapper.classList.remove('opacity-100', 'scale-100');
      chatWrapper.classList.add('opacity-0', 'scale-95');
      // Use setTimeout to allow animation to complete before hiding
      setTimeout(() => {
        chatWrapper.classList.add('hidden');
      }, 300);
      toggleChat.textContent = '+';
      chatBubble.classList.remove('hidden');
    }

    // Save state
    localStorage.setItem('chatUIState', JSON.stringify({
      isChatOpen
    }));
  }

  async function sendAIIntroduction() {
    const introMessage = "Hello! I'm your novel assistant. I can help you find novels by category, search for specific stories, or suggest hot/completed novels. How can I help you today?";
    appendMessage("bot", introMessage);
    updateChatHistory("model", introMessage);
  }

  async function handleSendMessage() {
    const userMessage = userInput.value.trim();
    if (!userMessage) return;

    appendMessage("user", userMessage);
    userInput.value = "";

    // Make sure chat is open when sending a message
    if (!isChatOpen) {
      isChatOpen = true;
      chatWrapper.classList.remove('opacity-0', 'scale-95', 'hidden');
      chatWrapper.classList.add('opacity-100', 'scale-100');
      toggleChat.textContent = '−';
      chatBubble.classList.add('hidden');

      localStorage.setItem('chatUIState', JSON.stringify({
        isChatOpen
      }));
    }

    // Show typing indicator
    const typingIndicator = document.createElement("div");
    typingIndicator.className = "typing-indicator";
    typingIndicator.innerHTML = "<span></span><span></span><span></span>";
    chatContainer.appendChild(typingIndicator);
    chatContainer.scrollTop = chatContainer.scrollHeight;

    let response;
    try {
      response = await sendTextMessage(userMessage);
      // Remove typing indicator before showing response
      typingIndicator.remove();
      appendMessage("bot", response);
    } catch (error) {
      console.error("Error:", error);
      // Remove typing indicator in case of error
      typingIndicator.remove();
      appendMessage("bot", `Oops! An error occurred: ${error.message}. Please try again!`);
    }
  }

  async function getCategories() {
    try {
      console.log("Starting category fetch from:", API_ENDPOINTS.get_all_category);
      const response = await fetchWithCache(API_ENDPOINTS.get_all_category);
      console.log("Full API response for categories:", JSON.stringify(response).substring(0, 1000));

      if (!response.status || !response.data) {
        console.error("Invalid response structure:", response);
        throw new Error("Error retrieving category list - Invalid response structure");
      }

      if (!Array.isArray(response.data) || response.data.length === 0) {
        console.error("Empty or invalid data array:", response.data);
        throw new Error("Error retrieving category list - Empty data array");
      }

      const categories = response.data.map(c => ({
        id: c.id,
        name: c.title,
        slug: c.url.split('/').pop(),
        url: c.url
      }));

      console.log("Processed categories:", JSON.stringify(categories));
      return categories;
    } catch (error) {
      console.error('Error fetching categories:', error);
      // Return some fallback categories for testing if API fails
      if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        console.log("Using fallback categories for local development");
        return [
          { id: 1, name: "Urban", slug: "do-thi", url: "http://127.0.0.1:8000/category/do-thi" },
          { id: 2, name: "Fantasy", slug: "huyen-huyen", url: "http://127.0.0.1:8000/category/huyen-huyen" },
          { id: 3, name: "Martial Arts", slug: "vo-hiep", url: "http://127.0.0.1:8000/category/vo-hiep" }
        ];
      }
      return [];
    }
  }

  async function getCategoryDetail(slug) {
    try {
      const url = API_ENDPOINTS.get_category.replace('{slug}', slug);
      const response = await fetchWithCache(url);
      if (!response.status || !response.data) throw new Error("Error retrieving category details");
      return {
        name: response.data.title,
        items: response.data.stories.map(story => ({
          id: story.id,
          name: story.title,
          categories: story.categories,
          url: story.url
        }))
      };
    } catch (error) {
      console.error('Error fetching category detail:', error);
      return null;
    }
  }

  async function searchNovels(keyword) {
    try {
      const url = `${API_ENDPOINTS.get_search}${encodeURIComponent(keyword)}`;
      console.log("Searching novels from:", url);

      const response = await fetchWithCache(url);
      if (!response.status || !response.data) {
        console.error("Invalid search response:", response);
        throw new Error("Error searching for novels");
      }

      return response.data.map(item => {
        const slug = item.url.split('/').pop();
        return {
          id: item.id,
          name: item.title,
          slug: slug, // Save slug separately
          categories: item.categories || [],
          url: item.url
        };
      });
    } catch (error) {
      console.error('Error searching novels:', error);
      return [];
    }
  }

  async function getNovelDetail(slug) {
    try {
      // Xử lý cả hai loại URL: http và https
      if (slug.includes('http://') || slug.includes('https://')) {
        // Trích xuất slug từ URL đầy đủ
        slug = slug.split('/').pop();
      }

      const url = API_ENDPOINTS.get_story.replace('{slug}', slug);
      console.log("Fetching novel detail from:", url);

      const response = await fetchWithCache(url);
      if (!response.status || !response.data) {
        console.error("Invalid response:", response);
        throw new Error("Error retrieving novel details");
      }

      return {
        id: response.data.id,
        name: response.data.title,
        content: response.data.description,
        status: response.data.status_story,
        categories: response.data.categories,
        chapters: response.data.chappters || [],
        url: response.data.url
      };
    } catch (error) {
      console.error('Error fetching novel detail:', error);
      return null;
    }
  }

  function detectIntent(message) {
    const msg = message.toLowerCase().trim();
    console.log("Detecting intent for message:", msg);
    const sentiment = analyzeSentiment(msg);

    // Cải thiện regex để xử lý URL với cả http và https
    const urlPattern = /(https?:\/\/[^\s]+)/gi;

    // en
    if (/^(list |show |all )?(categories|genres|category|genre)( of novels| of stories)?$/i.test(msg)) {
      console.log("Detected intent: list_categories");
      return { type: 'list_categories', sentiment };
    }
    if (/category details\s+(.+)/i.test(msg)) {
      console.log("Detected intent: category_detail", msg.match(/category details\s+(.+)/i)[1].trim());
      return { type: 'category_detail', sentiment, category: msg.match(/category details\s+(.+)/i)[1].trim() };
    }
    if (/genre details\s+(.+)/i.test(msg)) {
      console.log("Detected intent: category_detail", msg.match(/genre details\s+(.+)/i)[1].trim());
      return { type: 'category_detail', sentiment, category: msg.match(/genre details\s+(.+)/i)[1].trim() };
    }
    if (/^search( for)?\s+(.+)/i.test(msg)) {
      console.log("Detected intent: search", msg.match(/^search( for)?\s+(.+)/i)[2].trim());
      return { type: 'search', sentiment, keyword: msg.match(/^search( for)?\s+(.+)/i)[2].trim() };
    }
    if (/^find\s+(.+)/i.test(msg)) {
      console.log("Detected intent: search", msg.match(/^find\s+(.+)/i)[1].trim());
      return { type: 'search', sentiment, keyword: msg.match(/^find\s+(.+)/i)[1].trim() };
    }
    if (/^details( for| about)?\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^details( for| about)?\s+(.+)/i)[2].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^details( for| about)?\s+(.+)/i)[2].trim() };
    }
    if (/^novel details\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^novel details\s+(.+)/i)[1].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^novel details\s+(.+)/i)[1].trim() };
    }

    if (/^i want to read\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^i want to read\s+(.+)/i)[1].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^i want to read\s+(.+)/i)[1].trim() };
    }

    if (/recommend|suggest(\s+novels|\s+stories)?/i.test(msg)) {
      console.log("Detected intent: recommend_novel");
      return { type: 'recommend_novel', sentiment };
    }
    if (/new|hot|trending(\s+novels|\s+stories)?/i.test(msg)) {
      console.log("Detected intent: trending_novels");
      return { type: 'trending_novels', sentiment };
    }
    if (/completed(\s+novels|\s+stories)?/i.test(msg)) {
      console.log("Detected intent: completed_novels");
      return { type: 'completed_novels', sentiment };
    }
    if (/do you have\s+(novel|manga|story)\s+(.+)(\?)?/i.test(msg)) {
      console.log("Detected intent: check_existence", msg.match(/do you have\s+(novel|manga|story)\s+(.+?)(\?)?$/i)[2].trim());
      return {
        type: 'check_existence',
        sentiment,
        novel: msg.match(/do you have\s+(novel|manga|story)\s+(.+?)(\?)?$/i)[2].trim()
      };
    }
    if (/is there( a)?\s+(.+)(\?)?/i.test(msg)) {
      console.log("Detected intent: check_existence", msg.match(/is there( a)?\s+(.+?)(\?)?$/i)[2].trim());
      return {
        type: 'check_existence',
        sentiment,
        novel: msg.match(/is there( a)?\s+(.+?)(\?)?$/i)[2].trim()
      };
    }
    // vi
    if (/^(danh sách |các |liệt kê |cho.*(xem|biết) )?(thể loại|danh mục)( truyện)?$/i.test(msg)) {
      console.log("Detected intent: list_categories");
      return { type: 'list_categories', sentiment };
    }
    if (/chi tiết thể loại\s+(.+)/i.test(msg)) {
      console.log("Detected intent: category_detail", msg.match(/chi tiết thể loại\s+(.+)/i)[1].trim());
      return { type: 'category_detail', sentiment, category: msg.match(/chi tiết thể loại\s+(.+)/i)[1].trim() };
    }
    if (/chi tiết danh mục\s+(.+)/i.test(msg)) {
      console.log("Detected intent: category_detail", msg.match(/chi tiết danh mục\s+(.+)/i)[1].trim());
      return { type: 'category_detail', sentiment, category: msg.match(/chi tiết danh mục\s+(.+)/i)[1].trim() };
    }
    if (/^tìm bộ\s+(.+)/i.test(msg)) {
      console.log("Detected intent: search", msg.match(/^tìm bộ\s+(.+)/i)[1].trim());
      return { type: 'search', sentiment, keyword: msg.match(/^tìm bộ\s+(.+)/i)[1].trim() };
    }
    if (/^tìm truyện\s+(.+)/i.test(msg)) {
      console.log("Detected intent: search", msg.match(/^tìm truyện\s+(.+)/i)[1].trim());
      return { type: 'search', sentiment, keyword: msg.match(/^tìm truyện\s+(.+)/i)[1].trim() };
    }
    if (/^chi tiết bộ\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^chi tiết bộ\s+(.+)/i)[1].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^chi tiết bộ\s+(.+)/i)[1].trim() };
    }
    if (/^chi tiết truyện\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^chi tiết truyện\s+(.+)/i)[1].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^chi tiết truyện\s+(.+)/i)[1].trim() };
    }
    if (/^tôi muốn đọc truyện\s+(.+)/i.test(msg)) {
      console.log("Detected intent: novel_detail", msg.match(/^tôi muốn đọc truyện\s+(.+)/i)[1].trim());
      return { type: 'novel_detail', sentiment, keyword: msg.match(/^tôi muốn đọc truyện\s+(.+)/i)[1].trim() };
    }
    if (/gợi ý|giới thiệu\s+truyện/i.test(msg)) {
      console.log("Detected intent: recommend_novel");
      return { type: 'recommend_novel', sentiment };
    }
    if (/truyện mới|hot|xu hướng/i.test(msg)) {
      console.log("Detected intent: trending_novels");
      return { type: 'trending_novels', sentiment };
    }
    if (/truyện đã hoàn thành/i.test(msg)) {
      console.log("Detected intent: completed_novels");
      return { type: 'completed_novels', sentiment };
    }
    if (/có\s+(truyện|manga|truyện tranh)\s+(.+)\s+không/i.test(msg)) {
      console.log("Detected intent: check_existence", msg.match(/có\s+(truyện|manga|truyện tranh)\s+(.+)\s+không/i)[2].trim());
      return {
        type: 'check_existence',
        sentiment,
        novel: msg.match(/có\s+(truyện|manga|truyện tranh)\s+(.+)\s+không/i)[2].trim()
      };
    }
    if (/có\s+(.+)\s+không/i.test(msg)) {
      console.log("Detected intent: check_existence", msg.match(/có\s+(.+)\s+không/i)[1].trim());
      return {
        type: 'check_existence',
        sentiment,
        novel: msg.match(/có\s+(.+)\s+không/i)[1].trim()
      };
    }


    console.log("Detected intent: chat_general");
    return { type: 'chat_general', sentiment };
  }

  function analyzeSentiment(message) {
    const positiveWords = ['like', 'good', 'great', 'awesome', 'beautiful', 'satisfied'];
    const negativeWords = ['dislike', 'bad', 'terrible', 'boring', 'ugly', 'disappointed'];

    let score = 0;
    positiveWords.forEach(word => {
      if (message.includes(word)) score += 1;
    });
    negativeWords.forEach(word => {
      if (message.includes(word)) score -= 1;
    });

    return score > 0 ? 'positive' : score < 0 ? 'negative' : 'neutral';
  }

  async function fetchWithCache(url) {
    const cached = apiCache.get(url);
    if (cached && Date.now() - cached.timestamp < CACHE_DURATION) {
      console.log("Using cached data for:", url);
      console.log("Cached data content:", JSON.stringify(cached.data).substring(0, 500) + "...");
      return cached.data;
    }

    try {
      console.log("Fetching data from:", url);
      const response = await fetch(url);

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();

      if (!data || (data.status === false)) {
        console.error("API returned error status:", data);
        throw new Error(data.message || "API trả về lỗi không xác định");
      }

      console.log("API response data:", JSON.stringify(data).substring(0, 500) + "...");
      apiCache.set(url, { data, timestamp: Date.now() });
      console.log("Data fetched successfully from:", url);
      return data;
    } catch (error) {
      console.error(`Error fetching ${url}:`, error);
      throw error;
    }
  }

  async function sendTextMessage(message) {
    const intent = detectIntent(message);
    const systemInstruction = systemInstructionInput.value;
    let context = "";

    try {
      switch (intent.type) {
        case 'list_categories': {
          try {
            console.log("Fetching categories list...");
            const categories = await getCategories();
            console.log("Categories fetched:", categories);
            if (categories && categories.length > 0) {
              context += `EXACT CATEGORY LIST FROM API (must use these exact names and URLs):\n${categories.map(c => `• **${c.name}**: ${c.url}`).join('\n')}\n\nDo not add any notes about "sample data" or "URLs not leading to actual content". This is real data from the API.`;
            } else {
              context += "There are currently no categories in the system.";
            }
          } catch (error) {
            console.error("Error fetching categories list:", error);
            context += "Cannot retrieve the category list right now. Please try again later.";
          }
          break;
        }

        case 'category_detail': {
          const categoryName = intent.category;
          try {
            console.log(`Getting details for category: "${categoryName}"`);
            const categories = await getCategories();
            const category = categories.find(c =>
              c.name.toLowerCase() === categoryName.toLowerCase() ||
              c.slug.toLowerCase() === categoryName.toLowerCase()
            );
            if (category) {
              const detail = await getCategoryDetail(category.slug);
              if (detail && detail.items && detail.items.length > 0) {
                context += `Category: **${detail.name}**\nFeatured novels:\n${detail.items.slice(0, 5).map(n => `• **${n.name}** (${n.categories.map(c => c.title).join(', ')}): ${n.url}`).join('\n')}`;
              } else {
                context += `Category **${category.name}** currently has no novels.`;
              }
            } else if (categories && categories.length > 0) {
              context += `Could not find category "${categoryName}". Suggestions: ${categories.slice(0, 3).map(c => c.name).join(', ')}`;
            } else {
              context += `Could not find category "${categoryName}".`;
            }
          } catch (error) {
            console.error(`Error getting category detail for "${categoryName}":`, error);
            context += `Cannot retrieve details for category "${categoryName}" right now. Please try again later.`;
          }
          break;
        }

        case 'search': {
          const keyword = intent.keyword;
          try {
            console.log(`Searching for novels with keyword: "${keyword}"`);
            const results = await searchNovels(keyword);
            if (results && results.length > 0) {
              context += `Search results for "${keyword}":\n${results.slice(0, 5).map(r => `• **${r.name}** (${r.categories.length > 0 ? 'Categories: ' + r.categories.map(c => c.title).join(', ') : 'Uncategorized'}): ${r.url}`).join('\n')}`;
            } else {
              context += `No novels found with keyword "${keyword}". Would you like me to suggest some hot novels?`;
            }
          } catch (error) {
            console.error(`Error processing search request for "${keyword}":`, error);
            context += `Cannot search for keyword "${keyword}" right now. Please try again later.`;
          }
          break;
        }

        case 'novel_detail': {
          const keyword = intent.keyword;
          try {
            console.log(`Searching for novel with keyword: "${keyword}"`);
            const results = await searchNovels(keyword);

            if (results && results.length > 0) {
              console.log(`Found ${results.length} results for "${keyword}". Getting details for: ${results[0].name}`);
              const detail = await getNovelDetail(results[0].slug);
              if (detail) {
                context += `**${detail.name}**\n• Categories: ${detail.categories.map(c => c.title).join(', ')}\n• Status: ${detail.status || 'Unknown'}\n• Description: ${detail.content.replace(/<[^>]*>/g, '').slice(0, 200)}...\n• Read at: ${detail.url}\n\nChapters:\n${detail.chapters.slice(0, 5).map(c => `• Chapter ${c.chapter}: ${c.title}: ${c.url}`).join('\n')}`;
              } else {
                context += `**${results[0].name}**\n• Categories: ${results[0].categories.map(c => c.title).join(', ')}\n• Read at: ${results[0].url}`;
              }
            } else {
              context += `Could not find novel "${keyword}". Please check the novel name or try searching with another keyword.`;
            }
          } catch (error) {
            console.error(`Error processing novel detail request for "${keyword}":`, error);
            // Fallback response that doesn't expose API details
            context += `Cannot retrieve details for novel "${keyword}" right now. Please try again later.`;
          }
          break;
        }

        case 'recommend_novel':
        case 'trending_novels': {
          try {
            console.log("Fetching hot stories...");
            const hotStories = await fetchWithCache(API_ENDPOINTS.get_hot_story);
            if (hotStories && hotStories.status && hotStories.data && hotStories.data.length > 0) {
              const title = intent.type === 'recommend_novel' ? 'Recommended hot novels' : 'Hot/trending novels';
              context += `${title}:\n${hotStories.data.map(story => `• **${story.title}** ${story.status_story ? `(${story.status_story})` : ''} (${story.categories.length > 0 ? 'Categories: ' + story.categories.map(c => c.title).join(', ') : 'Uncategorized'}): ${story.url}`).join('\n')}`;
            } else {
              context += "There are currently no hot novels in the system.";
            }
          } catch (error) {
            console.error("Error fetching hot stories:", error);
            context += "Cannot retrieve the list of hot novels right now. Please try again later.";
          }
          break;
        }

        case 'completed_novels': {
          try {
            console.log("Fetching completed stories...");
            const completedStories = await fetchWithCache(API_ENDPOINTS.get_completed_story);
            if (completedStories && completedStories.status && completedStories.data && completedStories.data.length > 0) {
              context += `Completed novels:\n${completedStories.data.map(story => `• **${story.title}** (${story.status_story}) (${story.categories.length > 0 ? 'Categories: ' + story.categories.map(c => c.title).join(', ') : 'Uncategorized'}): ${story.url}`).join('\n')}`;
            } else {
              context += "There are currently no completed novels in the system.";
            }
          } catch (error) {
            console.error("Error fetching completed stories:", error);
            context += "Cannot retrieve the list of completed novels right now. Please try again later.";
          }
          break;
        }

        case 'check_existence': {
          try {
            console.log(`Checking existence of novel: "${intent.novel}"`);
            const results = await searchNovels(intent.novel);
            if (results && results.length > 0) {
              context += `Yes, we have **${results[0].name}**!\n• Categories: ${results[0].categories.map(c => c.title).join(', ')}\n• Read at: ${results[0].url}`;
            } else {
              context += `Could not find novel "${intent.novel}" in our system. You can try searching with a different keyword or I can suggest some hot novels.`;
            }
          } catch (error) {
            console.error(`Error checking existence of novel "${intent.novel}":`, error);
            context += `Cannot check information about novel "${intent.novel}" right now. Please try again later.`;
          }
          break;
        }

        case 'chat_general':
        default: {
          // Check if message contains keywords that might be asking about API
          const apiKeywords = ['api', 'endpoint', 'backend', 'database', 'data'];
          const containsApiQuestion = apiKeywords.some(keyword => message.toLowerCase().includes(keyword));

          if (containsApiQuestion) {
            context += "I can help you find and read novels from our novel library. You can ask about categories, search for specific novels, or request hot novel recommendations.";
          } else {
            context += "User is having a free conversation or the request is unclear. Respond in a friendly manner and introduce the features of the novel website.";
          }
          break;
        }
      }

      const fullPrompt = `${systemInstruction}

API Data:
${context}

Question: ${message}

EXTREMELY IMPORTANT Instructions:
1. ABSOLUTELY NEVER mention that you are calling APIs, using APIs, or querying data.
2. ABSOLUTELY NEVER expose API information such as API_ENDPOINTS URLs, endpoint details, or any technical information.
3. NEVER mention "no API data." If data is missing, just say "This information is not currently available."
4. If there's no data, ABSOLUTELY NEVER display or suggest API URLs, API names, or any technical information.
5. Respond naturally, friendly, and helpfully.
6. DEFINITELY include full URLs as provided in the API data.
7. Never omit or shorten URLs.
8. When displaying lists, maintain the format with bullets and full URLs.
9. NEVER write "checking API", "let me check", "click-clack", or "click this button".
10. ABSOLUTELY NEVER change URLs to placeholders like [URL_TEEN_NOVEL].
11. All URLs must maintain their original http:// or https:// format exactly as in the API data.
12. For category lists: MUST display EXACT category names as in the API, don't add "Novel" before the category name.
13. MUST maintain the format "• **Category name**: http://full-url" for each list item.
14. DO NOT change category names - for example, if the API returns "Urban", don't change it to "Urban Novel".
15. ABSOLUTELY NEVER ADD "(Note: This is sample data)" or "(URLs don't lead to actual content)" at the end of your answer.
16. Data from the API is all real data, not examples. DO NOT write notes about this data being examples.`;

      // Save context to localStorage to access URLs during display
      try {
        const contextCache = JSON.parse(localStorage.getItem('contextCache') || '{}');
        contextCache.lastContext = context;
        localStorage.setItem('contextCache', JSON.stringify(contextCache));
      } catch (e) {
        console.error("Error saving context to cache:", e);
      }

      const chatConfig = {
        model: "gemini-1.5-flash",
        apiKey: API_KEY,
        temperature: 0.7,
        topP: 0.9,
        topK: 40,
        systemInstruction: systemInstruction,
        maxOutputTokens: 8192,
      };

      try {
        const chatSession = new GoogleGenerativeAI(chatConfig.apiKey);
        const model = chatSession.getGenerativeModel({
          model: chatConfig.model,
          systemInstruction: chatConfig.systemInstruction,
          generationConfig: {
            temperature: chatConfig.temperature,
            topP: chatConfig.topP,
            topK: chatConfig.topK,
            maxOutputTokens: chatConfig.maxOutputTokens,
          },
        });

        const genResponse = await model.generateContent({
          contents: [{ role: "user", parts: [{ text: fullPrompt }] }],
        });

        const generatedText = genResponse.response.text();
        return generatedText;
      } catch (error) {
        console.error("API error:", error);

        // Kiểm tra lỗi quota
        if (error.message && error.message.includes("quota")) {
          if (chatConfig.model === "gemini-1.5-pro") {
            // Thử lại với model nhẹ hơn
            console.log("Switching to gemini-1.5-flash due to quota limit...");
            chatConfig.model = "gemini-1.5-flash";

            try {
              const chatSession = new GoogleGenerativeAI(chatConfig.apiKey);
              const model = chatSession.getGenerativeModel({
                model: chatConfig.model,
                systemInstruction: chatConfig.systemInstruction,
                generationConfig: {
                  temperature: chatConfig.temperature,
                  topP: chatConfig.topP,
                  topK: chatConfig.topK,
                  maxOutputTokens: chatConfig.maxOutputTokens,
                },
              });

              const genResponse = await model.generateContent({
                contents: [{ role: "user", parts: [{ text: fullPrompt }] }],
              });

              const generatedText = genResponse.response.text();
              return generatedText;
            } catch (fallbackError) {
              throw new Error(`Both models exceeded quota. Please try again after 24 hours or use a different API key.`);
            }
          }
        }

        throw error;
      }
    } catch (error) {
      console.error("🔥 API Fail:", error);
      return `Oops! An error occurred: ${error.message}. Please try again!`;
    }
  }

  function updateChatHistory(role, message) {
    const fullHistory = {
      role,
      parts: [{ text: message }],
      timestamp: new Date().toISOString()
    };
    chatHistory.push(fullHistory);

    if (chatHistory.length > 50) {
      chatHistory = chatHistory.slice(-50);
    }

    localStorage.setItem('chatHistory', JSON.stringify(chatHistory));

    updateUserPreferences(message);
  }

  function updateUserPreferences(message) {
    const intent = detectIntent(message);
    if (intent.type === 'category_detail' || intent.type === 'novel_detail') {
      const category = intent.category || message.match(/category\s+(.+)/i)?.[1];
      if (category) {
        userPreferences.favoriteCategories = userPreferences.favoriteCategories || [];
        if (!userPreferences.favoriteCategories.includes(category)) {
          userPreferences.favoriteCategories.push(category);
          localStorage.setItem('userPreferences', JSON.stringify(userPreferences));
        }
      }
    }
  }

  // Function to help protect HTML tags in content when displaying
  function escapeHtml(unsafe) {
    return unsafe
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // Thêm hàm mới hỗ trợ xử lý URL
  function normalizeUrl(url) {
    if (!url) return '';

    // Đảm bảo URL có protocol
    if (!url.match(/^https?:\/\//i)) {
      return 'http://' + url;
    }

    return url;
  }

  // Cải thiện hàm appendMessage
  function appendMessage(sender, message) {
    const messageContainer = document.createElement("div");
    messageContainer.classList.add("message-container");

    const messageElement = document.createElement("div");
    messageElement.classList.add(sender === "user" ? "user-message" : "bot-message");

    // Only process bot messages
    if (sender === "bot") {
      try {
        // Save original message for logging
        const originalMessage = message;
        console.log("Original message:", originalMessage);

        // Check if message is a category list
        const isCategoryList =
          (message.includes("categories") || message.includes("category list") ||
            message.includes("Categories:") || message.toLowerCase().includes("here are the categories")) &&
          message.includes("**") &&
          !message.includes("<a href");

        if (isCategoryList) {
          console.log("Detected category list, ensuring proper URL display");
          try {
            const cached = localStorage.getItem('contextCache');
            if (cached) {
              const contextCache = JSON.parse(cached);
              const lastContext = contextCache.lastContext || "";

              // Process each line in the list
              const lines = message.split('\n');
              for (let i = 0; i < lines.length; i++) {
                if (lines[i].includes("**") && lines[i].includes(":")) {
                  // Extract category name
                  const categoryMatch = lines[i].match(/\*\*([^*]+)\*\*/);
                  if (categoryMatch && categoryMatch[1]) {
                    const categoryName = categoryMatch[1].trim();
                    // Find URL from context, supporting both http and https
                    const contextPattern = new RegExp(`\\*\\*${categoryName}\\*\\*:\\s*(https?:[^\\s\\n]+)`, "i");
                    const contextMatch = lastContext.match(contextPattern);

                    if (contextMatch && contextMatch[1]) {
                      // Replace line with real URL
                      lines[i] = `• **${categoryName}**: <a href='${contextMatch[1]}' target='_blank' class="text-indigo-600 hover:underline dark:text-indigo-400">View now</a>`;
                      console.log(`Fixed category URL for ${categoryName}: ${contextMatch[1]}`);
                    }
                  }
                }
              }
              message = lines.join('\n');
            }
          } catch (error) {
            console.error("Error processing category list:", error);
          }
        }

        // Fix placeholder URLs if they exist
        if (message.includes("[URL_NOVEL_") || message.includes("[url]") || message.includes("[URL]")) {
          try {
            const cached = localStorage.getItem('contextCache');
            if (cached) {
              const contextCache = JSON.parse(cached);
              const lastContext = contextCache.lastContext || "";

              // Find category names in message
              const categoryRegex = /• \*\*([^*]+)\*\*/g;
              let match;
              while ((match = categoryRegex.exec(message)) !== null) {
                const categoryName = match[1].trim();

                // Find corresponding URL in context, supporting both http and https
                const urlPattern = new RegExp(`\\*\\*${categoryName}\\*\\*:\\s*(https?:[^\\s\\n]+)`, "i");
                const urlMatch = lastContext.match(urlPattern);

                if (urlMatch && urlMatch[1]) {
                  // Replace placeholder URL with real URL
                  const placeholder = new RegExp(`\\*\\*${categoryName}\\*\\*:\\s*\\[(URL|url)_[^\\]]*\\]`, "g");
                  message = message.replace(placeholder, `**${categoryName}**: <a href='${urlMatch[1]}' target='_blank' class="text-indigo-600 hover:underline dark:text-indigo-400">View now</a>`);

                  // Replace cases without URL placeholder
                  const noUrlPattern = new RegExp(`\\*\\*${categoryName}\\*\\*(?!:.*?<a)`, "g");
                  message = message.replace(noUrlPattern, `**${categoryName}**: <a href='${urlMatch[1]}' target='_blank' class="text-indigo-600 hover:underline dark:text-indigo-400">View now</a>`);
                }
              }
            }
          } catch (error) {
            console.error("Error processing placeholder URLs:", error);
          }
        }

        // Process URLs into link tags - ensuring both http and https patterns are matched
        message = message
          // Replace URLs after colons
          .replace(/: (https?:\/\/[^\s]+)/gi, ": <a href='$1' target='_blank' class='text-indigo-600 hover:underline dark:text-indigo-400'>View now</a>")

          // Replace URLs on their own line
          .replace(/^(https?:\/\/[^\s]+)$/gim, "<a href='$1' target='_blank' class='text-indigo-600 hover:underline dark:text-indigo-400'>View now</a>")

          // Replace URLs after "Read at:" or "Link:"
          .replace(/(Read at|Link): (https?:\/\/[^\s]+)/gi, "$1: <a href='$2' target='_blank' class='text-indigo-600 hover:underline dark:text-indigo-400'>View now</a>")

          // Replace URLs in chapters
          .replace(/Chapter (\d+): ([^:]+): (https?:\/\/[^\s]+)/gi, "Chapter $1: $2: <a href='$3' target='_blank' class='text-indigo-600 hover:underline dark:text-indigo-400'>Read chapter</a>");

        // Check if message contains any URLs
        // If not, check context in chat history
        if (!message.includes("http") && !message.includes("<a href")) {
          // Find patterns that might be category names and add URLs from context
          message = message.replace(/• \*\*([^*]+)\*\*(?!:)/g, function (match, categoryName) {
            // Search for URL from cache or context
            console.log("Trying to find URL for category:", categoryName);
            // Improved pattern to match both http and https
            const urlPattern = new RegExp(`\\*\\*${categoryName.trim()}\\*\\*:\\s*(https?:[^\\s]+)`, "i");
            const cached = localStorage.getItem('contextCache');
            if (cached) {
              const contextCache = JSON.parse(cached);
              const lastContext = contextCache.lastContext || "";
              const urlMatch = lastContext.match(urlPattern);
              if (urlMatch && urlMatch[1]) {
                return `• **${categoryName}**: <a href='${urlMatch[1]}' target='_blank' class='text-indigo-600 hover:underline dark:text-indigo-400'>View now</a>`;
              }
            }
            return match;
          });
        }

        console.log("Processed message:", message);
      } catch (error) {
        console.error("Error processing message:", error);
      }
    }

    // Format Markdown and line breaks
    message = message
      .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>")
      .replace(/\*(.*?)\*/g, "<em>$1</em>")
      .replace(/\n\* /g, "<br>• ")
      .replace(/\n/g, "<br>");

    messageElement.innerHTML = `<strong>${sender === "user" ? "You" : "Assistant"}:</strong> ${message}`;

    messageContainer.appendChild(messageElement);
    chatContainer.appendChild(messageContainer);
    chatContainer.scrollTop = chatContainer.scrollHeight;
  }

  // Initialize the chat UI
  initChatUI();
</script>