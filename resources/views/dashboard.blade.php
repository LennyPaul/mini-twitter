<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1 class="text-white text-3xl font-bold">Mes tweets</h1>

    <div class="p-12">
        @foreach ($tweets as $tweet)
            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">{{$tweet->user->username}}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{$tweet->created_at->diffForHumans()}}</p>
                <p class="font-normal text-white dark:text-white">{{$tweet->body}}</p>
                @if($tweet->user->id == Auth::user()->id)
                    <form action="{{route('tweet.destroy',$tweet->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{__('Delete')}}</button>
                    </form>
                @endif
            </div>


        @endforeach
    </div>
    {{$tweets->links()}}
    </div>
</x-app-layout>
