		<?php
		require_once '/var/www/ikmanservices/banner_system/leadmanager/vendor/autoload.php';
		$gSheet = new LeadManager\GSheet();
		$mail = new LeadManager\Mail();
		$db = new LeadManager\Db();
		date_default_timezone_set('Asia/Colombo');

/**/	$code = 'NewDBName';    //campaing code (without space or special characters)
/**/	$spreadsheetId = 'GSheetID';    //G-Sheet

		//Lead details
		$name = sanitize_input($_POST['name']);
		$contact = sanitize_input($_POST['contact']);
		$email = sanitize_input($_POST['email']);

		//Email
/**/	$to = ['banner.info@ikman.lk'];
/**/	$cc = ['banner.info@ikman.lk','ishara.dilshan@ikman.lk'];
		$bcc = '';
/**/	$subject = 'ikman.lk Campaign - Sample Microsite';
		$body =
			'Hello,' . '<br/>' . '<br/>' .
			'A user has been contacted via ikman.lk and submitted the following information to us.' . '<br/>' . '<br/>' .
			'Name: ' . $name . '<br/>' .
			'Contact: ' . $contact . '<br/>' .
			'City: ' . $email . '<br/>' .
			'Thank You' . '<br/>' .
			'Ikman.lk (Pvt) LTD' . '<br/>';
		$altBody = 'Hello, A user have been contacted via ikman.lk and submitted the following information to us.'
			. 'Name: ' . $name
			. 'Contact: ' . $contact
			. 'City: ' . $email
			. 'Thank You. Ikman.lk (Pvt) LTD';

		//-----------------------------Don't Edit after here----------------------------------------------
		$values = [
			[
				date("Y-m-d h:i:sa"),
				$name,
				$contact,
				$email,
			],
		];
		$db->init($code);
		if ($db->save($name, $contact, $code)) {
			//save to G-Sheet
/**/		$gSheet->append($values, $spreadsheetId, 'Web');

			//send Email
			$mail->send($to, $cc, $bcc, $subject, $body, $altBody);
		}

		echo 1;