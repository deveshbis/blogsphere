<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
        <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Latest Blog Posts</h2>
            <form method="GET" action="{{ route('welcome') }}">
                <div class="flex space-x-4 mb-3 justify-evenly">
                    <button type="submit" name="category" value=""
                        class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 {{ $selectedCategory === null ? 'bg-green-700 text-white' : 'bg-gray-200' }}">All</button>
                    @foreach ($categories as $category)
                        <button type="submit" name="category" value="{{ $category->id }}"
                            class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700  {{ $selectedCategory == $category->id ? 'bg-green-700 text-white' : 'bg-gray-200' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8" id="posts-container">
                @foreach ($posts as $post)
                    <div class="post-item" data-category-id="{{ $post->category_id }}">
                        <div class="relative">
                            <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                                alt="{{ $post->title }}" src="{{ $post->image ?? asset('default-image.jpg') }}">

                            <div class="absolute bottom-0 flex p-3 bg-white dark:bg-gray-900 ">
                                <img class="object-cover object-center w-10 h-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                    alt="">

                                <div class="mx-4">
                                    <h1 class="text-sm text-gray-700 dark:text-gray-200">{{ $post->user->name }}</h1>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Creator</p>
                                </div>
                            </div>
                        </div>

                        <h1 class="mt-6 text-xl font-semibold text-gray-800 dark:text-white">
                            {{ $post->title }}
                        </h1>

                        <hr class="w-32 my-6 text-blue-500">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ Str::limit($post->content, 150, '...') }}
                        </p>

                        <div class="flex items-center justify-between ">
                            <a href="{{ route('blogDetails', $post->id) }}"
                                class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
                                Find out more
                                <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                                    &rarr;
                                </span>
                            </a>

                            <!-- Display Comment Count -->
                            <div class="flex space-x-2 text-sm dark:text-gray-600">
                                <button type="button" class="flex items-center p-1 space-x-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        aria-label="Number of comments"
                                        class="w-4 h-4 fill-current dark:text-violet-600">
                                        <path
                                            d="M448.205,392.507c30.519-27.2,47.8-63.455,47.8-101.078,0-39.984-18.718-77.378-52.707-105.3C410.218,158.963,366.432,144,320,144s-90.218,14.963-123.293,42.131C162.718,214.051,144,251.445,144,291.429s18.718,77.378,52.707,105.3c33.075,27.168,76.861,42.13,123.293,42.13,6.187,0,12.412-.273,18.585-.816l10.546,9.141A199.849,199.849,0,0,0,480,496h16V461.943l-4.686-4.685A199.17,199.17,0,0,1,448.205,392.507ZM370.089,423l-21.161-18.341-7.056.865A180.275,180.275,0,0,1,320,406.857c-79.4,0-144-51.781-144-115.428S240.6,176,320,176s144,51.781,144,115.429c0,31.71-15.82,61.314-44.546,83.358l-9.215,7.071,4.252,12.035a231.287,231.287,0,0,0,37.882,67.817A167.839,167.839,0,0,1,370.089,423Z">
                                        </path>
                                        <path
                                            d="M60.185,317.476a220.491,220.491,0,0,0,34.808-63.023l4.22-11.975-9.207-7.066C62.918,214.626,48,186.728,48,156.857,48,96.833,109.009,48,184,48c55.168,0,102.767,26.43,124.077,64.3,3.957-.192,7.931-.3,11.923-.3q12.027,0,23.834,1.167c-8.235-21.335-22.537-40.811-42.2-56.961C270.072,30.279,228.3,16,184,16S97.928,30.279,66.364,56.206C33.886,82.885,16,118.63,16,156.857c0,35.8,16.352,70.295,45.25,96.243a188.4,188.4,0,0,1-40.563,60.729L16,318.515V352H32a190.643,190.643,0,0,0,85.231-20.125,157.3,157.3,0,0,1-5.071-33.645A158.729,158.729,0,0,1,60.185,317.476Z">
                                        </path>
                                    </svg>
                                    <span id="comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span>
                                </button>

                                <button id="like-btn-{{ $post->id }}"
                                    class="like-btn flex items-center p-1 space-x-1.5 {{ $post->likes->contains('user_id', Auth::id()) ? 'liked' : '' }}"
                                    data-post-id="{{ $post->id }}">
                                    <svg id="like-svg-{{ $post->id }}" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" aria-label="Number of likes"
                                        class="w-5 h-5 fill-current {{ $post->likes->contains('user_id', Auth::id()) ? 'text-blue-500' : 'text-gray-500' }}">
                                        <path
                                            d="M126.638,202.672H51.986a24.692,24.692,0,0,0-24.242,19.434,487.088,487.088,0,0,0-1.466,206.535l1.5,7.189a24.94,24.94,0,0,0,24.318,19.78h74.547a24.866,24.866,0,0,0,24.837-24.838V227.509A24.865,24.865,0,0,0,126.638,202.672ZM119.475,423.61H57.916l-.309-1.487a455.085,455.085,0,0,1,.158-187.451h61.71Z">
                                        </path>
                                        <path
                                            d="M494.459,277.284l-22.09-58.906a24.315,24.315,0,0,0-22.662-15.706H332V173.137l9.573-21.2A88.117,88.117,0,0,0,296.772,35.025a24.3,24.3,0,0,0-31.767,12.1L184.693,222.937V248h23.731L290.7,67.882a56.141,56.141,0,0,1,21.711,70.885l-10.991,24.341L300,169.692v48.98l16,16H444.3L464,287.2v9.272L396.012,415.962H271.07l-86.377-50.67v37.1L256.7,444.633a24.222,24.222,0,0,0,12.25,3.329h131.6a24.246,24.246,0,0,0,21.035-12.234L492.835,310.5A24.26,24.26,0,0,0,496,298.531V285.783A24.144,24.144,0,0,0,494.459,277.284Z">
                                        </path>
                                    </svg>
                                    <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".like-btn svg").on("click", function(e) {
                e.preventDefault();

                let postId = $(this).closest('button').data('post-id');
                let svgElement = $(this);
                let likeCountElement = $('#like-count-' + postId);

                $.ajax({
                    url: '/like/' + postId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status === 'liked') {
                            svgElement.removeClass('text-gray-500').addClass('text-blue-500');
                        } else {
                            svgElement.removeClass('text-blue-500').addClass('text-gray-500');
                        }

                        likeCountElement.text(response.likes_count);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

</body>

</html>
