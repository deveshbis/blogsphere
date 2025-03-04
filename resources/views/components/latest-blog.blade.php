<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
        <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Latest Blog Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
                @foreach($posts as $post)
                <div>
                    <div class="relative">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80" alt="{{ $post->title }}" src="{{ $post->image ?? asset('default-image.jpg') }}">

                        <div class="absolute bottom-0 flex p-3 bg-white dark:bg-gray-900 ">
                            <img class="object-cover object-center w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">

                            <div class="mx-4">
                                <h1 class="text-sm text-gray-700 dark:text-gray-200">{{$post->user->name}}</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Creator</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 px-3">
                        <span
                            class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700">
                            <p class="whitespace-nowrap text-sm">{{$post->category->name}}</p>
                        </span>
                    </div>

                    <h1 class="mt-6 text-xl font-semibold text-gray-800 dark:text-white">
                        {{ $post->title }}
                    </h1>

                    <hr class="w-32 my-6 text-blue-500">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ Str::limit($post->content, 150, '...') }}
                    </p>

                    <a href="{{route('blogDetails', $post->id)}}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
                        Find out more
                        <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                            &rarr;
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</body>

</html>