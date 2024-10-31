<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>thanks</title>
</head>

<body class=" flex items-center justify-center min-h-screen">
    <div class="bg-white w-full p-8 text-center relative">
        <h1 class="text-9xl text-gray-100 absolute inset-0 flex items-center justify-center z-0 font-serif">Thank you</h1>

        <div class="relative z-10">
            <p class="text-lg font-semibold text-main-color mb-8">お問い合わせありがとうございました</p>

            <a href="/contact" class="bg-main-color hover:bg-button-color text-white font-bold py-2 px-4 rounded">
                HOME
            </a>
        </div>
    </div>
</body>

</html>