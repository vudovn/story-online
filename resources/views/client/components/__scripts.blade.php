<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0"
    nonce="abc123"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Alpine.js for interactive components -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Custom scripts for our application -->
{{-- <script src="/assets/client/app.js"></script> --}}
{{-- <script src="/assets/client/common.js"></script> --}}
{{-- <script src="/assets/client/story.js"></script> --}}
<script src="/assets/client/chapter.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loadingOverlay = document.getElementById('loadingPage');
        window.addEventListener('beforeunload', function () {
            loadingOverlay.classList.remove('hidden');
        });
        loadingOverlay.classList.add('hidden');
    });
</script>