<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800  text-gray-200 leading-tight">
            {{ __('Update Thread') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <form action="{{ route('threads.update', ['thread' => $thread]) }}"
                        method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-4">
                            <label for="name" class="block text-dark text-sm font-medium">Thread Name</label>
                            <input type="text" name="content" id="name" value="{{ $thread->content }}"
                                class="form-input mt-1 block w-full" required autofocus>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>