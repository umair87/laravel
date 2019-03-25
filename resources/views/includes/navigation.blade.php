<div class="container mx-auto">
    <nav class="flex items-center justify-between flex-wrap p-6 pt-8 pl-0">
        <div id="nav-btn" class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-grey-dark border-grey-dark hover:text-grey-darkest hover:text-grey-darkest">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div id="nav-menu" class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto lg:block">
            <div class="text-sm lg:flex-grow">
                <a href="{{ route('home') }}" class="uppercase no-underline block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-grey-darkest mr-8">
                    Home
                </a>

                @foreach($topics as $topic)
                    <a href="{{url('/topic/'.strtolower(str_replace(' ', '-', $topic->topic_name)).'/'.base64_encode($topic->id))}}" class="uppercase no-underline block mt-4 lg:inline-block lg:mt-0
                                text-grey-dark hover:text-grey-darkest {{ ($loop->last) ? 'mr-0' : 'mr-8' }}">
                        {{ $topic->topic_name }}
                    </a>
                @endforeach

            </div>
        </div>
    </nav>
</div> <!-- end navigation -->