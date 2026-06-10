document.addEventListener("DOMContentLoaded", function () {
  // スマートフォンの判定（幅768px以下をSP版とする）
  if (window.innerWidth <= 768) {
      // 各ボタンのリンクを変更
      const links = {
          "sp-button01": "https://www.regus-office.jp/area-search/",
          "sp-button02": "https://www.regus-office.jp/coworking-spaces/coworking_list/",
          "sp-button03": "https://www.regus-office.jp/service/virtualoffice/virtualoffice/",
          "sp-button04": "https://www.regus-office.jp/services-business-lounges/",
          "sp-button05": "https://www.regus-office.jp/service/meetingroom/meetingroom/"
      };

      // 各ボタンを取得し、リンクを変更
      Object.keys(links).forEach(className => {
          const button = document.querySelector(`.${className}`);
          if (button) {
              button.setAttribute("href", links[className]);
          }
      });
  }
});
