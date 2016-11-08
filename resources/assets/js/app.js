// Require Bootstrap
require('./bootstrap');

// Require DataTables for jQuery with styling for Bootstrap
// require('datatables.net-bs');

/*
  Require dropdown
  source:http://behigh.github.io/bootstrap_dropdowns_enhancement/
*/
  require('../bower_components/dropdown/dropdowns-enhancement');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
  var VueResource = require('vue-resource');

  Vue.component('export', require('./components/Export.vue'));
  Vue.component('example', require('./components/Example.vue'));
  Vue.use(VueResource);

  const app = new Vue({
      el: '#app'
  });
