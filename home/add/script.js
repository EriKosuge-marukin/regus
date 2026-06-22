const area = document.querySelectorAll(".search__map-text-block");
const areaTitles = document.querySelectorAll(".search__map-text-title");
const maps = document.querySelectorAll(".search__map-active-img");

const newClass = area.forEach((el) => {
  const data = el.dataset.region;

  el.addEventListener("mouseenter", function () {
    areaTitles.forEach((areaTitle) => {
      areaTitle.classList.remove("is-active");
      if (areaTitle.classList.contains(`search__map-text-title--${data}`)) {
        areaTitle.classList.add("is-active");
      }
    });
    maps.forEach((map) => {
      map.classList.remove("is-active");
      if (map.classList.contains(`search__map-active-${data}`)) {
        map.classList.add("is-active");
      }
    });
  });

  el.addEventListener("mouseleave", function () {
    areaTitles.forEach((areaTitle) => {
      if (areaTitle.classList.contains(`search__map-text-title--${data}`)) {
        areaTitle.classList.remove("is-active");
      }
    });
    maps.forEach((map) => {
      if (map.classList.contains(`search__map-active-${data}`)) {
        map.classList.remove("is-active");
      }
    });
  });
});

const spBtns = document.querySelectorAll(".search-sp__btn");
const modalParent = document.querySelector(".sp-modal");
const spModals = document.querySelectorAll(".sp-modal__container");
const backs = document.querySelectorAll(".sp-modal__back");

let openIndex = 0;

backs.forEach((back) => {
  back.addEventListener("click", (e) => {
    e.preventDefault();
    modalParent.classList.remove("is-active");
    spModals[openIndex].classList.remove("is-active");
  });
});

const backs2 = document.querySelectorAll(".sp-modal__back_area");
let openIndex_area = 0;
backs2.forEach((back) => {
  back.addEventListener("click", (e) => {
    e.preventDefault();
    modalParent.classList.remove("is-active");
    spModals[openIndex].classList.remove("is-active");
  });
});

spBtns.forEach((spBtn, index) => {
  spBtn.addEventListener("click", () => {
    openIndex = index;
    modalParent.classList.add("is-active");
    spModals[openIndex].classList.add("is-active");
  });
});

const spTokyoLinks = document.querySelectorAll(".sp-modal__link_tokyo");
spTokyoLinks.forEach((spTokyoLink, index) => {
  //spTokyoLink.addEventListener("click", () => {
  spTokyoLink.addEventListener("click", function (e) {
    document.querySelector("button.sp-modal__back").click();
    //document.querySelector('button[data-val="tokyo"]').click();
    this.closest(".search__inner")
      .querySelector('button[data-val="tokyo"]')
      .click();
  });
});

function closeAllModals() {
  document.querySelectorAll(".modal").forEach((modal) => {
    if (modal.classList.contains("active")) {
      modal.classList.remove("active");
      setTimeout(() => modal.setAttribute("hidden", true), 300);
    }
  });
}

// モーダルの開閉処理
document.querySelectorAll(".search-fv__btn").forEach((button) => {
  button.addEventListener("click", () => {
    closeAllModals();

    const region = button.dataset.val;
    const modal = document.getElementById(`modal-${region}`);
    if (modal) {
      modal.removeAttribute("hidden");
      setTimeout(() => modal.classList.add("active"), 10);

      // 閉じるボタンの設定
      modal.querySelector(".close-btn").addEventListener(
        "click",
        () => {
          modal.classList.remove("active");
          setTimeout(() => modal.setAttribute("hidden", true), 300);
        },
        { once: true },
      );
    }
  });
});