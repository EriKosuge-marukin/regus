
    <script src="ui/jquery.js"></script>
    <script src="ui/jquery-ui.min.js"></script>
    <script src="ui/jquery.ui.datepicker-ja.js"></script>

    <link rel="stylesheet" href="ui/jquery-ui.min.css"/>
    <link rel="stylesheet" href="ui/jquery-ui.structure.min.css"/>
    <link rel="stylesheet" href="ui/jquery-ui.theme.min.css"/>
    <style>
	body{
		font: 62.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	.ui-datepicker-trigger{
		vertical-align: sub;
		margin-right: 10px;
	}
	</style>
    <script>

  $(function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "ui/images/calendar.png",
      buttonImageOnly: true,
      buttonText: "見学希望日",
      onSelect: function (dateText) {
          var objDate = new Date(dateText);
          var chkinDate = objDate.getDate();
          var chkinMonth = objDate.getMonth()+1;
          $('#selectDay').val(chkinDate);
          $('#selectMonth').val(chkinMonth);
          $('#selectMonthDay').val(chkinMonth+"月"+chkinDate+"日");
      }
    });
  });
  <?php if($_SESSION["month"] && $_SESSION["day"]){?>
  $( document ).ready(function() {
	  $('#datepicker').datepicker("setDate", new Date(<?php echo date("Y");?>, <?php echo ($_SESSION["month"]-1);?>, <?php echo ($_SESSION["day"]);?>) );
  });
  <?php }?>
  </script>
<article>
    <form action="./" method="post">
        <table>
            <tr class="title">
                <th colspan="2">
                    <h2><img src="common/images/title_form.gif" alt="見学予約フォーム"/></h2>
                </th>
            </tr>
            <tr class="form01">
                <th>
                    <p class="description">
                        お問い合わせ時にご入力いただきましたお客様のメールアドレスをご入力ください。<span class="must">※必須</span>
                    </p>
                    <p class="note">
                        正確にご入力下さい。
                    </p>
                </th>
                <td>
                    <div>
                        <p><input type="text" name="email" value="<?php echo $_SESSION["email"]; ?>"/></p>
                        <?php if($error["email"]) : ?>
                        <p class="error">この質問は必須です</p>
                        <?php elseif($error["emailCheck"]) : ?>
                        <p class="error">正しいメールアドレスの形式でありません</p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr class="form02">
                <th>
                    <p class="description">
                        見学希望センターをお選び下さい。<span class="must">※必須</span>
                    </p>
                </th>
                <td>
                    <div>
                        <p><select name="center" id="selectCenter">
                                <option value=""></option>
                                <optgroup label="東京">
                                    <?php foreach($office["tokyo"] as $value){ ?>
                                    <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="横浜">
                                    <?php foreach($office["yokohama"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="千葉">
                                    <?php foreach($office["chiba"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="北海道">
                                    <?php foreach($office["hokkaido"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="東北">
                                    <?php foreach($office["tohoku"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
								<optgroup label="関東">
                                    <?php foreach($office["kanto"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="名古屋">
                                    <?php foreach($office["nagoya"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="京都・大阪・神戸">
                                    <?php foreach($office["kinki"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="中国地方">
                                    <?php foreach($office["chugoku"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                                <optgroup label="九州">
                                    <?php foreach($office["kyushu"] as $value){ ?>
                                        <option value="<?php echo $value; ?>" <?php if($_SESSION["center"] == $value)echo "selected"; ?>><?php echo $value; ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select></p>
                        <?php if($error["center"]) : ?>
                        <p class="error">この質問は必須です</p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr class="form03">
                <th>
                    <p class="description">
                        見学希望日をお選び下さい。<span class="must">※必須</span>
                    </p>
                    <p class="note">
                        平日の午前8時30分から午後6時の間からお選び下さい。時間外・土日祝をご希望の場合は別途ご連絡下さいませ。<br/>
                        <font color="red">※所要時間は通常45分～1時間程度です。</font>
                    </p>
                </th>
                <td>
                    <div>
                        <input type="text" placeholder="例) 1月1日" name="monthday" id="selectMonthDay" value="<?php if($_SESSION["month"]){echo $_SESSION["month"]."月";} if($_SESSION["day"]){echo $_SESSION["day"]."日";}?>"style="background-color: #F8F8F8; width: 120px; border: 1px #A9A9A9 solid;" readonly="readonly" onfocus="$('#datepicker').datepicker('show');"/>
                        <input type="hidden" name="month" id="selectMonth" value="<?php echo $_SESSION["month"]; ?>"/>
                        <input type="hidden" name="day" id="selectDay" value="<?php echo $_SESSION["day"]; ?>" />
                        <input type="hidden" id="datepicker" >
                        <select name="hour" id="selectHour">
                            <option value="">時</option>
                            <?php for($i = 8; $i <= 19; $i++){ ?>
                                <option value="<?php echo sprintf("%02d", $i); ?>" <?php if(sprintf("%02d", $i) == $_SESSION["hour"])echo "selected"; ?>><?php echo sprintf("%02d", $i); ?></option>
                            <?php } ?>
                        </select>
                        <select name="minute" id="selectMinute">
                            <option value="">分</option>
                            <?php for($i = 0; $i < 4; $i++){ ?>
                                <option value="<?php echo sprintf("%02d", 15 * $i); ?>" <?php if(sprintf("%02d", 15 * $i) == $_SESSION["minute"])echo "selected"; ?>><?php echo sprintf("%02d", 15 * $i); ?></option>
                            <?php } ?>
                        </select>
                        <?php if($error["month"] || $error["day"] || $error["hour"] || $error["minute"]) : ?>
                            <p class="error">この質問は必須です</p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr class="form04">
                <th>
                    <p class="description">
                        ご興味のあるサービスについて<br>お選び下さい。<span class="must">※必須</span>
                    </p>
                    <p class="note">
                        複数選択可
                    </p>
                </th>
                <td>
                    <div>
                        <p><input type="checkbox" name="service[]" id="service01" value="レンタルオフィス" <?php if(in_array("レンタルオフィス", $_SESSION["service"]))echo "checked"; ?>/><label for="service01">(1)レンタルオフィス</label></p>
                        <p><input type="checkbox" name="service[]" id="service02" value="バーチャルオフィス" <?php if(in_array("バーチャルオフィス", $_SESSION["service"]))echo "checked"; ?>/><label for="service02">(2)バーチャルオフィス</label></p>
                        <p><input type="checkbox" name="service[]" id="service03" value="時間貸し会議室・デイオフィス" <?php if(in_array("時間貸し会議室・デイオフィス", $_SESSION["service"]))echo "checked"; ?>/><label for="service03">(3)時間貸し会議室・デイオフィス</label></p>
                        <p><input type="checkbox" name="service[]" id="service04" value="ビジネスワールド（ビジネスラウンジ）" <?php if(in_array("ビジネスワールド（ビジネスラウンジ）", $_SESSION["service"]))echo "checked"; ?>/><label for="service04">(4)ビジネスワールド（ビジネスラウンジ）</label></p>
                        <?php if($error["service"]) : ?>
                        <p class="error">１つ以上選択して下さい</p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
        <input type="submit" class="btnConfirm" value=""/>
        <input type="hidden" name="sequence" value="confirm"/>
        <input type="hidden" name="unique_key" value="<?php echo $unique_key; ?>"/>
    </form>
</article>