<?php

/**
 * The class TextController is responsible for all articles.
 */
class TextController extends Controller implements ModuleController
{
	/**
	 * Show the text site.
	 */
	public function index()
	{
		$textmodel = new TextModel($this);
		$this->getView()->setData("TEXTS", $textmodel->getTexts());
	}
	
	/**
	 * Show a specific text site.
	 */
	public function show()
	{
		if(Utils::hasGetId("id"))
		{
			$textmodel = new TextModel($this);
			$text = $textmodel->getText(Utils::getGet("id"));
			{
				if($text)
				{
					$this->getView()->setData("TEXT", $text);
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Text konnte nicht gefunden werden.");
				}
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
		}
	}
	
	/**
	 * Show the text admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$textmodel = new TextModel($this);
			$this->getView()->setData("TEXTS", $textmodel->getTexts());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Add a text.
	 */
	public function create()
	{
		$adminmodel = new AdminModel($this);
		if(!$adminmodel->isUserLoggedIn())
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the create action.
	 */
	public function processcreate()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasPostString("title") && Utils::hasPostText("text"))
			{
				$textmodel = new TextModel($this);
				if($textmodel->createText(Utils::getPost("title"), Utils::getPost("text")))
				{
					$this->getView()->setData("SUCCESS", "Der Text wurde erfolgreich erstellt.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Text konnte nicht erstellt werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie den Titel und den Text an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Edit a text.
	 */
	public function edit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$textmodel = new TextModel($this);
				$text = $textmodel->getText(Utils::getGet("id"));
				if($text)
				{
					$this->getView()->setData("TEXT", $text);
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Text konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the edit action.
	 */
	public function processedit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id") && Utils::hasPostString("title") && Utils::hasPostText("text"))
			{
				$textmodel = new TextModel($this);
				$text = $textmodel->getText(Utils::getGet("id"));
				if($text)
				{
					$text->setTitle(Utils::getPost("title"));
					$text->setMarkdownText(Utils::getPost("text"));
					if($textmodel->updateText($text))
					{
						$this->getView()->setData("SUCCESS", "Der Text wurde erfolgreich gespeichert.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Der Text konnte nicht gespeichert werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Text konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID, einen Titel und einen Text an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Remove a text.
	 */
	public function delete()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$this->getView()->setData("ID", Utils::getGet("id"));
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the delete action.
	 */
	public function processdelete()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$textmodel = new TextModel($this);
				$text = $textmodel->getText(Utils::getGet("id"));
				if($text)
				{
					if($textmodel->deleteText($text))
					{
						$this->getView()->setData("SUCCESS", "Der Text wurde erfolgreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Der Text konnte nicht gelöscht werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Der Text konnte nicht gefunden werden.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>
