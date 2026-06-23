window.addEventListener('load', function () {

 'use strict'

 gsap.fromTo('.jas-slide', {
  // opacity: 0
 }, {
  // opacity: 1,
  // ease: "power2.out",
  scrollTrigger: {
   // trigger: '.mav',
   // start: '100px 100px',
   // end: '+=400',
   // pin: true,
   // anticipatePin: 1,
   // invalidateOnRefresh: true,
   // scrub: 1
  }
 })


 // ScrollTrigger.matchMedia({

 //  "(min-width: 960px)": function () {
 //   gsap.fromTo('.js-anaime', {
 //    // x: '105%',

 //   }, {

 //    // x: 0,
 //    scrollTrigger: {
 //     // trigger: '.mva',
 //     // start: '100px 100px',
 //     // end: '+=400',
 //     // pin: true,
 //     // scrub: true,
 //     // anticipatePin: 1,
 //     // invalidateOnRefresh: true,
 //     //markers: true
 //    }
 //   });
 //  },

 //  "(min-width: 320px) and (max-width: 959px)": function () {
 //   gsap.fromTo('.js-aanime', {
 //    // x: '130%',

 //   }, {

 //    // x: 0,
 //    scrollTrigger: {
 //     // trigger: '.mav',
 //     // start: '100px 100px',
 //     // end: '+=400',
 //     // pin: true,
 //     // scrub: true
 //    }
 //   });
 //  },



 // });




 gsap.defaults({
  overwrite: 'auto'
 });


 var brandImages = document.querySelectorAll('.brand-pc__left img');
 var brandContents = document.querySelectorAll('.brand__contents');
 ScrollTrigger.matchMedia({
  '(min-width:961px)': function () {
   ScrollTrigger.create({
    trigger: brandContents[0],
    start: 'top center',
    end: 'bottom center',
    // markers: true,
    onEnterBack: () => {
     {
      brandImages[0].classList.add('is-active')
     }
    },
    onLeave: () => {
     {
      brandImages[0].classList.remove('is-active')
     }
    }
   })

   ScrollTrigger.create({
    trigger: brandContents[1],
    start: 'top center',
    end: 'bottom center',
    // markers: true,
    onEnter: () => {
     brandImages[1].classList.add('is-active')
    },
    onEnterBack: () => {
     {
      brandImages[1].classList.add('is-active')
     }
    },
    onLeave: () => {
     {
      brandImages[1].classList.remove('is-active')
     }
    },
    onLeaveBack: () => {
     {
      brandImages[1].classList.remove('is-active')
     }
    }
   })
   ScrollTrigger.create({
    trigger: brandContents[2],
    start: 'top center',
    end: 'bottom center',
    // markers: true,
    onEnter: () => {
     brandImages[2].classList.add('is-active')
    },
    onEnterBack: () => {
     {
      brandImages[2].classList.add('is-active')
     }
    },
    onLeave: () => {
     {
      brandImages[2].classList.remove('is-active')
     }
    },
    onLeaveBack: () => {
     {
      brandImages[2].classList.remove('is-active')
     }
    }
   })

   ScrollTrigger.create({
    trigger: brandContents[3],
    start: 'top center',
    end: 'bottom center',
    // markers: true,
    onEnter: () => {
     brandImages[3].classList.add('is-active')
    },
    onLeaveBack: () => {
     {
      brandImages[3].classList.remove('is-active')
     }
    }
   })
  }
 })

})