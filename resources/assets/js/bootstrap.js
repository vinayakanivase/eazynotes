
window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load faker.js which will allow us to generate fake data in the
 * browser and node.js.
 */
window.faker = require('faker');

/**
 * We'll load push.js which allows us to send Javascript based desktop
 * notifications using Notification API.
 */
window.Push = require('push.js');

/**
 * We'll load moment.js which allows us to parse, validate, manipulate, 
 * and display dates and times in JavaScript. We'll be using 'vue-moment' plugin
 * which has a dependency on this package.
 */
window.moment = require('moment');

/**
 * We'll load marked.js which is a light-weight compiler for parsing markdown.
 */
window.marked = require('marked');

/**
 * Next, we'll enable syntax highlighting with highlightjs.
 */
marked.setOptions({
    highlight: function(code) {
        return require('highlightjs').highlightAuto(code).value;
    },
});

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Next we will register the API Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached.
 * 
 * The API Token is required for accessing 'authenticated-only' routes.
 */

let api_token = document.head.querySelector('meta[name="api-token"]');

if (api_token) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token.content;
} else {
    console.error('API token not found.');
}

/**
 * We'll add our Base API URL to axios default options.
 */
axios.defaults.baseURL = 'http://eazynotes.io/api';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
