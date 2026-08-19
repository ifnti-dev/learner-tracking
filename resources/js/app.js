import $ from 'jquery';
import './bootstrap';
import './custom-dialogue'
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'

window.Alpine = Alpine;
window.Swal = Swal ;
window.$ = $;

Alpine.start();

