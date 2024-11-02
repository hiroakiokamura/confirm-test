<header>
    <div class="relative py-3 text-center border-b flex items-center justify-center">
        <h1 class="text-3xl text-main-color font-serif">FashonablyLate</h1>
        <form method="post" action="{{ route('logout') }}" class="absolute top-3 right-4 ml-auto">
            @csrf
            <button type="submit" class="absolute top-3 right-4 bg-main-color hover:bg-button-color text-white py-1 px-4 font-serif">logout</button>
        </form>
    </div>
</header>