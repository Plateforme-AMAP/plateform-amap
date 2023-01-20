/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';


// any custom js is init here and hash in fontions on /scripts/
import MenuToggleDisplay from './scripts/menu-arbo';
import ShowUserCard from './scripts/user-section';
import FormsFieldsDisplay from './scripts/form-fields';

var App = {

    init: function () {
      // Inits elements common to every pages
      this.initMolecules();
    },
  
    initMolecules: function () {
        if (document.querySelector('.m-menuArbo')) {
            new MenuToggleDisplay(document.querySelector('.m-menuArbo'));
          }

        if (document.querySelector('.js-user-card')) {
            new ShowUserCard(document.querySelector('.js-user-card'));
        }

        if (document.getElementById('products_category')) {
          new FormsFieldsDisplay(document.getElementById('products_category'));
      }
    }
}

App.init();
