<div class="layout-right">
    <div class="item">
        <ul class="list-menu">
            @foreach ($tuelinhList as $post)
            <li>
                <a href="{{url(str_slug($post->title))}}">{{$post->title}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>