<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body
    class="relative bg-[url(https://i.ibb.co.com/pjkQ5B1J/blog-Post-Bg.jpg)] bg-cover bg-center bg-no-repeat">

    <div class="max-w-md mx-auto mt-20 ">
        <div class="flex justify-between items-center mt-10">
            <h1 class="text-4xl text-black font-extrabold border-b-2 border-blue-500">Edit Blog Post</h1>

        </div>

        <form method="post" action="{{ route('posts.update', $post->id) }}" class="space-y-4 font-[sans-serif] mt-5">
            @csrf
            @method('PUT')

            <input type="text" name="title" placeholder="Enter Blog Title" value="{{ $post->title }}"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-blue-500 rounded" required />

            <input type="text" name="content" placeholder="Enter Content" value="{{ $post->content }}"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" required />

            <select name="category_id"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <input type="text" name="image" placeholder="Enter Image URL" value="{{ $post->image }}"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />

            <button type="submit"
                class="w-full px-4 py-2.5 mx-auto block text-sm bg-gray-600 hover:bg-gray-700 text-white rounded">
                Update
            </button>
        </form>
    </div>
</body>

</html>