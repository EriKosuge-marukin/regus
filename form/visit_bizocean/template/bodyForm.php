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
                        お名前<span class="must">※必須</span>
                    </p>
                    <p class="note">
                        正確にご入力下さい。
                    </p>
                </th>
                <td>
                    <div>
                        <p><input type="text" name="お名前" value="<?php echo $_SESSION["email"]; ?>"/></p>
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
                        平日の午前8時30分から午後6時の間からお選び下さい。時間外・土日祝をご希望の場合は別途ご連絡下さいませ。
                    </p>
                </th>
                <td>
                    <div>
                        <select name="month" id="selectMonth">
                            <option value="">月</option>
                            <?php for($i = 1; $i <= 12; $i++){ ?>
                                <option value="<?php echo $i; ?>" <?php if($i == intval($_SESSION["month"]))echo "selected"; ?>><?php echo $i; ?>月</option>
                            <?php } ?>
                        </select>
                        <select name="day" id="selectDay">
                            <option value="">日</option>
                            <?php for($i = 1; $i <= 31; $i++){ ?>
                                <option value="<?php echo $i; ?>" <?php if($i == intval($_SESSION["day"]))echo "selected"; ?>><?php echo $i; ?>日</option>
                            <?php } ?>
                        </select>
                        <select name="hour" id="selectHour">
                            <option value="">時</option>
                            <?php for($i = 0; $i <= 23; $i++){ ?>
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