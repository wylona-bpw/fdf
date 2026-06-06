import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

// Counter component for impact numbers
Alpine.data('counter', (target) => ({
    value: 0,
    done: false,
    start() {
        if (this.done) return;
        this.done = true;
        const duration = 1800;
        const steps = 50;
        const increment = target / steps;
        let current = 0;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                this.value = target;
                clearInterval(timer);
            } else {
                this.value = Math.floor(current);
            }
        }, duration / steps);
    }
}));

window.Alpine = Alpine;
Alpine.start();

// Scroll reveal (vanilla, no plugin needed)
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
});
import './counter-init.js';
