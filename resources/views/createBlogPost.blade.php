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
    class="relative bg-[url(https://i.ibb.co.com/GyDw798/bg-blog-post.jpg)] bg-cover bg-center bg-no-repeat">
    <div class="max-w-md mx-auto mt-20 ">
        <div class="flex justify-between items-center mt-10">
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

            <select name="category_id"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="text" name="image" placeholder="Enter Image URL"
                class="px-4 py-3 bg-gray-100 w-full text-sm outline-none border-b-2 border-transparent focus:border-blue-500 rounded" />

            <button type="submit"
                class="w-full px-4 py-2.5 mx-auto block text-sm bg-rose-600 hover:bg-rose-700 text-white rounded">
                Create
            </button>
        </form>
    </div>
</body>

</html>
