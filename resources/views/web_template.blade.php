@isset($pathCss)
    <link rel="stylesheet" href="{{asset("css/$pathCss")}}">
@endisset
<div class="container mt-3">
    <div class="jumbotron">
        WEB - TEMPLATE
        @include($module)
    </div>
</div>