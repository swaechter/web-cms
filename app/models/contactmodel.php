<?php

/**
 * The class ContactModel provides a mail system.
 */
class ContactModel extends Model
{
	/**
	 * Check if the system has an existing mail configuration.
	 *
	 * @return boolean Status of the action
	 */
	public function hasMailConfiguration()
	{
		if($this->getDatabaseManager()->getOneEntry("MailConfiguration"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Get an existing mail configuration.
	 *
	 * @return MailConfiguration|null Mail configuration
	 */
	public function getMailConfiguration()
	{
		if($this->hasMailConfiguration())
		{
			return $this->getDatabaseManager()->getOneEntry("MailConfiguration");
		}
		else
		{
			return new MailConfiguration();
		}
	}
	
	/**
	 * Save a mail configuration.
	 *
	 * @param MailConfiguration Mail configuration
	 */
	public function saveMailConfiguration($mailconfiguration)
	{
		return $this->getDatabaseManager()->saveEntry($mailconfiguration);
	}
	
	/**
	 * Send a mail based on the mail configuration.
	 *
	 * @param MailConfiguration Mail configuration
	 * @param string $email Email address of the user
	 * @param string $name Name of the user
	 * @param string $title Title of the message
	 * @param string $text Text of the message
	 * @return boolean Status of the action
	 */
	public function sendMail($mailconfiguration, $email, $name, $title, $text)
	{
		try
		{
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = $mailconfiguration->getSmtpServer();
			$mail->SMTPAuth = true;
			$mail->Username = $mailconfiguration->getUsername();
			$mail->Password = $mailconfiguration->getPassword();
			$mail->SMTPSecure = 'tls';
			$mail->Port = $mailconfiguration->getPort();
			$mail->From = $email;
			$mail->FromName = $name;
			$mail->addAddress($mailconfiguration->getSender(), $mailconfiguration->getSender());
			$mail->Subject = $title;
			$mail->Body = $text;
			$mail->send();
			return true;
		}
		catch(Exception $exception)
		{
			return false;
		}
	}
}

?>
