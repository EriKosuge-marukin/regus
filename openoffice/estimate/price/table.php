<?php
include_once(dirname(__FILE__).'/../../dashboard/library/openClass.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err_flg = false; // エラー発生時true
$data_row = 6; // 一行辺りのデータ数

$use_array = array(
		'0' => '即入居可',
		'1' => '利用中',
		'2' => '予約受付中',
	);
$use_array_class = array(
		'0' => 'vacunt',
		'1' => 'busy',
		'2' => 'available',
);

if(isset($_GET['c_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_center WHERE center_id = :c_id", array("c_id"=>$_GET['c_id']));
	if($check_res['cnt'] != 1) $err_flg = true;

	if(!$err_flg) {
		$datas = $dbClass->Select("SELECT center_id, num, use_flg, people, price_12mon, public FROM m_office WHERE center_id = :c_id AND floor = :floor", array("c_id"=>$_GET['c_id'], 'floor'=>$_GET['floor']));

		$data_cnt = 0; // データ数
		foreach($datas as $val) {
			foreach($val as $key => $val2) {
				$str = mb_convert_encoding($val2, 'SJIS');
				switch($key) {
					case 'center_id':
						$datas_id[] = $str;
						break;
					case 'num':
						$datas_num[] = $str;
						break;
					case 'use_flg':
						$datas_use_flg[] = $str;
						break;
					case 'people':
						$datas_people[] = $str;
						break;
					case 'price_12mon':
						$datas_price_12mon[] = number_format($str);
						break;
					case 'public':
						$datas_public[] = number_format($str);
						break;
				}
			}
			$data_cnt++;
		}

		// ループ回数の設定
		$loop_cnt = $data_cnt/$data_row;
		if($data_cnt%$data_row == 0) $loop_cnt -= 1;
	}
} else {
	$err_flg = true;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<link href="/openoffice/css/room.css" rel="stylesheet" type="text/css">
<link href="/openoffice/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php if(!$err_flg): ?>
<div class="priceouter">
	<table class="pricetable" id="price_minamiaoyama">
		<thead>
			<tr class="blank">
				<td></td>
				<td colspan="7" class="price_info">※表示の価格には消費税は含まれておりません。</td>
			</tr>
		</thead>
		<tbody>
			<?php for($loop=0; $loop<=$loop_cnt;$loop++): ?>
			<tr class="head">
				<th>部屋Type</th>
				<?php for($i=$loop*$data_row; $i<$data_row*($loop+1); $i++): ?>
				<th>
				<?php if(isset($datas_num[$i])): ?>
				<a href="../../estimate/estimate.php?c_id=<?php echo $datas_id[$i]; ?>&o_id=<?php echo $datas_num[$i]; ?>" target="_parent" style="color: white;text-decoration: underline;"><?php echo $datas_num[$i];?></a>
				<?php endif; ?>
				</th>
				<?php endfor; ?>
			</tr>
			<tr>
				<th>ご利用の目安</th>
				<?php for($i=$loop*$data_row; $i<$data_row*($loop+1); $i++): ?>
				<td><?php echo (isset($datas_people[$i]))? $datas_people[$i].'名様':''; ?></td>
				<?php endfor; ?>
			</tr>
			<?php endfor; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>
</body>
</html>