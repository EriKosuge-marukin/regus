// --------------------
// アコーディオン
// --------------------
$(".accordion-header").click(function () {
  $(this).next().slideToggle();
  $(this).toggleClass("active");
});


// --------------------
// タブ切り替え
// --------------------
function setupTabs(tabSelector, targetSelectors, pcOnly = false) {
  // タブ要素を取得
  const tabs = document.querySelectorAll(tabSelector);
  // タブと連動して表示を切り替える要素群を取得
  const targetGroups = targetSelectors.map((selector) =>
    document.querySelectorAll(selector)
  );

  // 指定したインデックスのタブをアクティブ化
  const activateTab = (index) => {
    // タブのactiveを切り替え
    tabs.forEach((tab) => tab.classList.remove("active"));
    tabs[index]?.classList.add("active");

    // 対応するコンテンツのactiveを切り替え
    targetGroups.forEach((targets) => {
      targets.forEach((target) => target.classList.remove("active"));
      targets[index]?.classList.add("active");
    });
  };

  // タブクリック時の処理
  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
      // PC限定の場合はSPで処理しない
      if (pcOnly && window.innerWidth < 769) return;
      activateTab(index);
    });
  });

  return activateTab;
}

// スクロール時のヘッダー分オフセット
const HEADER_OFFSET = window.innerWidth < 769 ? 15 : 81;

// 通常タブ
const activateTab = setupTabs(".tab__item", [".tab__panel"]);

// エリア検索タブ（PCのみ切り替え可能）
setupTabs(
  ".office__search--region button",
  [".office__content", ".office__search--area"],
  true,
);

// ページ内リンク　該当のタブを開きたい時
document.querySelectorAll(".js-anchor").forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();

    // data属性から表示するタブ番号とスクロール先を取得
    const tabIndex = Number(link.dataset.tab);
    const target = document.querySelector(link.dataset.target);

    if (!target) return;

    // 対応するタブを表示
    activateTab(tabIndex);

    // タブ切り替え後に対象位置へスムーススクロール
    setTimeout(() => {
      window.scrollTo({
        top:
          target.getBoundingClientRect().top +
          window.scrollY -
          HEADER_OFFSET,
        behavior: "smooth",
      });
    }, 100);
  });
});


// --------------------
// SPマップモーダル内のボタンをクリック
// #を取得して、対象のタブを開く
// --------------------
$(".js-office-anchor").on("click", function (e) {
  e.preventDefault();

  const href = $(this).attr("href");
  const target = $(href);
  if (!target.length) return;

  // 対象のoffice__content取得
  const content = target.closest(".office__content");
  if (!content.length) return;

  // office__cntentが何番目かを取得
  const index = $(".office__content").index(content);

  // active切替
  $(".office__search--region button").removeClass("active");
  $(".office__content").removeClass("active");
  $(".office__search--region button").eq(index).addClass("active");
  $(".office__content").eq(index).addClass("active");
});