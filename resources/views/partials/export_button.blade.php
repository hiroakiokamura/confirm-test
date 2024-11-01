<form action="{{ route('contact.export') }}" method="GET" class="mx-2">
    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
    <input type="hidden" name="contact_date" value="{{ request('contact_date') }}">
    <button type="submit" class="export__btn btn bg-cream-color hover:bg-main-color px-4 py-2 rounded">エクスポート</button>
</form>