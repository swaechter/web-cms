<?php

/**
 * The class ResourceController is responsible for the resource management.
 */
class ResourceController extends Controller implements SystemController
{
	/**
	 * Show the resource admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$resourcemodel = new ResourceModel($this);
			$this->getView()->setData("RESOURCES", $resourcemodel->getResources());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
	
	/**
	 * Add a new resource.
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
			if(Utils::hasFiles("fileupload", "name") && Utils::hasFiles("fileupload", "type") && Utils::hasFiles("fileupload", "tmp_name") && Utils::hasFiles("fileupload", "error"))
			{
				if(Utils::hasFiles("fileupload", "error"))
				{
					$resourcemodel = new ResourceModel($this);
					if($resourcemodel->isResourceFile(Utils::getFiles("fileupload", "tmp_name")))
					{
						if($resourcemodel->createResource(Utils::getFiles("fileupload", "tmp_name"), Utils::getFiles("fileupload", "name")))
						{
							$this->getView()->setData("SUCCESS", "The resource was successfully uploaded.");
						}
						else
						{
							$this->getView()->setData("ERROR", "The system was unable to upload the resource.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "Please provide a resources with a *.txt, *.pdf, *.png, *.jpeg, *.gif or *.mp4 extension.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "An error occured during the file upload.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a file object and a resource title.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
		}
	}
	
	/**
	 * Remove an existing resource.
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
				$resourcemodel = new ResourceModel($this);
				$resource = $resourcemodel->getResource(Utils::getGet("id"));
				if($resource)
				{
					if($resourcemodel->deleteResource($resource))
					{
						$this->getView()->setData("SUCCESS", "The resource was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the resource.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the resource.");
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
