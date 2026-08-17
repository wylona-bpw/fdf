import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';
import './reveal-init.js';
import './counter-init.js';

Alpine.plugin(intersect);
Alpine.plugin(focus);

window.Alpine = Alpine;
Alpine.start();
