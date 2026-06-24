window.onload = function() {
  var popup = document.getElementById('js-popup');
  //if(!popup) return;
  //popup.classList.add('is-show');

  var blackBg = document.getElementById('js-black-bg');
  var closeBtn = document.getElementById('js-close-btn');

  closePopUp(blackBg);
  closePopUp(closeBtn);

  function closePopUp(elem) {
    if(!elem) return;
    elem.addEventListener('click', function() {
      popup.classList.remove('is-show');popup.classList.add('already');
    })
  }
}

window.addEventListener("scroll", function () {
    const topBtn = document.getElementById("js-popup");
    const scroll = window.pageYOffset;
    
    if (scroll > 3000 && topBtn.classList.contains('already') == false ) {
      topBtn.style.opacity = 1;
      topBtn.classList.add('is-show');
    }
            else {topBtn.style.opacity = 0;}
  });


//window.addEventListener("scroll", function () {
   // const topBtn = document.getElementById("js-popup");
    //const scroll = window.pageYOffset;
    
    //if (scroll > 3000  ) {
      //topBtn.style.opacity = 1;
      //topBtn.classList.add('is-show');
    //} else topBtn.style.opacity = 0; 
  //});



//else if( topBtn.classList.contains('already') == true ){
        //console.log('Hello Sad');
        //topBtn.style.opacity = 0;
        //topBtn.classList.remove('is-show');
    //}