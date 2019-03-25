@extends('layouts.main')

@section('content')

    <div class="container mx-auto mt-4">
    <div class="w-2/3 mx-auto">
        <h1 class="font-normal">{{ $post[0]->post_title }}</h1>
    </div>
    <div class="w-2/3 mx-auto mt-8">
        <div class="text-grey-darkest text-sm"><span class="font-bold">Author:</span> {{ $post[0]->name }}</div>
        <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($post[0]->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
    </div>

    <div class="post-content mt-16 text-lg font-thin leading-normal text-center">
        {!! $post[0]->post_content !!}

        <div class="tags mt-10 mb-16">
            <ul class="list-reset flex">
                @foreach($tags as $tag)
                <li><a href="{{url('/tag/'.strtolower(str_replace(' ', '-', $tag->tag_name)).'/'.base64_encode($tag->id))}}">{{ $tag->tag_name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div> <!-- end container -->

@endsection