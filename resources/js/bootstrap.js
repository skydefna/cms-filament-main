import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import ApexTree from 'apextree'
window.ApexTree = ApexTree;

// import $ from 'jquery';
// window.jQuery = window.$ = $; // Make jQuery globally available
