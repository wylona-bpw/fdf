import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import './reveal-init.js';
import './counter-init.js';

Alpine.plugin(intersect);
Alpine.plugin(focus);
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();
