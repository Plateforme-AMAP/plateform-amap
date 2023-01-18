export default class ShowUserCard {
    constructor() {
      this.cardUser = document.querySelector('.js-user-card');
      this.cardButtons = document.querySelectorAll('.js-user-button');
      this.cardZone = document.querySelector('.js-user-zone');

      this.init();
    }
  
    init() {

        this.cardButtons.forEach((cardButton) => {
            cardButton.addEventListener('click', (e) => {
                this.cardUser.classList.toggle("-open");
                this.cardZone.classList.toggle("-visible");
            });            
        });
        
        this.cardZone.addEventListener('click', (e) => {
            if (this.cardZone.classList.contains('-visible')) {
                this.cardUser.classList.remove("-open");
                this.cardZone.classList.remove("-visible");                    
            };
        });

    }
  }
