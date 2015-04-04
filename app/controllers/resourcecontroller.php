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
			$this->getView()->setData("DATADIRECTORY", DATA_DIRECTORY);
			$this->getView()->setData("RESOURCES", $resourcemodel->getResources());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
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
			if(Utils::hasFiles("fileupload", "name") && Utils::hasFiles("fileupload", "type") && Utils::hasFiles("fileupload", "tmp_name") && Utils::hasFiles("fileupload", "error"))
			{
				if(Utils::hasFiles("fileupload", "error"))
				{
					$resourcemodel = new ResourceModel($this);
					if($resourcemodel->isResourceFile(Utils::getFiles("fileupload", "tmp_name")))
					{
						if($resourcemodel->createResource(Utils::getFiles("fileupload", "tmp_name"), Utils::getFiles("fileupload", "name")))
						{
							$this->getView()->setData("SUCCESS", "Die Ressource wurde erfolgreich hochgeladen.");
						}
						else
						{
							$this->getView()->setData("ERROR", "Die Ressource konnte nicht hochgeladen werden.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "Bitte geben Sie eine Datei mit der passenden Dateiendung an (*.txt, *.pdf, *.png, *.jpeg, *.gif oder *.mp4).");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Während des Hochladens ist ein Fehler aufgetreten.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie ein gültiges Dateiobjekt an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
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
				$resourcemodel = new ResourceModel($this);
				$resource = $resourcemodel->getResource(Utils::getGet("id"));
				if($resource)
				{
					if($resourcemodel->deleteResource($resource))
					{
						$this->getView()->setData("SUCCESS", "Die Ressource wurde erfolgreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Die Ressource konnte nicht gelöscht werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Die Ressource konnte nicht gefunden werden.");
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
