@extends('layouts.main')

@section('content')

    <div class="container mx-auto">
        <form action="{{ route('postNewStory') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex mt-12 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <label for="title" class="font-normal text-grey-darker block mb-2 text-lg">Title</label>
                </div>

                <div class="w-2/3">
                    <input id="title" type="text" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow" name="title" value="{{ old('title') }}" required autofocus>

                    @if ($errors->newstory->first('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->newstory->first('title') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

            <div class="flex mt-8 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <label for="topic" class="font-normal text-grey-darker block mb-2 text-lg">Topic</label>
                </div>

                <div class="w-2/3">
                    <select id="topic" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow" name="topic" required autofocus>
                        <option value="">Select Topic</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}" {{ (old('topic') == $topic->id) ? 'selected' : '' }}>{{ $topic->topic_name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->newstory->first('topic'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->newstory->first('topic') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex mt-8 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <label for="tags" class="font-normal text-grey-darker block mb-2 text-lg">Tags</label>
                </div>

                <div class="w-2/3">
                    <select id="tags" multiple size="8" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow" name="tags[]" required autofocus>
                        <option value="">Select Tags</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->newstory->first('tags'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->newstory->first('tags') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex mt-8 mb-l justify-center items-center flex-col">
                <div class="w-2/3">
                    <button type="submit" class="w-1/3 bg-white text-sm text-grey-darkest py-2 px-4 border border-grey-darkest rounded no-underline">Create a Story</button>
                </div>
            </div>
        </form>
    </div>
@endsection