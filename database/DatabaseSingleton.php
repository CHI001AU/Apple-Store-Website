<?php
// Database/DatabaseSingleton.php

class DatabaseSingleton {
    // 1. Static property to hold the single instance of the class
    private static ?DatabaseSingleton $instance = null;

    // 2. Property to hold the actual PDO database connection resource
    private $connection;

    /**
     * Private constructor to prevent creating new instances via 'new DatabaseSingleton()'.
     */
    private function __construct() {
        // [Inference] You would replace these placeholders with your actual credentials
        $host = 'localhost';
        $db = 'chi001db';
        $user = 'chi001';
        $pass = 'chi001';
        $charset = 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";

        try {
            // Establish the PDO connection
            $this->connection = new PDO($dsn, $user, $pass);

            // Set attributes for error handling and fetching data
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // In a production application, you should log this error,
            // not display it directly to the user.
            error_log("Database connection failed: " . $e->getMessage());
            exit("Critical Error: Database connection failed.");
        }
    }

    /**
     * Public static method to get the single instance of the DatabaseSingleton.
     * This is the only way to instantiate the class.
     */
    public static function getInstance(): DatabaseSingleton {
        if (self::$instance === null) {
            self::$instance = new DatabaseSingleton();
        }
        return self::$instance;
    }

    /**
     * Generic method for SELECT queries.
     * Uses prepared statements for security (prevents SQL injection).
     * @param string $sql The SQL query to execute.
     * @param array $params Optional array of parameters for the prepared statement.
     * @return array The resulting data as an array of associative arrays.
     */
        public function query(string $sql, array $params = []): array {
            $stmt = $this->connection->prepare($sql);

            if (!empty($params)) {
                // Check if using positional (?) or named (:key) placeholders
                if (array_keys($params)[0] === 0) { // Positional
                    $i = 1;
                    foreach ($params as $value) {
                        if (is_int($value)) {
                            $stmt->bindValue($i, $value, PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($i, $value, PDO::PARAM_STR);
                        }
                        $i++;
                    }
                } else { // Named
                    foreach ($params as $key => $value) {
                        if (is_int($value)) {
                            $stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
                        }
                    }
                }
            }

            $stmt->execute();
            return $stmt->fetchAll();
        }

    /**
     * Generic method for INSERT, UPDATE, and DELETE statements.
     * Uses prepared statements for security.
     * @param string $sql The SQL statement to execute.
     * @param array $params Optional array of parameters for the prepared statement.
     * @return int The number of rows affected.
     */
        public function execute(string $sql, array $params = []): int {
            $stmt = $this->connection->prepare($sql);

            if (!empty($params)) {
                // Check if using positional (?) or named (:key) placeholders
                if (array_keys($params)[0] === 0) { // Positional
                    $i = 1;
                    foreach ($params as $value) {
                        if (is_int($value)) {
                            $stmt->bindValue($i, $value, PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue($i, $value, PDO::PARAM_STR);
                        }
                        $i++;
                    }
                } else { // Named
                    foreach ($params as $key => $value) {
                        if (is_int($value)) {
                            $stmt->bindValue(':' . $key, $value, PDO::PARAM_INT);
                        } else {
                            $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
                        }
                    }
                }
            }

            $stmt->execute();
            return $stmt->rowCount();
        }

    /**
     * Returns the ID of the last inserted row or sequence value.
     * Useful after an INSERT operation.
     * @return string The last inserted ID.
     */
    public function lastInsertId(): string {
        return $this->connection->lastInsertId();
    }

    // --- Prevent Cloning and Unserialization to ensure single instance ---
    private function __clone() {}
    public function __wakeup() {}
}