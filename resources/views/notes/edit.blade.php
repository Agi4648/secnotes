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
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/notes/{{ $note->id }}" method="post">

                        @csrf
                        @method('PATCH')

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
                                   value="{{ old('title', $note->title) }}"
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
                                   value="{{ old('content', $note->content) }}"
                                   name="content">
                        </div>

                        <div>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
