<?php

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
					$this->getView()->setData("ERROR", "The news was not found.");
				}
			}
		}
		else
		{
			$this->getView()->setData("ERROR", "Please provide a valid ID.");
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
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
				$newsmodel = new NewsModel($this);
				if($newsmodel->createNews(Utils::getPost("title"), Utils::getPost("text")))
				{
					$this->getView()->setData("SUCCESS", "The news was successfully created.");
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to create the news.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a valid title and news.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
					$this->getView()->setData("ID", $news->getId());
					$this->getView()->setData("TITLE", $news->getTitle());
					$this->getView()->setData("TEXT", $news->getMarkdownText());
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the news.");
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
				$newsmodel = new NewsModel($this);
				$news = $newsmodel->getNews(Utils::getGet("id"));
				if($news)
				{
					$news->setTitle(Utils::getPost("title"));
					$news->setMarkdownText(Utils::getPost("text"));
					if($newsmodel->updateNews($news))
					{
						$this->getView()->setData("SUCCESS", "The news was successfully updated.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to update the news.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the news.");
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
				$newsmodel = new NewsModel($this);
				$news = $newsmodel->getNews(Utils::getGet("id"));
				if($news)
				{
					if($newsmodel->deleteNews($news))
					{
						$this->getView()->setData("SUCCESS", "The news was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the news.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the news.");
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
