<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test | @yield('title') | {{ config('app.name') }}</title>
    @cms
    <style>
        h1 {
            color: red;
        }
    </style>
    <script>console.log('Test')</script>
</head>
<body>
<h1 data-cms="html-0">Test</h1>
<h2 class="hi" data-cms="html-1">Test <br> Test</h2>
<span data-cms="html-2">{{$config->phone}}</span>
<div>
    Test
    <a href="https://test.com">Test ® test</a><br>
    <a href="https://link"><img @src="test.png" alt="Test" data-cms="html-6"></a>
    <a href="" data-cms="html-7">Test  test</a>
    <a href="#test">Test © test</a><br>
    <div data-cms="html-9">Test</div>
    <ul>
        <li data-cms="html-11">Test</li>
        <li data-cms="html-12">Test</li>
        <li data-cms="html-13">Test</li>
    </ul>
</div>
</body>
</html>
