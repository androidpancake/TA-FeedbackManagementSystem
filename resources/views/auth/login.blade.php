<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../../public/css/tailwind.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @vite('resource/css/app.css')
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Document</title>
</head>
<body>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md p-4 bg-white rounded-lg sm:p-6 md:p-8">
            <form class="space-y-3" action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="flex justify-center">
                    <img src="{{ asset('storage/image/logo.png')}}" class="h-auto max-w-xs" alt="">
                </div>
                <h5 class="text-3xl font-semibold text-center text-gray-900 dark:text-white">Log in</h5>
                <p class="text-center text-gray-600">Silakan log in untuk melanjutkan</p>
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SSO</label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-green-500 focus:ring focus:border-green-500 block w-full p-2.5" placeholder="username SSO" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input name="password" type="password" id="password" placeholder="*******" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                </div>
                <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value="" class="w-4 h-4 text-green-500 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-300" required>
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                <button class="btn-sm btn-primary bg-green-500 p-2 rounded text-white w-full font-medium">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>