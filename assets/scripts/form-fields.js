// export default class FormsFieldsDisplay {
//     constructor() {
//       this.categorySelector = document.getElementById('products_category');
//       this.unityField = document.getElementById('products_unity');
//       this.unities = document.querySelectorAll('#products_unity > option');
//       this.init();
//     }
  
//     init() {
//       this.unityField.setAttribute('disabled', '');
//       this.unities[0].disabled = true;
//       this.categorySelector[0].disabled = true;
//       this.categorySelector.addEventListener('click', () => {
//             this.unityField.disabled = false;
//             this.unityField.removeAttribute('title');
//             this.unityField.classList.remove('-disabled');
//             if(this.categorySelector.value == '1'){
//                 this.unities[1].disabled = false;
//                 this.unities[2].disabled = false;
//                 this.unities[3].disabled = false;
//                 this.unities[4].disabled = false;
//                 this.unities[5].disabled = true;
//                 this.unities[6].disabled = true;
//                 this.unities[7].disabled = true;
//                 this.unities[8].disabled = true;
//               } else if (this.categorySelector.value == '2'){
//                 this.unities[1].disabled = true;
//                 this.unities[2].disabled = true;
//                 this.unities[3].disabled = true;
//                 this.unities[4].disabled = true;
//                 this.unities[5].disabled = false;
//                 this.unities[6].disabled = false;
//                 this.unities[7].disabled = false;
//                 this.unities[8].disabled = false;
//             }
//           });
//     }
//   }