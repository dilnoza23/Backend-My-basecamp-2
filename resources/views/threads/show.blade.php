<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .containerr {
            max-width: 1220px;
            margin: 15px auto auto auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-decoration: none;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .add-project-link {
            display: inline-block;
            text-decoration: none;
            margin-top: 18px;
        }

        .btn {
            background-color: #007bff;
            color: #191717;
            border: 1px solid rgb(18, 137, 196);
            border-radius: 3px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            color: #000;
            border: 1px solid #ffbb00;
            border-radius: 3px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            margin-right: 5px;
        }

        .delete {
            color: #000;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 14px;
            border: 1px solid red;
            border-radius: 3px;
        }

        .delete:hover {
            background-color: #d7302b;
            color: #fff;
        }

        .edit-btn:hover {
            background-color: #ffbb00;
            color: #fff;
        }

        .btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .divider {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .project {
            background-color: #f5f5f5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 16px;
            margin-bottom: 14px;
            height: 160px;
        }

        .project h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .project p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .project-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .project-author {
            display: flex;
            justify-content: flex-end;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
        }

        .navbar-logo {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            margin-right: 1rem;
        }

        .nav-link {
            text-decoration: none;
            color: #000;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .nav-username {
            margin-right: 1rem;
            font-weight: bold;
            color: #000;
        }

        .navbar-title {
            margin-left: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #2f2c2c;
            padding-top: 20px;
            /* margin-top: 10px; */
        }

        .navbar-title a {
            display: flex;
            text-decoration: none;
            color: #2f2c2c;
        }

        .navbar-title h4 {
            margin-top: 5px;
            margin-left: 4px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<x-app-layout>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-1">
            <div class="bg-white bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-gray-100">
                    <h2 class="text-lg font-semibold">
                        Thread Name - {{ $thread->content }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-gray-100">
                    <h3 class="text-lg font-semibold">Existing Messages:</h3>
                    <hr class="my-4 border-gray-300 border-gray-700" />
                    <div class="mt-6">
                        <ul class="mt-4">
                            @foreach ($thread->comments as $message)
                                <li class="mb-4">
                                    created by:<span class=" font-semibold">
                                        {{ $message->user->name }}</span>
                                    <p class="ml-3 mt-2 text-gray-600 text-gray-400" style="color: blue;">
                                        {{ $message->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-4">
                        <form action="{{ url('thread', $thread->id) }}/message" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content"
                                    class="block text-gray-700 text-gray-400 font-bold mb-2">Message:</label>
                                <textarea name="content" id="content" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 border-gray-700 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-900"></textarea>
                            </div>
                            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
