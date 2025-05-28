@props(['categories'])

<form method="GET" class="bg-gray-800 p-4 rounded-lg space-y-3 w-full">
    <h3 class="text-white text-lg font-semibold mb-2">🎯 Filter</h3>
<select name="category_id"
        class="w-full bg-gray-700 text-white px-3 py-2 rounded outline-none focus:ring">
    <option value="">-- Chọn danh mục --</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}"
                @if(request('category_id') == $category->id) selected @endif>
            {{ $category->name }}
        </option>
    @endforeach
</select>

    <input type="number" name="min_price" placeholder="Giá thấp nhất"
       value="{{ request('min_price') }}"
       class="w-full bg-gray-700 text-white px-3 py-2 rounded outline-none focus:ring">

<input type="number" name="max_price" placeholder="Giá cao nhất"
       value="{{ request('max_price') }}"
       class="w-full bg-gray-700 text-white px-3 py-2 rounded outline-none focus:ring">

    <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold w-full py-2 rounded transition">
        Áp dụng
    </button>
</form>
