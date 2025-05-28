import './bootstrap';

import Alpine from 'alpinejs';
import { Livewire, livewire_hot_reload } from 'virtual:livewire-hot-reload';

window.Alpine = Alpine;
window.Livewire = Livewire;

Alpine.start();
Livewire.start();
livewire_hot_reload(); // ✅ bắt buộc để dùng .mount()
