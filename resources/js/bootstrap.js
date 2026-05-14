import axios from 'axios';
window.axios = axios;

// This tells Axios to identify itself as an AJAX request
// Very important for Laravel's security and middleware!
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
