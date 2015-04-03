<?php

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
				$this->getView()->setData("ERROR", "The system is unable to generate a captcha image");
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "The mail settings are not configured. Please contact the site admin.");
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
							$this->getView()->setData("SUCCESS", "The mail was successfully sent.");
						}
						else
						{
							$this->getView()->setData("ERROR", "The system was unable to send the mail.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "The mail settings are not configured. Please contact the site admin.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Your input captcha doesn't match with the image captcha.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a captcha, user name, email address, title and text.");
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "The mail settings are not configured. Please contact the site admin.");
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
				$this->getView()->setData("SMTPSERVER", $mailconfiguration->getSmtpServer());
				$this->getView()->setData("PORT", $mailconfiguration->getPort());
				$this->getView()->setData("SENDER", $mailconfiguration->getSender());
				$this->getView()->setData("USERNAME", $mailconfiguration->getUsername());
			}
			else
			{
				$this->getView()->setData("ERROR", "The mail settings are not properly stored.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
				$this->getView()->setData("SMTPSERVER", $mailconfiguration->getSmtpServer());
				$this->getView()->setData("PORT", $mailconfiguration->getPort());
				$this->getView()->setData("SENDER", $mailconfiguration->getSender());
				$this->getView()->setData("USERNAME", $mailconfiguration->getUsername());
			}
			else
			{
				$this->getView()->setData("ERROR", "The mail settings are not properly stored.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
						$this->getView()->setData("SUCCESS", "The mail configuration was successfully updated.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to update the mail configuration.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The mail settings are not properly stored.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a SMTP server, port, sender address, username and password.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>
