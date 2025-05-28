@php $nameAttr = $name ?? \Illuminate\Support\Str::slug($label, '_'); @endphp

<div>
    <label for="{{ $nameAttr }}" class="block text-sm mb-1 text-gray-700">{{ $label }}</label>
    <select name="{{ $nameAttr }}" id="{{ $nameAttr }}" class="w-full border rounded px-3 py-2 text-sm">
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
