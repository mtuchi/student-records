
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 /*
   Require dropdown
   source:http://behigh.github.io/bootstrap_dropdowns_enhancement/
 */
 require('../dropdowns-enhancement');

Vue.component('example', require('./components/Example.vue'));
// Vue.component('teacher-form', require('./components/TeacherForm.vue'));
// Vue.component('grade-list', require('./components/partials/Gradelist.vue'));
// Vue.component('subject-list', require('./components/partials/Subjectlist.vue'));

const app = new Vue({
    el: '#app'
});
