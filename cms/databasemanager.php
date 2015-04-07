<?php

/**
 * The file databasemanager provides access to the database via the Doctrine
 * object relational mapper.
 *
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Simon Wächter
 * @version 1.0
 */

use Doctrine\ORM\Mapping;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\EntityManager;

/**
 * The class DatabaseManager is responsible for the database interaction. He
 * can create, load, edit and delete objects.
 */
class DatabaseManager
{
	/**
	 * The entity manager of the database manager.
	 *
	 * @var EntityManager
	 */
	private $entitymanager;
	
	/**
	 * The configuration of the database manager.
	 *
	 * @var Configuration
	 */
	private $configuration;
	
	/**
	 * Constructor of the class DatabaseManager with the configuration.
	 * 
	 * @param Configuration $configuration Configuration
	 */
	public function __construct($configuration)
	{
		// Set all variables
		$hostname = $configuration->getDatabaseHostname();
		$username = $configuration->getDatabaseUsername();
		$password = $configuration->getDatabasePassword();
		$database = $configuration->getDatabaseName();
		
		// Set the directories for the entity manager
		$directories = array(getcwd() . "/" . CMS_ENTITY_DIRECTORY, getcwd() . "/" . APP_ENTITY_DIRECTORY);
		
		// Setup the connection
		$dataconfiguration = Setup::createAnnotationMetadataConfiguration($directories, true);
		$dataoptions = array("driver" => "pdo_mysql", "host" => $hostname, "dbname" => $database, "user" => $username, "password" => $password, "charset" => "UTF8");
		$this->entitymanager = EntityManager::create($dataoptions, $dataconfiguration);
		
		// Create/Update the tables
		$classes = $this->entitymanager->getMetadataFactory()->getAllMetadata();
		$schematool = new SchemaTool($this->entitymanager);
		$schematool->updateSchema($classes);
		
		// Check the connection
		$this->entitymanager->getConnection()->connect();
		
		// Set the configuration
		$this->configuration = $configuration;
	}
	
	/**
	 * Get all entries of an entity.
	 *
	 * @param string $entity The name of the entity
	 * @return object All objects of the entity
	 */
	public function getEntries($entity)
	{
		$query = $this->entitymanager->createQuery("SELECT e FROM $entity e");
		return $query->getResult();
	}
	
	/**
	 * Get an entry of an entity by the ID.
	 *
	 * @param string $entity The name of the entity
	 * @param integer $id ID of the entry
	 * @return object The object with the ID of the entity
	 */
	public function getEntryById($entity, $id)
	{
		return $this->entitymanager->find($entity, $id);
	}
	
	/**
	 * Get all entries of an entity except the ID.
	 *
	 * @param string $entity The name of the entity
	 * @param integer $id ID of the excluded entry
	 * @return object All objects of the entity except the object with the ID
	 */
	public function getEntriesWithoutId($entity, $id)
	{
		$query = $this->entitymanager->createQuery("SELECT e FROM $entity e WHERE e.id != '$id'");
		return $query->getResult();
	}
	
	/**
	 * Get one an entry of an entity.
	 *
	 * @param string $entity The name of the entity
	 * @return object|null The object of the entity or null
	 */
	public function getOneEntry($entity)
	{
		try
		{
			$query = $this->entitymanager->createQuery("SELECT e FROM $entity e");
			return $query->getSingleResult();
		}
		catch(Exception $exception)
		{
			return null;
		}
	}
	
	/**
	 * Save an entry.
	 *
	 * @param object $entry The entry as object
	 * @return boolean Status of the action
	 */
	public function saveEntry($entry)
	{
		try
		{
			$this->entitymanager->persist($entry);
			$this->entitymanager->flush();
			return true;
		}
		catch(Exception $exception)
		{
			return false;
		}
	}
	
	/**
	 * Delete an entry.
	 *
	 * @param object $entry The entry as object
	 * @return boolean Status of the action
	 */
	public function deleteEntry($entry)
	{
		try
		{
			$this->entitymanager->remove($entry);
			$this->entitymanager->flush();
			return true;
		}
		catch(Exception $exception)
		{
			return false;
		}
	}
}

?>
