import './bootstrap';
import * as bootstrap from 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
)
var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

