<?php

/**
 * The file contactmodel.php contains the functionality to send mails.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

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
	
	/**
	 * Generate a captcha image.
	 *
	 * @return boolean Status of the action
	 */
	public function generateCaptchaImage()
	{
		$width = 60;
		$height = 30;
		$noise_level = 15;
		$code = rand(1000, 9999);
		
		$image = imagecreatetruecolor($width, $height);
		$background = imagecolorallocate($image, 230, 80, 0);
		$foreground = imagecolorallocate($image, 255, 255, 255);
		$noise = imagecolorallocate($image, 200, 200, 200);
		
		imagefill($image, 0, 0, $background);
		
		imagestring($image, 5, 10, 8,  $code, $foreground);
		
		for ($i = 0; $i < $noise_level; $i++)
		{
			for ($j = 0; $j < $noise_level; $j++)
			{
				imagesetpixel($image, rand(0, $width), rand(0, $height), $noise);
			}
		}
		
		//generate the png image
		if(!imagepng($image, DATA_DIRECTORY . "image_captcha.png"))
		{
			return false;
		}
		
		imagedestroy($image);
		
		Utils::setSession("ContactCaptcha", $code);
		
		return true;
	}
	
	/**
	 * Get the user captcha from his session and clear it
	 *
	 * @return string Captcha string
	 */
	public function getUserCaptcha()
	{
		$captcha = Utils::getSession("ContactCaptcha");
		Utils::setSession("ContactCaptcha", null);
		return $captcha;
	}
}

?>
