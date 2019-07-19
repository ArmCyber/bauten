<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terminal</title>
    <link href="{{ aVendor('terminal/css/terminal.css') }}" rel="stylesheet"/>
    <style>
        html, body{
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #tracy-debug-bar {
            display: none;
        }
        body {
            background: #000000 url({{ aVendor('terminal/assets/wallpaper.jpg') }}) center right no-repeat !important;
        }
        #terminal-shell,.terminal-wrapper,.cursor-line, .cmd, .terminal-output, .terminal-output>div, .terminal-output>div>div{
            background: transparent !important;
        }
        @media (max-width: 1200px) {
            body {
                background-size:auto 350px !important;
            }
        }
        @media (max-width: 991px) {
            body {
                background: #000000 !important;
            }
        }
    </style>
</head>
<body>
@if(settings('audio', true))
    <audio controls onplay="this.volume=0.3" onended="this.play()" autoplay src="{{ aVendor('terminal/assets/music.mp3') }}" style="display:none;"></audio>
@endif
    <div id="terminal-shell"></div>
    <script src="{{ aVendor('terminal/js/terminal.js') }}"></script>
    <script>
    (function() {
        new Terminal("#terminal-shell", {!! $options !!});
    })();
    </script>
</body>
</html>