
import './bootstrap';
import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';
import jQuery from 'jquery';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

window.$ = window.jQuery = jQuery;

window.bootstrap = bootstrap;
window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
)
var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

