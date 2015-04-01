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
					$this->getView()->setData("ERROR", "The text was not found.");
				}
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Please provide a valid ID.");
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
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
					$this->getView()->setData("SUCCESS", "The text was successfully created.");
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to create the text.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid title and text.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
					$this->getView()->setData("ID", $text->getId());
					$this->getView()->setData("TITLE", $text->getTitle());
					$this->getView()->setData("TEXT", $text->getMarkdownText());
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the text.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
						$this->getView()->setData("SUCCESS", "The text was successfully updated.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to update the text.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the text.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID, title and text.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
						$this->getView()->setData("SUCCESS", "The text was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the text.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the text.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid ID.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
}

?>
