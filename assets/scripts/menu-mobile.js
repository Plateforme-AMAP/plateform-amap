export default class ShowMenu {
  constructor() {
    this.menuButton = document.querySelector('.js-menu-Button');
    this.menu = document.querySelector('.js-menu-mobile');

    this.init();
  }

  init() {
      this.menuButton.addEventListener('click', (e) => {
        e.target.closest('.js-menu-mobile').classList.toggle('-open');
        if (this.menu.classList.contains('-open')){
          this.menuButton.src =  this.menuButton.src.replace("/icons/menu-sandwich.svg", "/icons/close-sandwich.svg"); 
        } else {
          this.menuButton.src =  this.menuButton.src.replace("/icons/close-sandwich.svg", "/icons/menu-sandwich.svg"); 
        }
    });
  }
}