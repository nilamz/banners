		<?php
		require '/var/www/ikmanservices/banner_system/g-sheet-library/init.php';
		require '/var/www/ikmanservices/banner_system/db-con.php';
		//require '/var/www/ikmanservices/banner_system/form-handler.php';

		//Settings

		date_default_timezone_set('Asia/Colombo');

/**/	$banner = 'NewDBName';

		//put to db
		$sql = "
		CREATE TABLE `". $banner ."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(250) NOT NULL,
			`contact` char(20) NOT NULL,
			`time_stamp` datetime NOT NULL,
			`type` char(1) NOT NULL,
			`status` tinyint(1) NOT NULL,
			PRIMARY KEY (`id`),
			UNIQUE KEY `email_UNIQUE` (`contact`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		  ";
		if ($conn->query($sql) === TRUE) {
			echo 'Success';
		} else {
			echo "Error";
		}
		$conn->close();