document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggleButton");
    const closeButton = document.getElementById("close_btn");
    const narrow_btn = document.getElementById("narrow_btn");
    const content = document.getElementById("content");

    // toggleButtonを押すと、contentを開閉
    toggleButton.addEventListener("click", function () {
      content.classList.toggle("hidden");
    });

    // close_btnを押したときのみ閉じる
    closeButton.addEventListener("click", function (event) {
      event.preventDefault(); // フォーム送信を防ぐ
      content.classList.add("hidden");
    });

    // narrow_btnを押したとき
    narrow_btn.addEventListener("click", function (event) {
      event.preventDefault(); // フォーム送信を防ぐ
      content.classList.add("hidden");

      const list_area = document.querySelector("div.list_area.toc-cover");
      if (list_area) {
        list_area.remove();
      }

      const remove_span = document.querySelector("span.nodata");
      if (remove_span) {
        remove_span.remove();
      }

      const checkboxes = document.querySelectorAll('input[name="checkbox_button"]');
      const selectedValues = [];

      checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
          selectedValues.push(checkbox.value);
        }
      });

/*
      const narrow_down_span = document.querySelector("div.narrow_down div span");
      narrow_down_span.style.display = (narrow_down_span && selectedValues.length == 0) ? 'none' : 'inline';
*/
      toggleButton.innerHTML = `<img src="/spaces_page/images/narrow_down_icon.png" alt="">` +
        (selectedValues.length == 0 ? 'エリア内絞り込み' : '<span>絞り込み結果を表示中</span>');

      const office_boxes = document.querySelectorAll('div.office_box');
      let filter = [];
      let data_count = 0;

      office_boxes.forEach(function(office_box) {
        office_box.style.display = 'none';
        let office_flex = office_box.nextElementSibling;
        if (office_flex && office_flex.classList.contains("office_flex")) {
          office_flex.style.display = "none";
        }
        if (office_box.hasAttribute('data-filter')) {
          filter = office_box.getAttribute('data-filter').split(',');
        }
        if (selectedValues.every(element => filter.includes(element))) {
          data_count++;
          office_box.style.removeProperty("display");
          if (office_flex && office_flex.classList.contains("office_flex")) {
            office_flex.style.removeProperty("display");
          }
        }
      });

      if (office_boxes.length != data_count) {
        console.log(office_boxes.length, data_count);
        document.querySelector("div.narrow_down .n_reset").style.removeProperty("display");
      } else {
        document.querySelector("div.narrow_down .n_reset").style.display = "none";
      }

      const div = document.querySelector("div.office");
      if (data_count == 0) {
        const span = document.createElement("span");
        span.innerHTML = "申し訳ございませんが、この検索条件に該当するレンタルオフィスが見つかりませんでした。<br>条件を変えて再検索してください。";
        span.classList.add("nodata");
        div.insertAdjacentElement("beforebegin", span);
        div.style.display = 'none';
      } else {
        div.style.display = 'block';
      }
    });

    // reset_btnを押したとき
    document.querySelectorAll("div.narrow_down .reset_btn").forEach(element => {
      element.addEventListener("click", function (event) {
        // デフォルトの動作（リンク遷移）をキャンセル
        event.preventDefault();

        // formリセット
        document.querySelector("#content form").reset();

        // n_resetが無い場合は終了
        if (!element.classList.contains('n_reset')) {
          return;
        }

        // toggleButtonテキスト
        toggleButton.innerHTML = `<img src="/spaces_page/images/narrow_down_icon.png" alt="">エリア内絞り込み`;

        // nodata削除
        const remove_span = document.querySelector("span.nodata");
        if (remove_span) {
          remove_span.remove();
        }

        // office_box全表示
        const office_boxes = document.querySelectorAll('div.office_box');
        office_boxes.forEach(function(office_box) {
          office_box.style.removeProperty("display");
          let office_flex = office_box.nextElementSibling;
          if (office_flex && office_flex.classList.contains("office_flex")) {
            office_flex.style.removeProperty("display");
          }
        });

        // div.office表示
        const div = document.querySelector("div.office");
        div.style.display = 'block';

        // n_reset非表示
        document.querySelector("div.narrow_down .n_reset").style.display = "none";
      });
    });


  });
