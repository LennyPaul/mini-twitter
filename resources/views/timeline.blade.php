<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="POST" action="{{ route('tweet.add') }}" class="mt-6 space-y-6">
            @csrf
            <div class="container mx-auto px-4">
                    <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                            <label for="body" class="sr-only">Your comment</label>
                            <textarea id="body"  name="body" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="{{ __('Write a tweet...') }}"></textarea>
                        </div>
                        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                            <x-primary-button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800 ">
                                {{ __('Post tweet') }}
                            </x-primary-button>

                        </div>
                    </div>

            </div>
        </form>
        <div class="py-12">
            @foreach ($tweets as $tweet)
                <div class="block w-1/2 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
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
