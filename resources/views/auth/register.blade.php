@extends('layouts.main')

@section('content')
<div class="container mx-auto h-full flex justify-center items-center">
    <div class="w-2/5 border-teal p-8 border-t-12 bg-white mt-12 rounded-lg shadow-lg">

            <div class="card">
                <div class="font-hairline mb-6 text-center text-lg">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="font-normal text-grey-darker block mb-2 text-sm">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="font-normal text-grey-darker block mb-2 text-sm">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="font-normal text-grey-darker block mb-2 text-sm">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="font-normal text-grey-darker block mb-2 text-sm">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="bg-white text-xs text-grey-darkest py-2 px-4 border border-grey-darkest rounded">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>
</div>
@endsection
