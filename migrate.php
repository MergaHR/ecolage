<?php
/**
 * Database Migration Script for Railway Deployment
 * Run this script to set up your database on Railway
 */

class DatabaseMigration {
    private $pdo;
    
    public function __construct() {
        // Get database configuration from environment
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '5432';
        $dbname = getenv('DB_NAME') ?: 'ecolage';
        $username = getenv('DB_USERNAME') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        
        try {
            // Create PDO connection for PostgreSQL
            $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    public function migrate() {
        echo "🚀 Starting database migration...\n";
        
        try {
            // Read SQL file
            $sql = file_get_contents('database.sql');
            
            if ($sql === false) {
                throw new Exception("Could not read database.sql file");
            }
            
            // Convert MySQL syntax to PostgreSQL where needed
            $sql = $this->convertToPostgreSQL($sql);
            
            // Split SQL into individual statements
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            // Execute each statement
            foreach ($statements as $statement) {
                if (!empty($statement) && !preg_match('/^--/', $statement)) {
                    try {
                        $this->pdo->exec($statement);
                    } catch (PDOException $e) {
                        // Continue on duplicate errors
                        if (strpos($e->getMessage(), 'already exists') === false) {
                            throw new Exception("Error executing statement: " . $statement . " - " . $e->getMessage());
                        }
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
    
    private function convertToPostgreSQL($sql) {
        // Convert MySQL specific syntax to PostgreSQL
        $replacements = [
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4' => '',
            'AUTO_INCREMENT' => 'SERIAL',
            'int(11)' => 'INTEGER',
            'varchar(255)' => 'VARCHAR(255)',
            'varchar(100)' => 'VARCHAR(100)',
            'varchar(50)' => 'VARCHAR(50)',
            'decimal(10,2)' => 'DECIMAL(10,2)',
            'timestamp DEFAULT CURRENT_TIMESTAMP' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'timestamp NULL DEFAULT NULL' => 'TIMESTAMP NULL',
            'enum(' => 'VARCHAR(20) CHECK (',
            'pending','validated','rejected' => 'pending','validated','rejected'))',
            "'pending'" => "'pending'",
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' => '$2b$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
        
        foreach ($replacements as $mysql => $postgres) {
            $sql = str_replace($mysql, $postgres, $sql);
        }
        
        return $sql;
    }
    
    public function testConnection() {
        echo "🔗 Testing database connection...\n";
        
        try {
            $result = $this->pdo->query("SELECT 1 as test");
            if ($result) {
                echo "✅ Database connection successful!\n";
                return true;
            }
        } catch (PDOException $e) {
            echo "❌ Database connection failed: " . $e->getMessage() . "\n";
        }
        
        return false;
    }
}

// Run migration if this script is accessed directly
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    header('Content-Type: text/plain');
    
    $migration = new DatabaseMigration();
    
    if ($migration->testConnection()) {
        $migration->migrate();
    } else {
        echo "Please check your database configuration in environment variables.\n";
        echo "Required variables: DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME\n";
        echo "\nCurrent environment variables:\n";
        echo "DB_HOST: " . (getenv('DB_HOST') ?: 'not set') . "\n";
        echo "DB_USERNAME: " . (getenv('DB_USERNAME') ?: 'not set') . "\n";
        echo "DB_NAME: " . (getenv('DB_NAME') ?: 'not set') . "\n";
        echo "DB_PORT: " . (getenv('DB_PORT') ?: 'not set') . "\n";
    }
}
?>
