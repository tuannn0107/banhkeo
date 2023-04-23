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
<h1>Test</h1>
<h2 class="hi">Test <br/> Test</h2>
<span>{{$config->phone}}</span>
<div>
    Test
    <a href="https://test.com">Test ® test</a><br />
    <a href="https://link"><img @src="test.png" alt="Test"></a>
    <a href="">Test &nbsp; test</a>
    <a href="#test">Test &copy; test</a><br>
    <div>Test</div>
    <ul>
        <li>Test</li>
        <li>Test</li>
        <li>Test</li>
    </ul>
</div>
</body>
</html>
