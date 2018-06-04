<?php
namespace Component;

use PDO;
/**
 * Description of DataMapper
 *
 * @author Arslan Hajdarevic <arslan.h@tech387.com>
 */
class DataMapper {
    
    protected $connection;
    protected $configuration;
    
    /**
     * Creates new mapper instance
     *
     * @param PDO $connection
     * @param array $configuration A list of table name aliases
     *
     * @codeCoverageIgnore
     */
    public function __construct(PDO $connection)
    {
        // , array $configuration
        $this->connection = $connection;
        //$this->configuration = $configuration;
    }
    
}
