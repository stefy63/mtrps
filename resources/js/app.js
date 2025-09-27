
import './bootstrap';
import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
)
var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

