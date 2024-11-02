<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>confirm</title>
    </head>
    <body>
        <head>
            <div class=" py-3 text-center border-b items-center">
                <h1 class=" text-main-color text-3xl font-serif">FashonablyLate</h1>
            </div>
        </head>
        <div class="container mx-auto p-4">
            <form action="{{ route('store') }}" method="post">
                @csrf
                <h2 class="text-main-color text-center text-2xl mb-6 font-serif">Confirm</h2>
                <table class="table-auto w-full text-left">
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">お名前</th>
                            <td class=" text-main-color border px-4 py-2">{{ $last_name }} {{ $first_name }}</td>
                        </tr>
                        <input type="hidden" name="first_name" value="{{ $first_name }}">
                        <input type="hidden" name="last_name" value="{{ $last_name }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">性別</th>
                            <td class=" text-main-color border px-4 py-2">{{ $gender }}</td>
                        </tr>
                        <input type="hidden" name="gender" value="{{ $gender }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">メールアドレス</th>
                            <td class=" text-main-color border px-4 py-2">{{ $email }}</td>
                        </tr>
                        <input type="hidden" name="email" value="{{ $email }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">電話番号</th>
                            <td class=" text-main-color border px-4 py-2">{{ $phone1 }}{{ $phone2 }}{{ $phone3 }}</td>
                        </tr>
                        <input type="hidden" name="phone1" value="{{ $phone1 }}">
                        <input type="hidden" name="phone2" value="{{ $phone2 }}">
                        <input type="hidden" name="phone3" value="{{ $phone3 }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">住所</th>
                            <td class=" text-main-color border px-4 py-2">{{ $address }}</td>
                        </tr>
                        <input type="hidden" name="address" value="{{ $address }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">建物名</th>
                            <td class=" text-main-color border px-4 py-2">{{ $building }}</td>
                        </tr>
                        <input type="hidden" name="building" value="{{ $building }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">お問い合わせの種類</th>
                            <td class=" text-main-color border px-4 py-2">{{ $category }}</td>
                        </tr>
                        <input type="hidden" name="category" value="{{ $category }}">
                    </div>
                    <div>
                        <tr>
                            <th class=" bg-main-color text-white border px-4 py-2">お問い合わせ内容</th>
                            <td class=" text-main-color border px-4 py-2">{{ $detail }}</td>
                        </tr>
                        <input type="hidden" name="detail" value="{{ $detail }}">
                    </div>
                </table>
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-main-color hover:bg-button-color text-white font-bold py-1 px-5 mx-4 ">送信</button>
                    <button type="submit" name="back" value="back" class=" hover:text-gray-400 text-main-color font-bold py-1 px-5 ml-4 "><span class="border-b">修正</span></button>
                </div>
            </form>
        </div>
    </body>
</html>