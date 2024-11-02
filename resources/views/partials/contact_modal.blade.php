<div id="modal-{{ $contact->id }}" class="modal fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="modal__content bg-[#fdf7f2] rounded-lg p-6 max-w-md w-full shadow-lg relative">
        <a href="#" class="modal__close-btn absolute top-2 right-3 text-3xl text-[#5a4634] hover:text-[#cc4c39] font-bold">&times;</a>
        <div class="modal__body">
            <p class="text-[#8d7358] mb-4"><strong>名前</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
            <p class="text-[#8d7358] mb-4"><strong>性別</strong> {{ $contact->gender == 0 ? '男性' : ($contact->gender == 1 ? '女性' : 'その他') }}</p>
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
            <form method="post" action="{{ route('contact.destroy', ['id' => $contact->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">はい</button>
            </form>
            <a href="#modal-{{ $contact->id }}" class="bg-gray-300 text-black px-4 py-2 rounded">いいえ</a>
        </div>
    </div>
</div>