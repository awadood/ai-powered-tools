import 'flowbite';
import { initFlowbite } from 'flowbite';
import { createIcons, icons } from 'lucide';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

const bootUi = () => {
    initFlowbite();
    createIcons({
        icons,
        attrs: {
            'stroke-width': 1.75,
        },
    });
};

window.Alpine = Alpine;
window.Livewire = Livewire;

Livewire.start();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootUi, { once: true });
} else {
    bootUi();
}

document.addEventListener('livewire:navigated', bootUi);
