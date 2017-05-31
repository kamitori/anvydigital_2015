<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			You recently asked AnvyDigital to reset your login password.<br />
			You can reset your own password by visiting the following page: {{ URL::to('account/reset', array($token)) }}<br />
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
			This process is designed to ensure the privacy and security of your account information.<br />
			Thank you for using AnvyDigital.<br />
			Best Regards,<br />
			AnvyDigital
		</div>
	</body>
</html>
