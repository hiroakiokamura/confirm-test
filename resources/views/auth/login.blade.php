<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header>
            <div class="relative py-3 text-center border-b items-center">
                <h1 class="text-3xl text-main-color font-serif">FashonablyLate</h1>
                <a href="{{ route('register')}}" class="absolute top-3 right-4 bg-main-color hover:bg-button-color text-white py-1 px-4 font-serif">register</a>
            </div>
        </header>
        <div class="flex flex-col justify-center items-center h-screen bg-cream-color">
            <h2 class="text-center text-2xl text-main-color mb-6 font-serif">Login</h2>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <!-- ログインフォーム -->
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <!-- メールアドレス -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">メールアドレス</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                class="input-custom shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
                            @if($errors->has('email'))
                            <p class="text-red-500 mt-1">{{ $errors->first('email') }}</p>
                            @endif
                    </div>
                    <!-- パスワード -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">パスワード</label>
                            <input id="password" type="password" name="password"
                                class="input-custom shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-300">
                            @if($errors->has('password'))
                            <p class="text-red-500 mt-1">{{ $errors->first('password') }}</p>
                            @endif
                    </div>
                    <!-- ログインボタン -->
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-main-color hover:bg-button-color text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>