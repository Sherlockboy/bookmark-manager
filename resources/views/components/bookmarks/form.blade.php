@props(['bookmarks'])
<div>
    <div x-data="{ open: true }" class="overflow-hidden">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Your Bookmarks
                    </h3>
                </div>
                <div class="ml-4 mt-2 flex-shrink-0">
                    <a x-on:click.prevent="open = ! open" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span x-show="! open" x-cloak>Show Form</span>
                        <span x-show="open" x-cloak>Hide Form</span>
                    </a>
                </div>
            </div>
        </div>
        <div x-show="open" x-cloak class="divide-y divide-gray-200 py-4 px-4">
            <div class="pt-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Create a new bookmark.
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Add information about the bookmark to make it easier to understand later.
                    </p>
                </div>
                <form id="bookmark_form" method="POST" action="{{ route('bookmarks.store') }}" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    @csrf
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('name')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="url" class="block text-sm font-medium text-gray-700">
                            URL
                        </label>
                        <div class="mt-1">
                            <input type="text" name="url" id="url" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('url')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            Write any notes about this bookmark.
                        </p>
                        @error('description')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="sm:col-span-6">
                        <label for="tags" class="block text-sm font-medium text-gray-700">
                            Tags
                        </label>
                        <div class="mt-1">
                            <input
                                type="text"
                                name="tags"
                                id="tags"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            />
                            <p class="mt-2 text-sm text-gray-500">
                                Add a comma separated list of tags.
                            </p>
                            @error('tag')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <div class="pt-5">
                            <div class="flex justify-end">
                                <a x-on:click.prevent="document.getElementById('bookmark_form').reset();" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </a>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @forelse ($bookmarks as $bookmark)
        <div>
            <a href="#" class="block hover:bg-gray-50">
                <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-indigo-600 truncate">
                            {{ $bookmark->name }}
                        </p>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                        <div class="flex space-x-4">
                            @foreach ($bookmark->tags as $tag)
                                <p class="flex items-center text-sm text-gray-500">
                                    {{ $tag->name }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <a href="#" class="relative block w-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            <span class="mt-2 block text-sm font-medium text-gray-900">
                Create a new bookmark
            </span>
        </a>
    @endforelse
</div>