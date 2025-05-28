<div class="w-full md:w-64">
    <h3 class="text-lg font-semibold mb-3">📂 Categories</h3>
    <ul class="space-y-2">
        @foreach ($categories as $cat)
            <li>
                <a href="{{ route('danh-muc', ['slug' => $cat->slug]) }}"
                   class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('danh-muc/' . $cat->slug) ? 'bg-gray-800' : '' }}">
                    {{ $cat->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
