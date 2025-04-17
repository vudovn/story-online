<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="/assets/client/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/client/app.css">
    <link rel="stylesheet" href="/assets/client/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/assets/client/jquery.min.js"></script>

    <title>{{ $title ?? setting()->site_name }}</title>
    <meta name="description"
        content="Read stories online, best stories. Demo Stories always collects and updates chapters as quickly as possible.">
    <script>
        window.WebTruyen = {
            baseUrl: '{{ url('/') }}',
            urlCurrent: '{{ url()->current() }}',
            csrfToken: '{{ csrf_token() }}',
        }
    </script>
</head>