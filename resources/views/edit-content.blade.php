<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Content {{ $content->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{route('content.update',$content->id)}}">
                        @csrf
                        @method('patch')
                        <div class="space-y-12">
                            <x-auth-session-status class="mb-2" :status="session('status')" />
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Content</h2>
                                <p class="mt-1 text-xs leading-6 text-gray-600">Use clear images for an attractive content</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="sm:col-span-3">
                                        <label for="type" class="block text-xs font-medium leading-6 text-gray-900">Type of Content</label>
                                        <div class="mt-2">
                                            <select name="page" id="type" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-xs sm:leading-6">
                                                <option {{ $content->page == 'ministry' ? 'selected' : '' }} value="ministry">Ministry</option>
                                                <option value="sermon" {{ $content->page == 'sermon' ? 'selected' : '' }}>Sermon</option>
                                                <option value="event" {{ $content->page == 'event' ? 'selected' : '' }}>Event</option>
                                                <option value="testimony" {{ $content->page == 'testimony' ? 'selected' : '' }}>Testimony</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('page'))
                                        <span class="text-red-500 text-xs">{{ $errors->first('page') }}</span>
                                        @endif
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="topic" class="block text-xs font-medium leading-6 text-gray-900">Topic</label>
                                        <div class="mt-2">
                                            <input id="topic" name="topic" type="topic" value="{{$content->topic}}" class="block w-full rounded-md px-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-xs sm:leading-6">
                                        </div>
                                        @if ($errors->has('topic'))
                                        <span class="text-red-500 text-xs">{{ $errors->first('topic') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-span-full">
                                        <label for="content" class="block text-xs font-medium leading-6 text-gray-900">Content</label>
                                        <div class="mt-2">
                                            <textarea id="myTextarea" name="content">{{$content->content}}</textarea>
                                        </div>
                                        @if ($errors->has('content'))
                                        <span class="text-red-500 text-xs">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-span-full flex items-center justify-center">
                                       <img src="{{ asset('storage/images/'.$content->image) }}" class="w-80" alt="Image">
                                    </div>
                                    <div class="col-span-full">
                                        <label for="content" class="block text-xs font-medium leading-6 text-gray-900">Cover Image</label>
                                        <div class="mt-2">
                                            <input type="file" name="file" class="filepond" />
                                        </div>
                                        @if (session('error'))
                                        <span class="text-red-500 text-xs">Please attach an Image</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="border-b border-gray-900/10 pb-12">
                                <div class="mt-10 space-y-10">
                                    <fieldset>
                                        <legend class="text-xs font-semibold leading-6 text-gray-900">By topic</legend>
                                        <div class="mt-6 space-y-6">
                                            <div class="relative flex gap-x-3">
                                                <div class="flex h-6 items-center">
                                                    <input id="notify" name="notify" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600">
                                                </div>
                                                <div class="text-xs leading-6">
                                                    <label for="notify" class="font-medium text-gray-900">Notify subscribers</label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-xs font-semibold leading-6 text-gray-900">Cancel</button>
                            <button type="submit" class="rounded-md bg-orange-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>