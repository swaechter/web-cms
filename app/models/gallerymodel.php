<?php

/**
 * The class GalleryModel provides an image gallery system.
 */
class GalleryModel extends Model
{
	/**
	 * Get all images.
	 *
	 * @return array All images
	 */
	public function getImages()
	{
		return $this->getDatabaseManager()->getEntries("Image");
	}
	
	/**
	 * Get a specific image by the ID.
	 *
	 * @param integer $id ID of the image
	 * @return Image|null Image object or null
	 */
	public function getImage($id)
	{
		return $this->getDatabaseManager()->getEntryById("Image", $id);
	}
	
	/**
	 * Create a new image.
	 *
	 * @param string $filepath File path of the image
	 * @param string $filename Name of the image
	 * @param string $title Title of the image
	 * @return boolean Status of the action
	 */
	public function createImage($filepath, $filename, $title)
	{
		$date = date("d.m.Y H:i:s");
		$filename = date("Y_m_d_H_i_s") . "_" . $filename;
		
		$entry = new Image();
		$entry->setFileName($filename);
		$entry->setDate($date);
		$entry->setTitle($title);
		
		return is_dir(DATA_DIRECTORY) && is_writable(DATA_DIRECTORY) && move_uploaded_file($filepath, DATA_DIRECTORY . $filename) && $this->getDatabaseManager()->saveEntry($entry);
	}
	
	/**
	 * Update a image.
	 *
	 * @param Image $image Image obtect
	 * @return boolean Status of the action
	 */
	public function updateImage($image)
	{
		return $this->getDatabaseManager()->saveEntry($image);
	}
	
	/**
	 * Delete a image.
	 *
	 * @param Image $image Image obtect
	 * @return boolean Status of the action
	 */
	public function deleteImage($image)
	{
		return is_dir(DATA_DIRECTORY) && is_writable(DATA_DIRECTORY) && unlink(DATA_DIRECTORY . $image->getFileName()) && $this->getDatabaseManager()->deleteEntry($image);
	}
	
	/**
	 * Check if an uploaded image is a real image or if the file extension is faked
	 *
	 * @param string $filepath File path to the file
	 * @return boolean Status of the action
	 */
	public function isImageFile($filepath)
	{
		$filetypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
		$detectedfiletypes = exif_imagetype($filepath);
		return in_array($detectedfiletypes, $filetypes);
	}
}

?>
