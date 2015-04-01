<?php

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
			$this->getView()->setData("IMAGES", $gallerymodel->getImages());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
			if(Utils::hasFiles("fileupload", "name") && Utils::hasFiles("fileupload", "type") && Utils::hasFiles("fileupload", "tmp_name") && Utils::hasFiles("fileupload", "error") && Utils::hasPostString("title"))
			{
				if(Utils::hasFiles("fileupload", "error"))
				{
					$gallerymodel = new GalleryModel($this);
					if($gallerymodel->isImageFile(Utils::getFiles("fileupload", "tmp_name")))
					{
						if($gallerymodel->createImage(Utils::getFiles("fileupload", "tmp_name"), Utils::getFiles("fileupload", "name"), Utils::getPost("title")))
						{
							$this->getView()->setData("SUCCESS", "The image was successfully uploaded.");
						}
						else
						{
							$this->getView()->setData("ERROR", "The system was unable to upload the image.");
						}
					}
					else
					{
						$this->getView()->setData("ERROR", "Please provide an images with a *.png, *.jpeg or *.gif extension.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "An error occured during the file upload.");
				}
			}
			else
			{
				$this->getView()->setData("ERROR", "Please provide a file object and an image title.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "You do not have the privileges to access this site.");
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
				$gallerymodel = new GalleryModel($this);
				$image = $gallerymodel->getImage(Utils::getGet("id"));
				if($image)
				{
					if($gallerymodel->deleteImage($image))
					{
						$this->getView()->setData("SUCCESS", "The image was successfully deleted.");
					}
					else
					{
						$this->getView()->setData("ERROR", "The system was unable to delete the image.");
					}
				}
				else
				{
					$this->getView()->setData("ERROR", "The system was unable to find the image.");
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
