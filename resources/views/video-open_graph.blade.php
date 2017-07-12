<html>
<head>
    <title>Giffography.ge</title>
    <meta name="og:title" content="{{ $event->en_name }}">
    <meta name="og:type" content="website">
    <meta name="og:image" content="{{ $video->files['thumb']['full_path'] }}">
    <meta name="og:video" content="{{ $video->files['video']['full_path'] }}">
    <meta name="og:video:secure_url" content="{{ $video->files['video']['full_path'] }}">
    <meta name="og:video:width" content="{{ $resolution[0] }}">
    <meta name="og:video:height" content="{{ $resolution[1] }}">
    <meta name="og:video:type" content="{{ $video->files['video']['mimetype'] }}">
</head>
<body>
</body>
</html>