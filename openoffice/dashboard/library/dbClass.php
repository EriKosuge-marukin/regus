<?php
include_once (dirname(__FILE__).'/../include/config.ini.php');

class dbClass{
	private $DB; //ＤＢ接続

	/**
	 * コンストラクター
	 *
	 * @param $connection DB接続情報
	 */
	function connect($config){
		try {
			$this->DB = new PDO($config['driver'].':host='.$config['host'].';dbname='.$config['database'], $config['login'], $config['password']);
			if (isset($config['encoding']) && !empty($config['encoding'])) {
				$this->DB->query('SET NAMES '.$config['encoding']);
			}
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB CONNECT ERROR.');
		}
	}

	/**
	 * 追加(try{}catch無し)
	 *
	 * @param string $table DBテーブル名
	 * @param array $data データ
	 * @param int 追加した行数
	 */
	function InsertNoCatch($table, $data){
		$sql="INSERT INTO {$table} ";
		$field="";
		$fieldParam="";
		$param=array();
		foreach ($data as $key=>$val) {
			if($field){
				$field.=",";
				$fieldParam.=",";
			}
			$field.="{$key} ";
			$fieldParam.=":{$key} ";
			$param[":{$key}"]=$val;
		}

		$sql.="(".$field.")VALUES(".$fieldParam.")";

		$query = $this->DB->prepare($sql);
		$query->execute($param);

		// 			ve($query->errorInfo());
		if($query->rowCount()){
			if($this->DB->lastInsertId()){
				return $this->DB->lastInsertId();
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	/**
	 * 追加
	 *
	 * @param string $table DBテーブル名
	 * @param array $data データ
	 * @param int 追加した行数
	 */
	function Insert($table, $data){
		try {
			return $this->InsertNoCatch($table, $data);
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB INSERT ERROR.');
		}
	}

	/**
	 * 更新(try{}catch無し)
	 *
	 * @param string $table DBテーブル名
	 * @param array $data データ
	 * @param string $conditionTxt 更新条件
	 * @param array $conditionValue 更新条件値
	 * @return int 更新した行数
	 */
	function UpdateNoCatch($table, $data, $conditionTxt="", $conditionValue=array()){
		$sql="UPDATE {$table} SET ";
		$field="";
		$param=array();
		foreach ($data as $key=>$val) {
			if($field){
				$field.=",";
			}
			if($val===null){
				$field.=$key."=null ";
			}else{
				$field.=$key."=:{$key} ";
				$param[":{$key}"]=$val;
			}
		}

		$sql.=$field;
		if($conditionTxt){
			$sql.=" WHERE ".$conditionTxt;
			foreach ($conditionValue as $key=>$val) {
					$param[":{$key}"]=$val;
			}
		}

		$query = $this->DB->prepare($sql);
		$query->execute($param);

		return $query->rowCount();
	}

	/**
	 * 更新
	 *
	 * @param string $table DBテーブル名
	 * @param array $data データ
	 * @param string $conditionTxt 更新条件
	 * @param array $conditionValue 更新条件値
	 * @return int 更新した行数
	 */
	function Update($table, $data, $conditionTxt="", $conditionValue=array()){
		try {
			return $this->UpdateNoCatch($table, $data, $conditionTxt, $conditionValue);
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB UPDATE ERROR.');
		}
	}

	/**
	 * 削除(try{}catch無し)
	 *
	 * @param string $table DBテーブル名
	 * @param string $conditionTxt 削除条件
	 * @param array $conditionValue 削除条件値
	 * @param int 削除した行数
	 */
	function DeleteNoCatch($table, $conditionTxt="", $conditionValue=array()){
		$param=array();
		$sql="DELETE FROM {$table}";
		if($conditionTxt){
			$sql.=" WHERE ".$conditionTxt;
			foreach ($conditionValue as $key=>$val) {
				$param[":{$key}"]=$val;
			}
		}

		$query = $this->DB->prepare($sql);
		$query->execute($param);
		return $query->rowCount();
	}

	/**
	 * 削除
	 *
	 * @param string $table DBテーブル名
	 * @param string $conditionTxt 削除条件
	 * @param array $conditionValue 削除条件値
	 * @param int 削除した行数
	 */
	function Delete($table, $conditionTxt="", $conditionValue=array()){
		try {
			return $this->DeleteNoCatch($table, $conditionTxt, $conditionValue);
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB DELETE ERROR.');
		}
	}

	/**
	 * クエリ実行(try{}catch無し)
	 *
	 * @param string $sql クエリ
	 * @param string $param 条件値
	 * @param int 行数
	 */
	function ExecuteNoCatch($sql, $param=array()){
		$query = $this->DB->prepare($sql);
		$query->execute($param);

		if($query->rowCount()){
			if($this->DB->lastInsertId()){
				return $this->DB->lastInsertId();
			}else{
				return $query->rowCount();
			}
		}else{
			return false;
		}
	}

	/**
	 * クエリ実行
	 *
	 * @param string $sql クエリ
	 * @param string $param 条件値
	 * @param int 行数
	 */
	function Execute($sql, $param=array()){
		try {
			return $this->ExecuteNoCatch($sql, $param);
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB EXECUTE ERROR.');
		}
	}


	/**
	 * 取得クエリ
	 *
	 * @param string $sql クエリ
	 * @param array $param 条件値
	 * @param int 結果
	 */
	function Select($sql, $param=array()){
		try {
			$query = $this->DB->prepare($sql);
			$query->execute($param);
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB SELECT ERROR.');
		}
	}
	/**
	 * 取得クエリ
	 *
	 * @param string $sql クエリ
	 * @param string $param 条件値
	 * @param int 結果
	 */
	function SelectOne($sql, $param=array()){
		try {
			$query = $this->DB->prepare($sql);
			$query->execute($param);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			return $result;
		}catch (PDOException $e) {
			$_SESSION["lasterror"]=$e->getMessage();
			if(defined('ERROR_URL')){
				header("location: ".ERROR_URL."error.php");
			}
			die('DB SELECT ONE ERROR.');
		}
	}

	/**
	 * トランザクションを開始する
	 */
	function beginTransaction(){
		$this->DB->beginTransaction();
	}

	/**
	 * トランザクションをコミットする
	 */
	function commit(){
		$this->DB->commit();
	}

	/**
	 * トランザクションをロールバックする
	 */
	function rollBack(){
		$this->DB->rollBack();
	}
}
?>
