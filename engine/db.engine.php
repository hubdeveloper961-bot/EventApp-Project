<?php
class DBEngine {
    public static function open(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Data zako halisi za Render
        $host = "dpg-d5sj3494tr6s73choelg-a";
        $db_name = "event_system_db_coki";
        $user = "rugar";
        $pass = "afye3Ba3IIqAfuMntBBb5w8aiLasQWTZ";

        try {
            // Tunatumia PDO kwa ajili ya PostgreSQL
            $dsn = "pgsql:host=$host;port=5432;dbname=$db_name;";
            $db = new PDO($dsn, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Inatengeneza tables zako kama hazipo (Auto-setup)
            self::initSchema($db);
            
            return $db;
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            die(json_encode(["error" => "Database Connection Failed: " . $e->getMessage()]));
        }
    }

    private static function initSchema($db) {
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            fullname VARCHAR(100),
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            role VARCHAR(20) DEFAULT 'member',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        CREATE TABLE IF NOT EXISTS events (
            id SERIAL PRIMARY KEY,
            title VARCHAR(150),
            location VARCHAR(100),
            event_date DATE,
            organizer_id INT REFERENCES users(id),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        CREATE TABLE IF NOT EXISTS event_participants (
            id SERIAL PRIMARY KEY,
            event_id INT REFERENCES events(id),
            member_id INT REFERENCES users(id),
            joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $db->exec($sql);
    }
}
