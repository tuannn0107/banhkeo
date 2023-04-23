@php($seo = $seo ?? (isset($post) ? $post->seo : null))

@isset($seo)
    <title>{{$seo->title}}</title>
    <meta name="description" content="{{$seo->description}}">
    <meta name="robots" content="{{$seo->robots}}"/>
    <meta name="keywords" content="{{$seo->keywords}}"/>

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$seo->title}}"/>
    <meta property="og:site_name" content="{{$seo->title}}"/>
    <meta property="og:description" content="{{$seo->description}}"/>
    <meta property="og:image" content="{{isset($post) ? request()->root() . $post->image : ''}}"/>
    <meta property="og:image:alt" content="{{$seo->title}}"/>
    <meta property="og:url" content="{{request()->url()}}"/>

    {!! $seo->scripts !!}
@else
    <title>@yield('title') - {{config('app.name')}}</title>
@endif
