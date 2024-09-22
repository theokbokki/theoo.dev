import axios from 'axios';
import.meta.glob([
    '../images/**',
    '../fonts/**',
    '../icons/**',
    '../favicons/**.svg',
    '../favicons/**.png',
    '../favicons/**.ico',
    '../favicons/**.webmanifest',
]);

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
