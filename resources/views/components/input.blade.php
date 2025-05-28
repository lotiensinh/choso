@props(['label' => '', 'value' => '', 'type' => 'text', 'name' => null])

<div>
    <label class="block text-sm mb-1 text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}"
        @if ($name) name="{{ $name }}" @endif
        value="{{ $value }}"
        class="w-full border rounded px-3 py-2 text-sm">
</div>
