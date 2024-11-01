@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<h2 class="text-center text-2xl font-bold text-main-color mb-6">Admin</h2>

@include('partials.search_form')

<div class="flex justify-between my-4">
    @include('partials.export_button')
    @if ($paginate && $contacts->hasPages())
    <div class="mt-4 text-right">{{ $contacts->links() }}</div>
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
            @forelse($contacts as $contact)
            <tr class="border text-main-color">
                <td class="px-4 py-3">{{ $contact->last_name }}{{ $contact->first_name }}</td>
                <td class="px-4">{{ $contact->gender == 0 ? '男性' : ($contact->gender == 1 ? '女性' : 'その他') }}</td>
                <td class="px-4">{{ $contact->email }}</td>
                <td class="px-4">{{ $contact->category->content }}</td>
                <td class="px-4"><a href="#modal-{{ $contact->id }}" class="bg-cream-color hover:bg-main-color text-main-color px-4 rounded">詳細</a></td>
            </tr>

            <!-- 詳細モーダル -->
            @include('partials.contact_modal', ['contact' => $contact])

            @empty
            <tr>
                <td colspan="5" class="text-center py-4">検索結果がありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection