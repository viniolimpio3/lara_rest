@isset($pathCss)
    <link rel="stylesheet" href="{{asset("css/$pathCss")}}">
@endisset
<div class="container mt-5">
    <div class="jumbotron">
        @include($module)
    </div>
</div>

