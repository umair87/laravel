@extends('layouts.main')

@section('content')

@if (isset($posts[0]))
<div class="container mx-auto mt-4">
    <div class="featured-posts flex flex-col-reverse md:flex-row">
        <div class="w-full pr-0 md:w-2/3 md:pr-5 topic-top-post">
            <div class="featured-img">
                @if (isset($posts[0]->img))
                    {!! $posts[0]->img !!}
                @endif
            </div>
            <div class="pl-0 md:pl-5">
                <div class="post-title mt-3 mb-3 text-xl font-bold flex">
                    <a href="{{url('/'.strtolower(str_replace(' ', '-', $posts[0]->post_title)).'/'.base64_encode($posts[0]->id))}}" class="truncate text-black no-underline">{{ $posts[0]->post_title }}</a>
                </div>
                <div class="post-summary text-sm text-grey-darker">{!! $posts[0]->excerpt !!}</div>
                <div class="author mt-5 text-xs text-black">{{ $posts[0]->name }}</div>
                <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($posts[0]->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
        </div><!-- end 1st Column -->

        <div class="w-full mb-5 md:w-1/3 md:mb-0">
            <div class="text-3xl font-thin">{{ $typeName }}</div>
            <div class="text-sm text-grey-darker">Live Better</div>
        </div><!-- end 2nd Column -->
    </div><!-- end featured posts -->

    <div class="mt-12 mb-12"></div>
</div> <!-- end container -->
@endif

<div class="container mx-auto flex flex-col md:flex-row">
    <div class="w-full md:pr-5">
        @if ($posts->count() > 1)
            <div class="uppercase text-xs font-bold">Latest</div>
            <div class="border-b border-solid mt-2 mb-12"></div>
            @foreach($posts as $key => $post)
                @if ($key != 0)
                    <div class="flex mb-12 posts-excerpt">
                        <div class="w-4/6 sm:w-5/6 pr-2">
                            <div class="post-title mb-3 text-xl font-bold flex">
                                <a href="{{url('/'.strtolower(str_replace(' ', '-', $post->post_title)).'/'.base64_encode($post->id))}}" class="truncate text-black no-underline">{{ $post->post_title }}</a>
                            </div>
                            <div class="post-summary text-sm text-grey-darker">{!! $post->excerpt !!}</div>
                            <div class="author mt-5 text-xs text-black">{{ $post->name }}</div>
                            <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($post->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
                        </div>
                        <div class="w-2/6 sm:w-1/6 self-center">
                            @if (isset($post->img))
                                {!! $post->img !!}
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @elseif (!$posts->count())
            <div class="mt-12">No posts found!</div>
        @endif

    </div><!-- end 1st column-->
</div>

@endsection
