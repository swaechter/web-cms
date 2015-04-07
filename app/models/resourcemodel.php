<?php

/**
 * The file resourcemodel.php is responsible for uploading resources
 * like text files, PDF files and images or videos.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

/**
 * The class ResourceModel provides a resource system.
 */
class ResourceModel extends Model
{
	/**
	 * Get all resources.
	 *
	 * @return array All resources
	 */
	public function getResources()
	{
		return $this->getDatabaseManager()->getEntries("Resource");
	}
	
	/**
	 * Get a specific resource by the ID.
	 *
	 * @param integer $id ID of the resource
	 * @return Resource|null Resource object or null
	 */
	public function getResource($id)
	{
		return $this->getDatabaseManager()->getEntryById("Resource", $id);
	}
	
	/**
	 * Create a new resource.
	 *
	 * @param string $filepath File path of the resource
	 * @param string $filename Name of the resource
	 * @return boolean Status of the action
	 */
	public function createResource($filepath, $filename)
	{
		$filename = date("Y_m_d_H_i_s") . "_resource_" . $filename;
		
		$entry = new Resource();
		$entry->setFileName($filename);
		
		return is_dir(DATA_DIRECTORY) && is_writable(DATA_DIRECTORY) && move_uploaded_file($filepath, DATA_DIRECTORY . $filename) && $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Delete a resource.
	 *
	 * @param Resource $resource Resource obtect
	 * @return boolean Status of the action
	 */
	public function deleteResource($resource)
	{
		return is_dir(DATA_DIRECTORY) && is_writable(DATA_DIRECTORY) && file_exists(DATA_DIRECTORY . $resource->getFileName()) && unlink(DATA_DIRECTORY . $resource->getFileName()) && $this->getDatabaseManager()->deleteEntry($resource);
	}
	
	/**
	 * Check if an uploaded resource is a real resource or if the file extension is faked
	 *
	 * @param string $filepath File path to the file
	 * @return boolean Status of the action
	 */
	public function isResourceFile($filepath)
	{
		$mimetypes = array("text/plain", "application/pdf", "image/png", "image/jpeg", "image/pjpeg", "image/jpeg", "image/pjpeg", "image/gif", "video/mp4");
		$handle = finfo_open(FILEINFO_MIME_TYPE);
		$mimetype = finfo_file($handle, $filepath);
		return in_array($mimetype, $mimetypes);
	}
}

?>
