<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Choso') }}</title>

    {{-- Vite CSS --}}
    @vite(['resources/css/app.css'])

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Livewire --}}
    @livewireStyles

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-dark text-text font-sans">

    {{-- Header --}}
    @include('components.buyer-header')

    {{-- Main content --}}
    <main class="min-h-screen">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    @include('components.buyer-footer')

    {{-- Toast thông báo --}}
    <div 
        x-data="{ show: false, message: '' }"
        x-show="show"
        x-transition
        x-init="
            window.addEventListener('toast', e => {
                message = e.detail.message;
                show = true;
                setTimeout(() => show = false, 2000);
            })
        "
        class="fixed bottom-5 right-5 bg-[#00796B] text-[#E0F2F1] px-4 py-2 rounded-lg text-sm shadow z-[9999]"
        style="display: none;"
    >
        <span x-text="message"></span>
    </div>

    {{-- Vite JS + Livewire scripts --}}
    @vite('resources/js/app.js')
    @livewireScripts
    @stack('scripts')

    {{-- Icon bay vào giỏ --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('mousedown', () => {
                    const thumbnail = button.dataset.thumbnail;
                    const cartIcon = document.querySelector('#cart-icon');
                    if (!cartIcon || !thumbnail) return;

                    const rectFrom = button.getBoundingClientRect();
                    const rectTo = cartIcon.getBoundingClientRect();

                    const clone = document.createElement('img');
                    clone.src = thumbnail;
                    clone.style.position = 'fixed';
                    clone.style.zIndex = 9999;
                    clone.style.width = '60px';
                    clone.style.height = '60px';
                    clone.style.borderRadius = '8px';
                    clone.style.objectFit = 'cover';
                    clone.style.pointerEvents = 'none';
                    clone.style.transition = 'transform 0.8s ease-in-out, opacity 0.8s';
                    clone.style.opacity = 1;
                    clone.style.left = rectFrom.left + 'px';
                    clone.style.top = rectFrom.top + 'px';

                    document.body.appendChild(clone);

                    requestAnimationFrame(() => {
                        clone.style.transform = `
                            translate(${rectTo.left - rectFrom.left}px, ${rectTo.top - rectFrom.top}px)
                            scale(0.4) rotate(720deg)
                        `;
                        clone.style.opacity = 0;
                    });

                    setTimeout(() => clone.remove(), 900);
                });
            });
        });
    </script>
</body>
</html>
