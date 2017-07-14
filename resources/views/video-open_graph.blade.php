<!DOCTYPE html>
<html>
<head>
    <title>Giffography.ge</title>
    <meta charset="utf-8">
    <meta property="fb:app_id" content="1382369148525539">
    <meta property="og:title" content="{{ $event->en_name }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://api.giffography.ge/redirect/videos/{{ $video->id }}">
    <meta property="og:image" content="{{ $thumb->full_path }}">
    <meta property="og:image:width" content="{{ $thumb->dimensions_array[0] }}">
    <meta property="og:image:height" content="{{ $thumb->dimensions_array[1] }}">
    <meta property="og:video" content="{{ $converted->full_path }}">
    <meta property="og:video:secure_url" content="{{ $converted->full_path }}">
    <meta property="og:video:width" content="{{ $converted->dimensions_array[0] }}">
    <meta property="og:video:height" content="{{ $converted->dimensions_array[1] }}">
    <meta property="og:video:type" content="{{ $converted->mimetype }}">
    <script>
        location.href = 'https://giffography.ge/ka/videos/{{ $video->id }}';
    </script>
</head>
<body>
</body>
</html>