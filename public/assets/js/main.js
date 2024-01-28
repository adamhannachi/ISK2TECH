let image = document.querySelector('.img');
/** j'ai crée function lorsque visiteur click sur photo prend place de  photo principale  */
function phones(phone){
    image.src = phone;
}


/** j'ai crée function lorsque visiteur click sur photo le background de la container se change   */
let container = document.querySelector('.container');
function colors(color){
   container.style.background = color;
}


/**  slider et items iphone */
let items = document.querySelectorAll('.slider .item');
let next = document.getElementById('next') ;
let prev = document.getElementById('prev');

/**j'ai créée function pour animer slider en 3d */
let active = 3;
function loadShow(){
   let stt= 0;
   items[active].style.transform =`none`;
   items[active].style.filter = `none`;
   items[active].style.opacity = 1;
   
   for(var i = active + 1; i< items.length; i++){
    stt++;
    items[i].style.transform =`translateX(${120*stt}px) scale(${1 -  0.2*stt}) perspective(16px) rotateY(-1deg)`;
    items[i].style.filter = 'blur(5px)';
    items[i].style.opacity = stt > 2 ? 0: 0.3;
   } 
   stt = 0;
   for(var i = active - 1; i >=0; i--){
      stt++;
      items[i].style.transform =`translateX(${-120*stt}px) scale(${1 -  0.2*stt}) perspective(16px) rotateY(1deg)`;
      items[i].style.filter = 'blur(5px)';
      items[i].style.opacity = stt > 2 ? 0: 0.3;
   
   }
   }
   loadShow();
   next.onclick = function(){
   active = active + 1 < items.length ? active + 1 :  active;
   loadShow();
   }
   
   prev.onclick = function(){
   active = active - 1 < items.length ? active - 1 :  active;
   loadShow();
   }

/**container qui contient produit ordinateur */
let ordinateurPortable = document.querySelector('.ordinateurPortable');
 
/**JQuery silder */

   $(document).ready(function(){

   $('.suivOrdinateur').click(function(){

      const now_img =  $('.show');
      const next_img = now_img.next();
      if( next_img.length){
         now_img.removeClass('show');
         next_img.addClass('show');
      }
     
   }); 

   $('.prevOrdinateur').click(function(){

      const now_img =  $('.show');
      const prev_img = now_img.prev();
      if( prev_img.length){
         now_img.removeClass('show');
         prev_img.addClass('show');
      }
     
   }); 

});








