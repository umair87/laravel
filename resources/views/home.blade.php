@extends('layouts.main')

@section('content')

@if (count($featuredPosts) > 0)
<div class="featured-posts container mx-auto flex flex-col md:flex-row">
    <div class="w-full mb-8 md:w-1/3 md:mb-0 md:pr-5">
        <div class="featured-img">
            @if (isset($featuredPosts[0]->img))
                {!! $featuredPosts[0]->img !!}
            @endif
        </div>
        <div class="post-title mt-3 mb-3 text-xl font-bold flex">
            <a href="{{url('/'.strtolower(str_replace(' ', '-', $featuredPosts[0]->post_title)).'/'.base64_encode($featuredPosts[0]->id))}}" class="truncate text-black no-underline">{{ $featuredPosts[0]->post_title }}</a>
        </div>
        <div class="post-summary text-sm text-grey-darker">{!! $featuredPosts[0]->excerpt !!}</div>
        <div class="author mt-5 text-xs text-black">{{ $featuredPosts[0]->name }}</div>
        <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($featuredPosts[0]->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
    </div><!-- end 1st Column -->

    <div class="w-full mb-8 md:w-1/3 md:mb-0 md:pr-5">
        @if (count($featuredPosts) > 1)
            @foreach($featuredPosts as $key => $featuredPost)
                @if($key>0 && $key<4)
                    <div class="flex{{ ($key==3) ? '' : ' mb-4' }}">
                        <div class="featured-img w-1/4">
                            @if (isset($featuredPost->img))
                                {!! $featuredPost->img !!}
                            @endif
                        </div>
                        <div class="w-3/4">
                            <div class="pl-5">
                                <div class="post-title mb-3 text-md font-bold flex">
                                    <a href="{{url('/'.strtolower(str_replace(' ', '-', $featuredPost->post_title)).'/'.base64_encode($featuredPost->id))}}" class="truncate text-black no-underline">{{ $featuredPost->post_title }}</a>
                                </div>
                                <div class="author mt-5 text-xs text-black">{{ $featuredPost->name }}</div>
                                <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($featuredPost->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div><!-- end 2nd Column -->

    <div class="w-full mb-8 md:w-1/3 md:mb-0 md:pr-5">
        @if (isset($featuredPosts[4]))
        <div class="featured-img">
            @if (isset($featuredPosts[4]->img))
                {!! $featuredPosts[4]->img !!}
            @endif
        </div>
        <div class="pl-5">
            <div class="post-title mt-3 mb-3 text-xl font-bold flex">
                <a href="{{url('/'.strtolower(str_replace(' ', '-', $featuredPosts[4]->post_title)).'/'.base64_encode($featuredPosts[4]->id))}}" class="truncate text-black no-underline">{{ $featuredPosts[4]->post_title }}</a>
            </div>
            <div class="post-summary text-sm text-grey-darker">{!! $featuredPosts[4]->excerpt !!}</div>
            <div class="author mt-5 text-xs text-black">{{ $featuredPosts[4]->name }}</div>
            <div class="date text-xs text-grey-darker mt-2">{{ date("M d", strtotime($featuredPosts[4]->created_at)) }} <i class="fa fa-star" aria-hidden="true"></i></div>
        </div>
        @endif
    </div><!-- end 3rd Column -->
</div><!-- end featured posts -->

<div class="container mx-auto border-b border-solid mt-12 mb-12"></div>
@endif

<div class="container mx-auto flex flex-col md:flex-row">
    <div class="w-full md:pr-5">
        @if ($allPosts->count())
            @foreach($allPosts as $key => $post)
                @if ($post->featured == 0)
                <div class="flex mb-12 posts-excerpt">
                    <div class="w-4/6 sm:w-5/6 pr-2">
                        <div class="uppercase text-grey-dark text-sm">{{ $post->topic_name }}</div>
                        <div class="post-title mt-3 mb-3 text-xl font-bold flex">
                            <a href="{{url('/'.strtolower(str_replace(' ', '-', $post->post_title)).'/'.base64_encode($post->id))}}" class="truncate text-black no-underline">{{ $post->post_title }}</a>
                        </div>
                        <div class="post-summary text-sm text-grey-darker">{!! $post->excerpt !!}</div>
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
        @else
            <div class="mt-12">No posts found!</div>
        @endif
    </div><!-- end 1st column-->
</div>
@endsection
