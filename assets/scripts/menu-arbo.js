export default class MenuToggleDisplay {
    constructor() {
      this.menu = document.querySelector('.js-menu-element');
      this.menuButton = document.querySelector('.js-menu-button');
      this.init();
    }
  
    init() {
        this.menuButton.addEventListener('click', () => {
            console.log("connecté !");
        })
    }
  }


//   const menuToggleDisplay = () => {
//     this.menu = document.querySelector('.js-menu-element');
//     this.menuButton = document.querySelector('.js-menu-button');
//     menuButton.addEventListener('click', () => {
//         console.log("connecté !");
//     })
//   }

//   menuToggleDisplay();
  
