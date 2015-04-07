<?php

/**
 * The file gallerycontroller.php contains the gallery controller and
 * provides a gallery for uploading and displaying images.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class GalleryController is responsible for the gallery with all images.
 */
class GalleryController extends Controller implements ModuleController
{
	/**
	 * Show the gallery site.
	 */
	public function index()
	{
		$gallerymodel = new GalleryModel($this);
		$this->getView()->setData("DATADIRECTORY", DATA_DIRECTORY);
		$this->getView()->setData("IMAGES", $gallerymodel->getImages());
	}
	
	/**
	 * Show the gallery admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$gallerymodel = new GalleryModel($this);
			$this->getView()->setData("DATADIRECTORY", DATA_DIRECTORY);
			$this->getView()->setData("IMAGES", $gallerymodel->getImages());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Add a new image.
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
			if(Utils::hasFiles("fileupload", "name") && Utils::hasFiles("fileupload", "type") && Utils::hasFiles("fileupload", "tmp_name") && Utils::hasFiles("fileupload", "error") && Utils::hasPostString("title"))
			{
				if(Utils::hasFiles("fileupload", "error"))
				{
					$gallerymodel = new GalleryModel($this);
					if($gallerymodel->isImageFile(Utils::getFiles("fileupload", "tmp_name")))
					{
						if($gallerymodel->createImage(Utils::getFiles("fileupload", "tmp_name"), Utils::getFiles("fileupload", "name"), Utils::getPost("title")))
						{
							$this->getView()->setData("SUCCESS", "Das Bild wurde erfolgreich hochgeladen.");
						}
						else
						{
							$this->getView()->setData("ERROR", "Das Bild konnte nicht hochgeladen werden.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "Bitte geben Sie eine Datei mit der passenden Dateiendung an (*.png, *.jpeg oder *.gif).");
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
	 * Remove an existing image.
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
				$gallerymodel = new GalleryModel($this);
				$image = $gallerymodel->getImage(Utils::getGet("id"));
				if($image)
				{
					if($gallerymodel->deleteImage($image))
					{
						$this->getView()->setData("SUCCESS", "Das Bild wurde erfolgreich gelöscht.");
					}
					else
					{
						$this->getView()->setData("ERROR", "Das Bild konnte nicht gelöscht werden.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "Das Bild konnte nicht gefunden werden.");
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
