@extends('layouts.main')

@section('content')

<div class="container mx-auto">
    <div class="flex mt-12 mb-1">
        <div class="flex w-1/6 bg-grey text-white text-center p-2 text-sm font-bold">
            <div class="w-1/3">
                <input type="checkbox" class="mr-2" name="select_all" id="select_all">
            </div>
            <div class="w-2/3">Post ID</div>
        </div>
        <div class="w-3/6 bg-grey text-white text-center p-2 text-sm font-bold">Post Title</div>
        <div class="w-2/6 bg-grey text-white text-center p-2 text-sm font-bold"></div>
    </div>

    <div class="admin-dashboard">
    @foreach($posts as $key => $post)
        <div id="row_{{ $post->id }}" class="flex mb-1">
            <div class="flex w-1/6 bg-grey-light{{ ($key%2==0) ? 'er' : 'est' }} text-grey-darker text-center p-2 text-sm font-normal">
                <div class="w-1/3">
                    <input type="checkbox" class="mr-2" name="select[]" id="select{{ $post->id }}" value="{{ $post->id }}">
                </div>
                <div class="w-2/3">{{ $post->id }}</div>
            </div>
            <div class="w-3/6 bg-grey-light{{ ($key%2==0) ? 'er' : 'est' }} text-grey-darker p-2 text-sm font-normal">
                <a href="{{url('admin/'.strtolower(str_replace(' ', '-', $post->post_title)).'/'.base64_encode($post->id))}}" class="text-grey-darker no-underline hover:underline" target="_blank">
                    {{ $post->post_title }}
                </a>
            </div>
            <div class="w-2/6 bg-grey-light{{ ($key%2==0) ? 'er' : 'est' }} text-grey-darker p-2 text-sm font-normal text-center">
                <i onclick="window.open('/story/edit/'+{{ $post->id }}, '_blank');" class="fa fa-pencil text-black mr-2 cursor-pointer" title="Edit" aria-hidden="true"></i>
                <i onclick="publishPost(this, {{ $post->id }})" class="fa fa-eye
                {{ ($post->status == 1) ? 'text-green-dark' : 'text-black' }} mr-2 cursor-pointer"
                   title="{{ ($post->featured == 1) ? 'Publish' : 'Unpublish' }}" aria-hidden="true"></i>
                <i onclick="featurePost(this, {{ $post->id }})" class="fa fa-commenting-o
                   {{ ($post->featured == 1) ? 'text-green-dark' : 'text-black' }} mr-2 cursor-pointer"
                   title="{{ ($post->featured == 1) ? 'Featured' : 'Unfeatured' }}" aria-hidden="true"></i>
                <i onclick="deletePost(this, {{ $post->id }})" class="fa fa-times text-red-dark cursor-pointer" title="Delete" aria-hidden="true"></i>
            </div>
        </div>
    @endforeach
    </div>

    <button id="delete-all" type="button" class="float-right block bg-white text-sm text-grey-darkest py-2 px-4 my-5 border border-grey-darkest rounded no-underline hidden">Delete All</button>
</div><!-- end container -->

@endsection