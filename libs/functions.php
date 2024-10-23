<?php
	//エスケープ処理を行う関数
	function h($var) {
		if(is_array($var)){
			//$varが配列の場合、h()関数をそれぞれの要素について呼び出す（再帰）
			return array_map('h', $var);
		}else{
			return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
		}
	}

	//テンプレートを表示する関数
	//第1パラメータ（$_template）：テンプレートファイル名
	//第2パラメータ（$data）：テンプレートで使うデータ（配列）
	function display($_template, $data) {
		//テンプレートで使う変数を生成し、値をエスケープ処理
		foreach($data as $key => $val){
			$$key = h($val);  
		}
		//変数作成後は、受け取った「$data」は、不要になるので破棄
		unset($data);
		//テンプレートを読み込む
		include dirname(__FILE__) . '/templates/'. $_template;
	}

	//入力値に不正なデータがないかなどを検証する関数
	function checkInput($var){
		if(is_array($var)){
			return array_map('checkInput', $var);
		}else{
			//php.iniでmagic_quotes_gpcが「on」の場合の対策
			// if(get_magic_quotes_gpc()){  
			//   $var = stripslashes($var);
			// }
			//NULLバイト攻撃対策
			if(preg_match('/\0/', $var)){  
			  die('不正な入力です。');
			}
			//文字エンコードのチェック
			if(!mb_check_encoding($var, 'UTF-8')){ 
			  die('不正な入力です。');
			}
			//改行、タブ以外の制御文字のチェック
			if(preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $var) === 0){  
			  die('不正な入力です。制御文字は使用できません。');
			}
			return $var;
		}
	}
?>