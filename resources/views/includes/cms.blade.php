{{--Put @cms after <head>--}}
@seo
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    [data-cms], [data-cms-background] {
        visibility: hidden;
    }

    [data-cms-clone] {
    }

    @auth
        [data-cms]:hover, [data-cms-background]:hover, [data-cms-listener]:hover {
        border: 1px dashed #3498db;
    }
    @endauth
</style>
{!! $config->css !!}
{!! $config->js !!}
@vite(['resources/js/home/common/cms.js', 'resources/js/home/common/ecommerce.js'])
@language
@auth
    <script src="/js/admin/cms.min.js"></script>
@endauth
