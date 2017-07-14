<!DOCTYPE html>
<html>
<head>
    <title>Giffography.ge</title>
    <meta charset="utf-8">
    <meta property="fb:app_id" content="1382369148525539">
    <meta property="og:title" content="{{ $event->en_name }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://api.giffography.ge/redirect/videos/{{ $video->id }}">
    <meta property="og:image" content="{{ $video->files['thumb']['full_path'] }}">
    <meta property="og:image:width" content="{{ $tRes[0] }}">
    <meta property="og:image:height" content="{{ $tRes[1] }}">
    <meta property="og:video" content="{{ $video->files['video']['full_path'] }}">
    <meta property="og:video:secure_url" content="{{ $video->files['video']['full_path'] }}">
    <meta property="og:video:width" content="{{ $vRes[0] }}">
    <meta property="og:video:height" content="{{ $vRes[1] }}">
    <meta property="og:video:type" content="{{ $video->files['video']['mimetype'] }}">
    <script>
        location.href = 'https://giffography.ge/ka/videos/{{ $video->id }}';
    </script>
</head>
<body>
</body>
</html>