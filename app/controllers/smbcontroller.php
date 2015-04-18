<?php

/**
 * The file smbcontroller.php contains the SMB controller which is
 * responsible for displaying SMB files and the file download and
 * upload functionality.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class SmbController is responsible for the SMB handling.
 */
class SmbController extends Controller implements ModuleController
{
	/**
	 * Show the URL site.
	 */
	public function index()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$smbmodel = new SmbModel($this);
			$this->getView()->setData("URL", $smbmodel->getUserSmbUrl());
			$this->getView()->setData("DOMAIN", $smbmodel->getUserSmbDomain());
			$this->getView()->setData("SHARE", $smbmodel->getUserSmbShare());
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the settings
	 */
	public function processindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasPostString("url") && Utils::hasPostString("domain") && Utils::hasPostString("share"))
			{
				$smbmodel = new SmbModel($this);
				$smbmodel->setUserSmbUrl(Utils::getPost("url"));
				$smbmodel->setUserSmbDomain(Utils::getPost("domain"));
				$smbmodel->setUserSmbShare(Utils::getPost("share"));
				$this->getView()->setData("SUCCESS", "Die SMB URL, Domain und Share wurden erfogreich gespeichert.");
			}
			else
			{
				$this->getView()->setData("ERROR", "Bitte geben Sie eine gültige SMB URL, eine Domain und einen Share an.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Show all documents.
	 */
	public function documents()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$smbmodel = new SmbModel($this);
			try
			{
				$path = urldecode(Utils::getGet("data"));
				$basepath = $smbmodel->getFileBasePath($path);
				$documents = $smbmodel->getDocuments($smbmodel->getUserSmbUrl(), $smbmodel->getUserSmbDomain(), $smbmodel->getUserSmbShare(), $path, $adminmodel->getUsername(), $adminmodel->getPassword());
				$this->getView()->setData("DOCUMENTS", $documents);
				$this->getView()->setData("PATH", $basepath);
				$this->getView()->setData("UPLOADPATH", $path);
			}
			catch(Exception $exception)
			{
				$this->getView()->setData("ERROR", "Der Server oder das Verzeichnis/Datei kann nicht gefunden werden.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Show a single document.
	 */
	public function document()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$smbmodel = new SmbModel($this);
			try
			{
				$path = urldecode(Utils::getGet("data"));
				$basepath = $smbmodel->getFileBasePath($path);
				$content = $smbmodel->getFileContent($smbmodel->getUserSmbUrl(), $smbmodel->getUserSmbDomain(), $smbmodel->getUserSmbShare(), $path, $adminmodel->getUsername(), $adminmodel->getPassword());
				$this->getView()->setData("PATH", $basepath);
				$this->getView()->setData("CONTENT", $content);
			}
			catch(Exception $exception)
			{
				$this->getView()->setData("ERROR", "Der Server oder das Verzeichnis/Datei kann nicht gefunden werden.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Prepare a document header
	 */
	public function download()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$smbmodel = new SmbModel($this);
			try
			{
				$path = urldecode(Utils::getGet("data"));
				$smbmodel->downloadFile($smbmodel->getUserSmbUrl(), $smbmodel->getUserSmbDomain(), $smbmodel->getUserSmbShare(), $path, $adminmodel->getUsername(), $adminmodel->getPassword());
			}
			catch(Exception $exception)
			{
				$this->getView()->setData("ERROR", "Der Server oder das Verzeichnis/Datei kann nicht gefunden werden.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Upload a document.
	 */
	public function upload()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$path = urldecode(Utils::getGet("data"));;
			$this->getView()->setData("UPLOADPATH", $path);
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Process the upload of a document.
	 */
	public function processupload()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			if(Utils::hasFiles("fileupload", "name") && Utils::hasFiles("fileupload", "type") && Utils::hasFiles("fileupload", "tmp_name") && Utils::hasFiles("fileupload", "error"))
			{
				if(Utils::hasFiles("fileupload", "error"))
				{
					$smbmodel = new SmbModel($this);
					try
					{
						$path = urldecode(Utils::getGet("data"));
						$this->getView()->setData("UPLOADPATH", $path);
						$smbmodel->uploadFile($smbmodel->getUserSmbUrl(), $smbmodel->getUserSmbDomain(), $smbmodel->getUserSmbShare(), $path, $adminmodel->getUsername(), $adminmodel->getPassword(), Utils::getFiles("fileupload", "tmp_name"), Utils::getFiles("fileupload", "name"));
						$this->getView()->setData("SUCCESS", "Die Datei wurde erfolgreich hochgeladen.");
					}
					catch(Exception $exception)
					{
						$this->getView()->setData("ERROR", "Der Server oder das Verzeichnis/Datei kann nicht gefunden werden.");
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
	 * Show the SMB admin site.
	 */
	public function adminindex()
	{
		$adminmodel = new AdminModel($this);
		if($adminmodel->isUserLoggedIn())
		{
			$smbmodel = new SmbModel($this);
			$log = $smbmodel->getLog();
			$this->getView()->setData("LOG", $log);
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
	
	/**
	 * Delete the log.
	 */
	public function delete()
	{
		$adminmodel = new AdminModel($this);
		if(!$adminmodel->isUserLoggedIn())
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
			$smbmodel = new SmbModel($this);
			if($smbmodel->deleteLog())
			{
				$this->getView()->setData("SUCCESS", "Die Log Datei wurde erfolgreich gelöscht.");
			}
			else
			{
				$this->getView()->setData("ERROR", "Die Log Datei konnte nicht gelöscht werden.");
			}
		}
		else
		{
			$this->getView()->setData("ADMINERROR", "Sie verfügen nicht über die notwendigen Berechtigungen, um auf diese Seite zugreifen zu dürfen.");
		}
	}
}

?>
