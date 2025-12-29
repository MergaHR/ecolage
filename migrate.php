<?php
/**
 * Database Migration Script for Railway Deployment
 * Run this script to set up your database on Railway
 */

// Load CodeIgniter
define('BASEPATH', true);
require_once 'system/core/CodeIgniter.php';

class DatabaseMigration {
    private $db;
    
    public function __construct() {
        // Initialize database connection
        $this->db = new CI_DB();
        
        // Load database configuration from environment
        $this->db->hostname = getenv('DB_HOST') ?: 'localhost';
        $this->db->username = getenv('DB_USERNAME') ?: 'root';
        $this->db->password = getenv('DB_PASSWORD') ?: '';
        $this->db->database = getenv('DB_NAME') ?: 'ecolage';
        $this->db->dbdriver = 'mysqli';
        $this->db->dbprefix = '';
        $this->db->pconnect = FALSE;
        $this->db->db_debug = TRUE;
        $this->db->cache_on = FALSE;
        $this->db->cachedir = '';
        $this->db->char_set = 'utf8mb4';
        $this->db->dbcollat = 'utf8mb4_general_ci';
        $this->db->swap_pre = '';
        $this->db->autoinit = TRUE;
        $this->db->stricton = FALSE;
    }
    
    public function migrate() {
        echo "🚀 Starting database migration...\n";
        
        try {
            // Read SQL file
            $sql = file_get_contents('database.sql');
            
            if ($sql === false) {
                throw new Exception("Could not read database.sql file");
            }
            
            // Split SQL into individual statements
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            // Execute each statement
            foreach ($statements as $statement) {
                if (!empty($statement)) {
                    if (!$this->db->query($statement)) {
                        throw new Exception("Error executing statement: " . $statement);
                    }
                }
            }
            
            echo "✅ Database migration completed successfully!\n";
            return true;
            
        } catch (Exception $e) {
            echo "❌ Migration failed: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    public function testConnection() {
        echo "🔗 Testing database connection...\n";
        
        try {
            $result = $this->db->query("SELECT 1 as test");
            if ($result) {
                echo "✅ Database connection successful!\n";
                return true;
            }
        } catch (Exception $e) {
            echo "❌ Database connection failed: " . $e->getMessage() . "\n";
        }
        
        return false;
    }
}

// Run migration if this script is accessed directly
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    $migration = new DatabaseMigration();
    
    if ($migration->testConnection()) {
        $migration->migrate();
    } else {
        echo "Please check your database configuration in environment variables.\n";
        echo "Required variables: DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME\n";
    }
}
?>
