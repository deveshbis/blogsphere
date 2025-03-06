<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative bg-[url(https://i.ibb.co.com/GyDw798/bg-blog-post.jpg)] bg-cover bg-center bg-no-repeat min-h-screen">

    <div class="max-w-md mx-auto mt-20">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl text-rose-700 font-extrabold border-b-2 border-blue-500">Create Post</h1>
            <a href="{{ route('dashboard') }}">
                <button type="button"
                    class="bg-white py-1 min-w-[70px] shadow-xl shadow-blue-200 cursor-pointer text-black text-sm tracking-wider font-medium outline-none border border-blue-600 active:shadow-inner">
                    Back
                </button>
            </a>
        </div>

        <form method="post" action="{{ route('posts.store') }}" class="space-y-4 font-[sans-serif] mt-5">
            @csrf
            <input type="text" name="title" placeholder="Enter Blog Title"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" required />

            <input type="text" name="content" placeholder="Enter Content"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" required />

            <input type="text" name="image" placeholder="Enter Image URL"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />

            <!-- Multiple Select Option -->
            <div x-data="multiSelect()">
                {{-- <label for="multi-select" class="block text-sm font-medium text-gray-700 mb-1">Select Categories:</label> --}}
                <div class="mt-1 relative">
                    <button type="button" @click="open = !open"
                        class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <span class="block truncate"
                            x-text="selectedOptions.length ? selectedOptions.map(opt => opt.name).join(', ') : 'Select categories'"></span>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                        style="display: none;">
                        <template x-for="category in categories" :key="category.id">
                            <div @click="toggleOption(category)"
                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white">
                                <span x-text="category.name" :class="{ 'font-semibold': selectedOptions.includes(category) }"
                                    class="block truncate"></span>
                                <span x-show="selectedOptions.includes(category)"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 hover:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        </template>
                    </div>
                </div>
                <template x-for="(option, index) in selectedOptions" :key="option.id">
                    <input type="hidden" name="categories[]" x-bind:value="option.id">
                </template>
            </div>

            <button type="submit"
                class="w-full px-4 py-2.5 mx-auto block text-sm bg-rose-600 hover:bg-rose-700 text-white rounded">
                Create
            </button>
        </form>
    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function multiSelect() {
            return {
                open: false,
                categories: [
                    // Dynamically populate categories from the backend
                    @foreach($categories as $category)
                        { id: {{ $category->id }}, name: '{{ $category->name }}' },
                    @endforeach
                ],
                selectedOptions: [],
                toggleOption(option) {
                    if (this.selectedOptions.includes(option)) {
                        this.selectedOptions = this.selectedOptions.filter(item => item !== option);
                    } else {
                        this.selectedOptions.push(option);
                    }
                }
            }
        }
    </script>
</body>

</html>
