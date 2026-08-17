import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import './reveal-init.js';
import './counter-init.js';

Alpine.plugin(intersect);

window.Alpine = Alpine;
Alpine.start();
