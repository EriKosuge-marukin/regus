<article>
    <form action="./" method="post">
        <?php if(!$isAdminSend) : ?>
        <p class="sendError">メールが正しく送信できませんでした。</p>
        <?php endif; ?>
        <table>
            <tr class="title">
                <th colspan="2">
                    <h2><img src="common/images/title_form.gif" alt="見学予約フォーム"/></h2>
                </th>
            </tr>
            <tr class="form01">
                <th>
                    <p class="description">
                        お問い合わせ時にご入力いただきましたお客様のメールアドレスをご入力ください。
                    </p>
                </th>
                <td>
                    <div>
                        <p><?php echo $_SESSION["email"]; ?></p>
                    </div>
                </td>
            </tr>
            <tr class="form02">
                <th>
                    <p class="description">
                        見学希望センターをお選び下さい。
                    </p>
                </th>
                <td>
                    <div>
                        <p><?php echo $_SESSION["center"]; ?></p>
                    </div>
                </td>
            </tr>
            <tr class="form03">
                <th>
                    <p class="description">
                        見学希望日をお選び下さい。
                    </p>
                    <p class="note">
                        平日の午前8時30分から午後6時の間からお選び下さい。時間外・土日祝をご希望の場合は別途ご連絡下さいませ。
                    </p>
                </th>
                <td>
                    <div>
                        <p><?php echo $_SESSION["month"]."月".$_SESSION["day"]."日".$_SESSION["hour"]."時",$_SESSION["minute"]."分"; ?></p>
                    </div>
                </td>
            </tr>
            <tr class="form04">
                <th>
                    <p class="description">
                        ご興味のあるサービスについて<br>お選び下さい。
                    </p>
                </th>
                <td>
                    <div>
                        <?php foreach($_SESSION["service"] as $value){ ?>
                        <p><?php echo $value; ?></p>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </table>
        <input type="submit" class="btnSend" value=""/>
        <input type="hidden" name="sequence" value="send"/>
        <input type="hidden" name="unique_key" value="<?php echo $unique_key; ?>"/>
    </form>
</article>