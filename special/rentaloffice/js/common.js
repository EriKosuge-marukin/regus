// =========================
// アコーディオン
// =========================
$(".accordion-header").click(function () {
  $(this).next().slideToggle();
  $(this).toggleClass("active");
});

// =========================
// タブ切り替え
// =========================
function setupTabs(tabSelector, targetSelectors, pcOnly = false) {
  const tabs = document.querySelectorAll(tabSelector);

  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
      if (pcOnly && window.innerWidth < 769) return;

      // タブ切り替え
      tabs.forEach((t) => t.classList.remove("active"));
      tab.classList.add("active");

      // 対象要素切り替え
      targetSelectors.forEach((selector) => {
        const targets = document.querySelectorAll(selector);

        targets.forEach((target) => {
          target.classList.remove("active");
        });

        targets[index]?.classList.add("active");
      });
    });
  });
}

// Sec03のタブ切り替え
setupTabs(".tab__item", [".tab__panel"]);

// 拠点・料金を見るのタブ切り替え
setupTabs(
  ".office__search--region button",
  [".office__content", ".office__search--area"],
  true,
);

// =========================
// SPマップモーダル内のボタンをクリック
// #を取得して、対象のタブを開く
// =========================
$(".js-office-anchor").on("click", function (e) {
  e.preventDefault();

  const href = $(this).attr("href");
  const target = $(href);
  if (!target.length) return;

  // 対象のoffice__content取得
  const content = target.closest(".office__content");
  if (!content.length) return;

  const index = $(".office__content").index(content);

  // =========================
  // active切替
  // =========================
  $(".office__search--region button").removeClass("active");
  $(".office__content").removeClass("active");
  $(".office__search--region button").eq(index).addClass("active");
  $(".office__content").eq(index).addClass("active");
});
