<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- BootstrapのCSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQueryとBootstrapのJS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>admin-dashborad</title>
</head>

<body class="">
    <!-- ヘッダー -->
    <header>
        <div class="relative py-3 text-center border-b flex items-center justify-center">
            <h1 class="text-3xl text-main-color font-serif">FashonablyLate</h1>
            <form method="post" action="{{ route('logout') }}" class="absolute top-3 right-4 ml-auto">
                @csrf
                <button type="submit" class="absolute top-3 right-4 bg-main-color hover:bg-button-color text-white py-1 px-4 font-serif">
                    logout
                </button>
            </form>
        </div>
        @auth
        <p>ログイン済みです...。</p>
        @endauth

        @guest
        <p>ログインしていません。</p>
        @endguest
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-center text-2xl font-bold text-main-color mb-6">Admin</h2>

        <form method="GET" action="{{ route('searchContact') }}" class="flex justify-between items-center space-x-2">
            <!-- 名前またはメールアドレス検索 -->
            <input
                type="text"
                name="keyword"
                placeholder="名前やメールアドレスを入力してください"
                class="border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200 text-sm w-1/4"
                value="{{ request('keyword') }}">

            <!-- 性別検索 -->
            <select
                name="gender"
                class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200">
                <option disabled selected>性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>男性</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>女性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>その他</option>
            </select>

            <!-- お問い合わせ種類検索 -->
            <select
                name="category_id"
                class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200">
                <option disabled selected>お問い合わせの種類</option>
                @foreach($categories ?? [] as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <!-- 日付検索 -->
            <input
                type="date"
                name="contact_date"
                class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200"
                value="{{ request('contact_date') }}">

            <!-- 検索ボタン -->
            <button
                type="submit"
                class="bg-main-color hover:bg-button-color text-white px-4 py-2 rounded">
                検索
            </button>

            <!-- リセットボタン -->
            <a
                href="{{ route('searchContact') }}"
                class="bg-cream-color hover:bg-main-color text-white px-4 py-2 rounded">
                リセット
            </a>
        </form>

        <div class="flex justify-between">
            <!-- エクスポートボタンを含むフォーム -->
            <form action="{{ route('contact.export') }}" method="GET" class="mx-2 my-4">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="contact_date" value="{{ request('contact_date') }}">
                <button type="submit" class="export__btn btn bg-cream-color hover:bg-main-color px-4 py-2 rounded">
                    エクスポート
                </button>
            </form>

            @if ($paginate && $contacts->hasPages())
            <div class="mt-4 text-right">
                {{ $contacts->links() }}
            </div>
            @endif

        </div>

        <div class="min-h-[300px] overflow-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-main-color text-white text-left">
                        <th class="px-4 py-2">お名前</th>
                        <th class="px-4 py-2">性別</th>
                        <th class="px-4 py-2">メールアドレス</th>
                        <th class="px-4 py-2">お問い合わせの種類</th>
                        <th class="px-4 py-2">詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @if($contacts->isEmpty())
                    <p class="text-center py-4">検索結果がありません。</p>
                    @else
                    @foreach($contacts ?? [] as $contact)
                    <tr class="border text-main-color">
                        <td class="px-4 py-3">{{ $contact->last_name }}{{ $contact->first_name }}</td>
                        <td class="px-4">
                            @php
                            $genderText = '';
                            if ($contact->gender === 0) {
                            $genderText = '男性';
                            } elseif ($contact->gender === 1) {
                            $genderText = '女性';
                            } elseif ($contact->gender === 2) {
                            $genderText = 'その他';
                            }
                            @endphp
                            {{ $genderText }}
                        </td>
                        <td class="px-4">{{ $contact->email }}</td>
                        <td class="px-4">{{ $contact->category->content }}</td>
                        <td class="px-4">
                            <!-- 詳細ボタンでモーダルにリンク -->
                            <a href="#modal-{{ $contact->id }}" class="bg-cream-color hover:bg-main-color text-main-color px-4 rounded">
                                詳細
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    @endif
                </tbody>
            </table>
        </div>

        @foreach($contacts as $contact)
        <div id="modal-{{ $contact->id }}" class="modal fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
            <div class="modal__content bg-[#fdf7f2] rounded-lg p-6 max-w-md w-full shadow-lg relative">
                <a href="#" class="modal__close-btn absolute top-2 right-3 text-3xl text-[#5a4634] hover:text-[#cc4c39] font-bold">&times;</a>
                <div class="modal__body">
                    <p class="text-[#8d7358] mb-4"><strong>名前</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>性別</strong> {{ $genderText }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>メールアドレス</strong> {{ $contact->email }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>電話番号</strong> {{ $contact->tell }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>住所</strong> {{ $contact->address }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>建物名</strong> {{ $contact->building }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>お問い合わせの種類</strong> {{ $contact->category->content }}</p>
                    <p class="text-[#8d7358] mb-4"><strong>お問い合わせ内容</strong> {{ $contact->detail }}</p>
                </div>
                <div class="text-center mt-4">
                    <a href="#confirm-delete-{{ $contact->id }}" class="bg-red-500 text-white px-4 py-2 rounded">削除</a>
                </div>
            </div>
        </div>
        <!-- 削除確認用モーダル -->
        <div id="confirm-delete-{{ $contact->id }}" class="modal fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
            <div class="modal__content bg-[#fdf7f2] rounded-lg p-4 max-w-xs w-full shadow-lg relative my-8 text-sm">
                <p class="text-center text-[#8d7358] mb-4">本当に削除してよいですか？</p>
                <div class="flex justify-around">
                    <!-- 削除実行 -->
                    <form method="post" action="{{ route('contact.destroy', ['id' => $contact->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">はい</button>
                    </form>
                    <!-- 戻るボタン -->
                    <a href="#modal-{{ $contact->id }}" class="bg-gray-300 text-black px-4 py-2 rounded">いいえ</a>
                </div>
            </div>
        </div>
        @endforeach
    </main>

    <!-- <script>
        var exportUrl = "{{ route('contact.export') }}";
    </script>
    <script src="{{ asset('js/contact.js') }}"></script> -->
</body>

</html>