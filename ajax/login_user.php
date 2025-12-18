<?php
	session_start();
	include("../settings/connect_datebase.php");
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	// ищем пользователя
	$query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`= '".$password."';");
	
	$id = -1;
	while($user_read = $query_user->fetch_row()) {
		$id = $user_read[0];
	}
	
	if($id != -1) {
		$_SESSION['user'] = $id;
		// 1) сщздать сессию
		// 2) записать события 
		$ip = $_SERVER["REMOTE_ADDR"];
		$DateStart = date(format: "Y-m-d H:i:s");

		// Получаем ID сессии
			$sql = "SELECT `id` FROM `session` WHERE `DateStart` = ?";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("s", $DateStart);
			$stmt->execute();
			$result = $stmt->get_result();
			$Read = $result->fetch_assoc();
			$_SESSION["IdSession"] = $Read["id"];





			$Sql = "INSERT INTO `logs` (`ip`, `IdUser`, `Date`, `TimeOnline`, `Event`)
			VALUES ('$ip', '$id', '$DateStart', '00:00:00', 'Пользователь $login авторизовался')";
	$mysqli->query($Sql);
	}
	echo md5(md5($id));
?>