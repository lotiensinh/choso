<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Choso') }}</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire --}}
    @livewireStyles

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-dark text-text font-sans">

    {{-- Header --}}
    @include('components.buyer-header')

    {{-- Content --}}
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

    {{-- Sidebar Cart --}}
    <div id="sidebar-container"></div>


    {{-- Livewire + Scripts --}}
    @stack('scripts')


<script>
    window.addEventListener('toggle-cart', async () => {
        const container = document.getElementById('sidebar-container');

        // Clear sidebar cũ nếu có
        container.innerHTML = '';

        // Mount lại sidebar mỗi lần bấm
        const { default: mount } = await window.Livewire.mount('sidebar-cart');
        container.appendChild(mount.el);
    });
</script>


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

<script>
    window.addEventListener('force-refresh-sidebar', () => {
        Livewire.restart();
    });
</script>


</body>
</html>
