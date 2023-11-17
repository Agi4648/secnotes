@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
            <div class="p-6 font-medium text-2xl text-green-500">
               <p>{{session('success')}}</p>
            </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>{{ Auth::user()->name  }}, willkommen bei ihren Notizen!</h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/notes" method="post">
                        @csrf
                        <div>
                            @error('title')
                                <div class="text-2xl text-red-500 font-medium">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="title">
                                {{ __('Title') }}
                            </label>
                            <input type="text"
                                   id="title"
                                   value="{{ old('title') }}"
                                   name="title">
                        </div>

                        <div>
                            @error('content')
                            <div class="text-2xl text-red-500 font-medium">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="content">
                                {{ __('Content') }}
                            </label>
                            <input type="text"
                                   id="content"
                                   value="{{ old('content', 'Vorgabe') }}"
                                   name="content">
                        </div>

                        <div>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">


                    @foreach(Auth::user()->notes as $note)

                        <div class="flex items-center justify-between">


                            <a href="/notes/{{$note->id}}/show" a> <h2>{{ $note->title }}</h2></a>
                                <div h-56 grid grid-cols-3 gap-4 content-center>
                                    <div class="flex justify-end center">
                                    <form action="/notes/{{ $note->id }}" method="post">

                                        @csrf
                                        @method('DELETE')
                                        <button>
                                            <!--merge muss bei trash.blade.php hinzugefügt werden sonst geht die änderung der Textfarbe nicht-->
                                            <x-trash class="text-red-500"/>
                                            <span class="sr-only"> {{ __('Remove note') }}</span>
                                        </button>
                                    </form>

                                    <form action="/notes/{{$note->id}}/favorite" method="get">
                                        @csrf
                                        @method('FAVORITE')


                                        @if($note->favorite == true)
                                            <button>
                                                <x-star @class("text-yellow-500")/>
                                            </button>
                                        @elseif($note->favortie == false)
                                            <button>
                                                <x-star @class("text-black-200")/>
                                            </button>
                                        @endif
                                    </form>

                                        <a href="/notes/{{$note->id}}/edit">
                                            <x-pencil />
                                            <span class="sr-only">{{ __('Edit note') }}</span>
                                        </a>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
