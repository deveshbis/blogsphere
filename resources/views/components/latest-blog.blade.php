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
                <article class="overflow-hidden rounded-lg border border-gray-100 bg-white shadow-xs">
                    <img alt="{{ $post->title }}" src="{{ $post->image ?? asset('default-image.jpg') }}" class="h-56 w-full object-cover" />

                    <div class="p-4 sm:p-6">
                        <a href="#">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $post->title }}
                            </h3>
                        </a>

                        <p class="mt-2 line-clamp-3 text-sm text-gray-500">
                            {{ Str::limit($post->content, 150, '...') }}
                        </p>

                        <a href="#" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
                            Find out more
                            <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                                &rarr;
                            </span>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>

</body>

</html>