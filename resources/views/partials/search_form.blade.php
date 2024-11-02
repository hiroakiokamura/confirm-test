<form method="GET" action="{{ route('searchContact') }}" class="flex justify-between items-center space-x-2">
    <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" class="border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200 text-sm w-1/4" value="{{ request('keyword') }}">
    <select name="gender" class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200">
        <option disabled selected>性別</option>
        <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>男性</option>
        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>女性</option>
        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>その他</option>
    </select>
    <select name="category_id" class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200">
        <option disabled selected>お問い合わせの種類</option>
        @foreach($categories ?? [] as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
        @endforeach
    </select>
    <input type="date" name="contact_date" class="border text-main-color border-gray-300 rounded px-4 py-2 focus:ring focus:ring-gray-200" value="{{ request('contact_date') }}">
    <button type="submit" class="bg-main-color hover:bg-button-color text-white px-4 py-2 rounded">検索</button>
    <a href="{{ route('searchContact') }}" class="bg-cream-color hover:bg-main-color text-white px-4 py-2 rounded">リセット</a>
</form>