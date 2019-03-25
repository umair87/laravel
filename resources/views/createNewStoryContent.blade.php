@extends('layouts.main')

@section('content')

    <div id="top-container" class="container mx-auto">
        @if ($post_title !== 0)
            @if (\Session::has('success'))
                <div class="flex mt-8 mb-l justify-center items-center flex-col is-valid">
                    <div class="w-2/3">
                    <span class="valid-feedback" role="alert">
                        <strong>{!! \Session::get('success') !!}</strong>
                    </span>
                    </div>
                </div>
            @endif

            @if ($errors->savenewstory->first('content'))
                <div class="flex mt-8 mb-l justify-center items-center flex-col">
                    <span class="w-2/3 invalid-feedback" role="alert">
                        <strong>{{ $errors->savenewstory->first('content') }}</strong>
                    </span>
                </div>
            @endif

            <form action="{{ route('saveContent') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex mt-12 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <label for="title" class="font-normal text-grey-darker block mb-2 text-lg">Title</label>
                </div>

                <div class="w-2/3">
                    <input id="title" type="text" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow" disabled name="title" value="{{ $post_title }}" required autofocus>
                </div>
            </div>


            <div class="flex mt-5 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <a id="createTextField" href="javascript:void(0)" class="w-full text-center sm:w-auto float-left bg-white text-sm text-grey-darkest py-2 px-4 mr-2 border border-grey-darkest rounded no-underline">Insert Content</a>
                    <a id="upload-img" href="javascript:void(0)" class="w-full text-center sm:w-auto sm:my-0 float-left bg-white text-sm text-grey-darkest py-2 px-4 mr-2 my-2 border border-grey-darkest rounded no-underline">Insert Photo</a>
                    <button type="submit" class="w-full text-center sm:w-auto float-right bg-grey-lighter text-sm text-grey-darkest py-2 px-4 border border-grey-darkest rounded no-underline">Submit</button>
                    <input type="file" class="hidden" id="uploader" name="uploader">
                    <input type="hidden" id="post_id" name="post_id" value="{{ $id }}">
                </div>
            </div>

            <div id="content" class="w-2/3 container mx-auto flex mt-8 mb-l justify-center items-center flex-col">

            </div>
        </form>
        @else
            <div class="mt-8">No post found!</div>
        @endif
    </div>
@endsection