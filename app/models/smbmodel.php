<?php

/**
 * The file smbmodel.php is responsible for the SMB management.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

use Icewind\SMB\NativeServer;
use Icewind\SMB\Server;

/**
 * The class SmbModel provides the SMB functionality.
 */
class SmbModel extends Model
{
	/**
	 * Get the user session SMB URL.
	 *
	 * @return string SMB URL
	 */
	public function getUserSmbUrl()
	{
		return Utils::getSession("SmbUrl");
	}
	
	/**
	 * Set the user session SMB URL.
	 *
	 * @param string $url SMB URL
	 */
	public function setUserSmbUrl($url)
	{
		return Utils::setSession("SmbUrl", $url);
	}
	
	/**
	 * Get the user session SMB domain.
	 *
	 * @return string SMB domain
	 */
	public function getUserSmbDomain()
	{
		return Utils::getSession("SmbDomain");
	}
	
	/**
	 * Set the user session SMB domain.
	 *
	 * @param string $url SMB domain
	 */
	public function setUserSmbDomain($domain)
	{
		return Utils::setSession("SmbDomain", $domain);
	}
	
	/**
	 * Get the user session SMB share.
	 *
	 * @return string SMB share
	 */
	public function getUserSmbShare()
	{
		return Utils::getSession("SmbShare");
	}
	
	/**
	 * Set the user session SMB share.
	 *
	 * @param string $url SMB share
	 */
	public function setUserSmbShare($share)
	{
		return Utils::setSession("SmbShare", $share);
	}
	
	/**
	 * Get the file name based on the path.
	 *
	 * @param string $path Full file path including the file name
	 * @return string File name
	 */
	public function getFileName($path)
	{
		$params = explode("/", $path);
		if(count($params) == 1)
		{
			return $path;
		}
		else
		{
			return array_pop($params);
		}
	}
	
	/**
	 * Get the file path of a full file path.
	 *
	 * @param string $path Full file path including the file name
	 * @return File path
	 */
	public function getFileBasePath($path)
	{
		$params = explode("/", $path);
		if(empty($path))
		{
			return null;
		}
		else if(count($params) == 1)
		{
			return ".";
		}
		else
		{
			array_pop($params);
			return implode("/", $params);
		}
	}
	
	/**
	 * Get all documents from a SMB path.
	 *
	 * @param string $url SMB URL
	 * @param string $domain SMB user domain
	 * @param string $share SMB share
	 * @param string $path SMB path
	 * @param string $username User name
	 * @param string $password User password
	 */
	public function getDocuments($url, $domain, $share, $path, $username, $password)
	{
		if(empty($path))
		{
			$path = ".";
		}
		if(!empty($domain))
		{
			$username = $domain . "\\" . $username;
		}
		$server = new Server($url, $username, $password);
		$share = $server->getShare($share);
		return $share->dir($path);
	}
	
	/**
	 * Get the file content of a SMB file.
	 *
	 * @param string $url SMB URL
	 * @param string $domain SMB user domain
	 * @param string $share SMB share
	 * @param string $path SMB path including the file name
	 * @param string $username User name
	 * @param string $password User password
	 */
	public function getFileContent($url, $domain, $share, $path, $username, $password)
	{
		if(empty($path))
		{
			$path = ".";
		}
		if(!empty($domain))
		{
			$username = $domain . "\\" . $username;
		}
		$server = new Server($url, $username, $password);
		$share = $server->getShare($share);
		$file = $share->read($path);
		$content = stream_get_contents($file);
		fclose($file);
		return $content;
	}
	
	/**
	 * Download a SMB file.
	 *
	 * @param string $url SMB URL
	 * @param string $domain SMB user domain
	 * @param string $share SMB share
	 * @param string $path SMB path including the file name
	 * @param string $username User name
	 * @param string $password User password
	 */
	public function downloadFile($url, $domain, $share, $path, $username, $password)
	{
		$filename = $this->getFileName($path);
		$content = $this->getFileContent($url, $domain, $share, $path, $username, $password);
		if(!empty($domain))
		{
			$username = $domain . "\\" . $username;
		}
		file_put_contents("/tmp/" . $filename, $content);
		file_put_contents(DATA_DIRECTORY . "smb.log", "Benutzer " . $username . " hat die Datei " . $path  . " heruntergeladen\n", FILE_APPEND);
		header("Content-Type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header("Content-Length: ". filesize("/tmp/" . $filename));
		echo($content);
		die();
	}
	
	/**
	 * Upload a SMB file.
	 *
	 * @param string $url SMB URL
	 * @param string $domain SMB user domain
	 * @param string $share SMB share
	 * @param string $path SMB path including the file name
	 * @param string $username User name
	 * @param string $password User password
	 * @param string $uploadfile System file path including the file name
	 * @param string $uploadname Client file name
	 */
	public function uploadFile($url, $domain, $share, $path, $username, $password, $uploadfile, $uploadname)
	{
		if(empty($path))
		{
			$path = ".";
		}
		if(!empty($domain))
		{
			$username = $domain . "\\" . $username;
		}
		file_put_contents(DATA_DIRECTORY . "smb.log", "Benutzer " . $username . " hat die Datei " . $path . "/" . $uploadname . " hochgeladen\n", FILE_APPEND);
		$server = new Server($url, $username, $password);
		$share = $server->getShare($share);
		$share->put($uploadfile, $path . "/". $uploadname);
	}
	
	/**
	 * Get the SMB log content.
	 *
	 * @return string SMB log
	 */
	public function getLog()
	{
		if(file_exists(DATA_DIRECTORY . "smb.log"))
		{
			return file_get_contents(DATA_DIRECTORY . "smb.log");
		}
		else
		{
			return null;
		}
	}
	
	/**
	 * Delete the SMB log.
	 */
	public function deleteLog()
	{
		if(file_exists(DATA_DIRECTORY . "smb.log"))
		{
			return unlink(DATA_DIRECTORY . "smb.log");
		}
		else
		{
			return true;
		}
	}
}

?>
