<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog View Details</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section class="bg-white dark:bg-gray-900 max-w-7xl mx-auto">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white mb-3">{{ $post->title }}</h1>

            <div class="max-w-2xl overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <img class="object-cover w-full h-96" src="{{ $post->image ?? asset('default-image.jpg') }}" alt="Article">

                <div class="p-6">
                    <div>
                        <span class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">{{ $post->category->name }}</span>
                        <a href="#" class="block mt-2 text-xl font-semibold text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 hover:underline" tabindex="0" role="link">{{ $post->title }}</a>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ $post->content }}</p>
                    </div>

                    <div class="mt-4">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <img class="object-cover h-10 rounded-full" src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&q=60" alt="Avatar">
                                <a href="#" class="mx-2 font-semibold text-gray-700 dark:text-gray-200" tabindex="0" role="link">{{ $post->user->name }}</a>
                            </div>
                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
                <div class="max-w-2xl mx-auto px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion</h2>
                    </div>

                    <form class="mb-6" id="commentForm">
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-black border bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Post comment
                        </button>
                    </form>

                    <div id="commentsSection">
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script>
    $(document).ready(function() {
        $("#commentForm").on("submit", function(e) {
            e.preventDefault();

            var commentBody = $("#comment").val();
            var postId = "{{ $post->id }}";

            if (commentBody) {
                $.ajax({
                    url: '/comments',
                    method: 'POST',
                    data: {
                        body: commentBody,
                        post_id: postId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var formattedDate = formatDate(response.created_at);

                        var newComment = `
                            <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 mb-4">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                            <img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="User Avatar">
                                            ${response.user_name || 'User'}  <!-- Display user's name or fallback -->
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">${formattedDate}</p>  <!-- Display formatted date -->
                                    </div>
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400">${response.body || 'No comment text'}</p>  <!-- Display comment body -->
                            </article>
                        `;
                        $("#commentsSection").prepend(newComment);
                        $("#comment").val("");
                    },
                    error: function(error) {
                        alert('Error adding comment. Please try again.');
                    }
                });
            } else {
                alert('Please write a comment.');
            }
        });

        
        $.ajax({
            url: '/comments/{{ $post->id }}',
            method: 'GET',
            success: function(comments) {
                comments.forEach(function(comment) {
                   
                    var formattedDate = formatDate(comment.created_at);

                    var existingComment = `
                        <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 mb-4">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                        <img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="User Avatar">
                                        ${comment.user_name || 'User'}  <!-- Display user's name or fallback -->
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">${formattedDate}</p>  <!-- Display formatted date -->
                                </div>
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">${comment.body || 'No comment text'}</p>  <!-- Display comment body -->
                        </article>
                    `;
                    $("#commentsSection").append(existingComment);
                });
            },
            error: function() {
                alert('Error loading comments.');
            }
        });

        function formatDate(dateString) {
            if (!dateString || typeof dateString !== "string") {
                return 'Invalid date';
            }

            var date = new Date(dateString);

            if (isNaN(date.getTime())) {
                date = new Date(dateString.replace(" ", "T"));
            }

            if (isNaN(date.getTime())) {
                return 'Invalid date';
            }
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            return date.toLocaleDateString('en-US', options);
        }
    });
</script>





</body>

</html>