export default class MessagesDisplay {
  constructor() {
    this.menuButtons = document.querySelectorAll('.js-messages-display');

    this.init();
  }

  init() {
      this.menuButtons.forEach((menuButton) => {
        menuButton.addEventListener('click', (e) => {
          e.target.closest('.m-messagesReceived__wrapper').classList.toggle('-open');
      });
    });  
  }
}