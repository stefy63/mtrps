
import './bootstrap';
import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';
import jQuery from 'jquery';

window.$ = window.jQuery = jQuery;

window.bootstrap = bootstrap;
window.Alpine = Alpine;

Alpine.start();

var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
)
var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})



$(document).on('input', '#taxable', function () {
    let raw = $(this).val();               // "123,45"
    let taxable = parseFloat(raw.replace(',', '.')) || 0;

    let vat = taxable * 0.22;
    let total = taxable + vat;

    $('#vat').val(vat.toFixed(2).replace('.', ','));
    $('#total').val(total.toFixed(2).replace('.', ','));
});

