export default class ShowFilter {
    constructor() {
      this.buttonFilter = document.querySelector('.js-filter-button');

      this.init();
    }
  
    init() {
        this.buttonFilter.addEventListener('click', (e) => {
                e.target.closest('.js-filter-wrapper').classList.toggle("-open");
            });            
    }
  }