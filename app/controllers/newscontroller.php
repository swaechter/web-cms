<?php

/**
 * The file newscontroller.php provides a news controller which is capable of
 * creating, editing and displaying news as feed or single entry.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class NewsController is responsible for all news entries.
 */
class NewsController extends Controller implements ModuleController
{
	/**
	 * Show the news site.
	 */
	public function index()
	{
		$newsmodel = new NewsModel($this);
		$this->getView()->setData("NEWSS", $newsmodel->getNewses());
	}
	
	/**
	 * Show a specific news site.
	 */
	public function show()
	{
		if(Utils::hasGetId("id"))
		{
			$newsmodel = new NewsModel($this);
			$news = $newsmodel->getNews(Utils::getGet("id"));
			{
				if($news)
				{
					$this->getView()->setData("NEWS", $news);
				}
				else
				{
					$this->getView()->setData("ERROR", "Die News konnte nicht gefunden werden.");
				}
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige ID an.");
		}
	}
	
	/**
	 * Show the news admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$newsmodel = new NewsModel($this);
			$this->getView()->setData("NEWSS", $newsmodel->getNewses());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Add a news.
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
				$newsmodel = new NewsModel($this);
				if($newsmodel->createNews(Utils::getPost("title"), Utils::getPost("text")))
				{
					$this->getView()->setData("SUCCESS", "Die News wurde erfolgreich erstellt.");
				}
				else
				{
					$this->getView()->setData("ERROR", "Die News konnte nicht erstellt werden.");
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
	 * Edit a news.
	 */
	public function edit()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasGetId("id"))
			{
				$newsmodel = new NewsModel($this);
				$news = $newsmodel->getNews(Utils::getGet("id"));
				if($news)
				{
					$this->getView()->setData("NEWS", $news);
				}
				else
				{
					$this->getView()->setData("ERROR", "Die News konnte nicht gefunden werden.");
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
				$newsmodel = new NewsModel($this);
				$news = $newsmodel->getNews(Utils::getGet("id"));
				if($news)
				{
					$news->setTitle(Utils::getPost("title"));
					$news->setMarkdownText(Utils::getPost("text"));
					if($newsmodel->updateNews($news))
					{
						$this->getView()->setData("SUCCESS", "Die News wurde erfolgreich gespeichert.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Die News konnte nicht gespeichert werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Die News konnte nicht gefunden werden.");
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
	 * Remove a news.
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
				$newsmodel = new NewsModel($this);
				$news = $newsmodel->getNews(Utils::getGet("id"));
				if($news)
				{
					if($newsmodel->deleteNews($news))
					{
						$this->getView()->setData("SUCCESS", "Die News wurde erfolgreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Die News konnte nicht gelöscht werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Die News konnte nicht gefunden werden.");
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
