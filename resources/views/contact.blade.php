<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>contact</title>
    </head>
    <body class=" bg-white text-main-color">
        <head>
            <div class=" py-3 text-center border-b items-center">
                <h1 class="text-3xl  font-serif">FashonablyLate</h1>
            </div>
        </head>
        <div class="container mx-auto py-4">
            <main>
                <div class="max-w-4xl mx-auto bg-white p-8 rounded">
                    <h2 class="text-2xl font-serif text-center mb-6">Contact</h2>
                    <form action="{{ route('confirm') }}" method="POST" novalidate>
                        @csrf
                        <!-- お名前 -->
                        <div class=" grid grid-cols-3 flex mb-4">
                            <div class="block col-span-1">
                                <label for="first_name">お名前 <span class="text-red-500">＊</span></label>
                            </div>
                            <div class="flex  col-span-2 space-x-4">
                                <input type="text" name="last_name" id="last_name" placeholder="例: 山田" class=" input-custom w-1/2 px-4 py-2 border rounded " value="{{old('last_name')}}">
                                @if($errors->has('last_name'))
                                <p class="text-red-500 mt-1">{{ $errors->first('last_name') }}</p>
                                @endif
                                <input type="text" name="first_name" id="first_name" placeholder="例: 太郎" class=" input-custom w-1/2 px-4 py-2 border rounded" value="{{old('first_name')}}">
                                @if($errors->has('first_name'))
                                <p class="text-red-500 mt-1">{{ $errors->first('first_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- 性別 -->
                        <div class=" grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="gender">性別 <span class="text-red-500">＊</span></label>
                            <div class=" col-span-2 flex items-center space-x-4">
                                <label><input type="radio" name="gender" value="男性" class=" custom-radio mr-2" checked> 男性</label>
                                <label><input type="radio" name="gender" value="女性" class=" custom-radio mr-2"> 女性</label>
                                <label><input type="radio" name="gender" value="その他" class=" custom-radio mr-2"> その他</label>
                                @if($errors->has('gender'))
                                <p class="text-red-500 mt-1">{{ $errors->first('gender') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- メールアドレス -->
                        <div class=" grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1 " for="email">メールアドレス <span class="text-red-500">＊</span></label>
                            <div class=" col-span-2 w-full ">
                                <input type="email" name="email" id="email" placeholder="例: test@example.com" class=" input-custom w-full px-4 py-2  border rounded" value="{{old('email')}}">
                                @if($errors->has('email'))
                                <p class="text-red-500 mt-1">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- 電話番号 -->
                        <div class="grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="phone">電話番号 <span class="text-red-500">＊</span></label>
                            <div class="flex col-span-2 space-x-4 items-center">
                                <input type="text" name="phone1" placeholder="例: 080" class=" input-custom w-1/3 px-4 py-2 border rounded" value="{{old('phone1')}}">
                                @if($errors->has('phone1'))
                                <p class="text-red-500 mt-1">{{ $errors->first('phone1') }}</p>
                                @endif
                                <span>-</span>
                                <input type="text" name="phone2" placeholder="例: 1234" class=" input-custom w-1/3 px-4 py-2 border rounded" value="{{old('phone2')}}">
                                @if($errors->has('phone2'))
                                <p class="text-red-500 mt-1">{{ $errors->first('phone2') }}</p>
                                @endif
                                <span>-</span>
                                <input type="text" name="phone3" placeholder="例: 5678" class=" input-custom w-1/3 px-4 py-2 border rounded" value="{{old('phone3')}}">@if($errors->has('phone3'))
                                <p class="text-red-500 mt-1">{{ $errors->first('phone3') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- 住所 -->
                        <div class="grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="address">住所 <span class="text-red-500">＊</span></label>
                            <div class=" col-span-2 w-full ">
                                <input type="text" name="address" id="address" placeholder="例: 東京都新宿区千駄ヶ谷1-2-3" class=" input-custom w-full px-4 py-2 border rounded" value="{{old('address')}}">
                                @if($errors->has('address'))
                                <p class="text-red-500 mt-1">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- 建物名 -->
                        <div class="grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="building">建物名</label>
                            <input type="text" name="building" id="building" placeholder="例: 千駄ヶ谷マンション101" class="   input-custom col-span-2 w-full px-4 py-2 border rounded" value="{{old('building')}}">
                        </div>
                        <!-- お問い合わせの種類 -->
                        <div class=" grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="category">お問い合わせの種類 <span class="text-red-500">＊</span></label>
                            <div class=" col-span-2 w-full ">
                                <select name="category" id="category" class=" input-custom w-full px-4 py-2 border rounded">
                                    <option disabled selected>選択してください</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->content}}" {{ old('category') == $category->content ? 'selected' : '' }}>{{ $category->content }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('category'))
                                <p class="text-red-500 mt-1">{{ $errors->first('category') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- お問い合わせ内容 -->
                        <div class=" grid grid-cols-3 flex mb-4">
                            <label class="block col-span-1" for="message">お問い合わせ内容 <span class="text-red-500">＊</span></label>
                            <div class=" col-span-2 w-full ">
                                <textarea name="detail" id="detail" rows="5" class=" input-custom w-full px-4 py-2 border rounded" placeholder="お問い合わせ内容をご記載ください">{{old('detail')}}</textarea>
                                @if($errors->has('detail'))
                                <p class="text-red-500 mt-1">{{ $errors->first('detail') }}</p>
                                @endif
                            </div>
                        </div>
                        <!-- 確認画面 -->
                        <div class="text-center">
                            <button type="submit" class="m-6 px-6 py-2 bg-button-main-color text-white bg-main-color rounded">確認画面</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </body>
</html>