<?php

/**
 * The file contactcontroller.php is contains the contact controller which
 * is responsible for the contact form and sending mails.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class ContactController is responsible for the contact form.
 */
class ContactController extends Controller implements ModuleController
{
	/**
	 * Show the contact site.
	 */
	public function index()
	{
		$contactmodel = new ContactModel($this);
		if($contactmodel->hasMailConfiguration())
		{
			if($contactmodel->generateCaptchaImage())
			{
				$this->getView()->setData("FILEPATH", DATA_DIRECTORY . "image_captcha.png");
			}
			else
			{
				$this->getView()->setData("ERROR", "Das System kann kein Captcha Bild generieren.");
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Die Maileinstellungen sind nicht richtig konfiguriert. Bitte kontaktieren Sie den Seitenbetreiber.");
		}
	}
	
	/**
	 * Process the index action
	 */
	public function processindex()
	{
		$contactmodel = new ContactModel($this);
		if($contactmodel->hasMailConfiguration())
		{
			if(Utils::hasPostString("captcha") && Utils::hasPostEmail("email") && Utils::hasPostString("name") && Utils::hasPostString("title") && Utils::hasPostText("text"))
			{
				if($contactmodel->getUserCaptcha() == Utils::getPost("captcha"))
				{
					$mailconfiguration = $contactmodel->getMailConfiguration();
					if($mailconfiguration)
					{
						if($contactmodel->sendMail($mailconfiguration, Utils::getPost("email"), Utils::getPost("name"), Utils::getPost("title"), Utils::getPost("text")))
						{
							$this->getView()->setData("SUCCESS", "Ihre Mail wurde erfolgreich versendet.");
						}
						else
						{
							$this->getView()->setData("ERROR", "Ihre Mail konnte nicht versendet werden.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "Die Maileinstellungen sind nicht richtig konfiguriert. Bitte kontaktieren Sie den Seitenbetreiber.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Ihr eingegebener Captcha stimmt nicht mit dem Captcha des Bildes überein.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie den Captcha, den Namen, die Emailadresse, den Titel und den Text an.");
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Die Maileinstellungen sind nicht richtig konfiguriert. Bitte kontaktieren Sie den Seitenbetreiber.");
		}
	}
	
	/**
	 * Show the contact admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$contactmodel = new ContactModel($this);
			$mailconfiguration = $contactmodel->getMailConfiguration();
			if($mailconfiguration)
			{
				$this->getView()->setData("MAILCONFIGURATION", $mailconfiguration);
			}
			else
			{
				$this->getView()->setData("ERROR", "Das System verfügt über kein gültiges Kontaktobjekt und kann dieses nicht selber erstellen.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Edit the contact.
	 */
	public function edit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$contactmodel = new ContactModel($this);
			$mailconfiguration = $contactmodel->getMailConfiguration();
			if($mailconfiguration)
			{
				$this->getView()->setData("MAILCONFIGURATION", $mailconfiguration);
			}
			else
			{
				$this->getView()->setData("ERROR", "Das System verfügt über kein gültiges Kontaktobjekt und kann dieses nicht selber erstellen.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the admin index action
	 */
	public function processedit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasPostString("smtpserver") && Utils::hasPostNumber("port") && Utils::hasPostEmail("sender") && Utils::hasPostString("username") && Utils::hasPostString("password"))
			{
				$contactmodel = new ContactModel($this);
				$mailconfiguration = $contactmodel->getMailConfiguration();
				if($mailconfiguration)
				{
					$mailconfiguration->setSmtpServer(Utils::getPost("smtpserver"));
					$mailconfiguration->setPort(Utils::getPost("port"));
					$mailconfiguration->setSender(Utils::getPost("sender"));
					$mailconfiguration->setUsername(Utils::getPost("username"));
					$mailconfiguration->setPassword(Utils::getPost("password"));
					if($contactmodel->saveMailConfiguration($mailconfiguration))
					{
						$this->getView()->setData("SUCCESS", "Die Maileinstellungen wurden erfolgreich gespeichert.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Die Maileinstellungen konnten nicht gespeichert werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Das System verfügt über kein gültiges Kontaktobjekt und kann dieses nicht selber erstellen.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie den SMTP Server, den Port, die Absenderadress, den Benutzernamen und das Passwort an.");
			} 
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>
