export default class MenuToggleDisplay {
    constructor() {
      this.menuButton = document.querySelector('.js-menu-button');
      this.menuZone = document.querySelector('.js-menu-zone');
      this.menu = document.querySelector('.m-menuArbo');
      this.icon = document.querySelector('.js-menu-button img');

      this.init();
    }
  
    init() {
        this.menuButton.addEventListener('click', (e) => {
            e.target.closest('.m-menuArbo').classList.toggle('-open');
            if (this.menu.classList.contains('-open')){
              this.icon.src =  this.icon.src.replace("/icons/tree.svg", "/icons/close.svg"); 
            } else {
              this.icon.src =  this.icon.src.replace("/icons/close.svg", "/icons/tree.svg"); 
            }
        });
        this.menuZone.addEventListener('click', (e) => {
          e.target.closest('.m-menuArbo').classList.toggle('-open');
        });
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
  
