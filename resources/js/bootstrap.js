import axios from 'axios';
import.meta.glob([
    '../images/**',
    '../fonts/**',
    '../icons/**',
]);

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
