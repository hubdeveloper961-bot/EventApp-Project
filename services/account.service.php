<?php
class AccountService {

    public static function register($db, $name, $email, $pass, $role) {
        // Kwenye PDO tunatumia prepare badala ya query moja kwa moja kwa usalama
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        // fetch() inarudisha data kama ipo, vinginevyo inarudisha false
        if ($stmt->fetch()) {
            return json_encode(["error" => "Account already exists"]);
        }

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        
        try {
            $insert = $db->prepare(
                "INSERT INTO users(fullname, email, password, role) 
                 VALUES(?, ?, ?, ?)"
            );
            $insert->execute([$name, $email, $hash, $role]);
            return json_encode(["message" => "Registration successful"]);
        } catch (PDOException $e) {
            return json_encode(["error" => "Registration failed: " . $e->getMessage()]);
        }
    }

    public static function login($db, $email, $pass) {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($u) {
            // password_verify bado inafanya kazi vilevile
            if (password_verify($pass, $u['password'])) {
                $_SESSION['uid'] = $u['id'];
                $_SESSION['role'] = $u['role'];
                return json_encode(["message" => "Login successful"]);
            }
        }
        return json_encode(["error" => "Invalid login"]);
    }

    public static function auth() {
        if (!isset($_SESSION['uid'])) {
            die(json_encode(["error" => "Login required"]));
        }
    }

    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        echo json_encode(["message" => "Logged out"]);
    }
}
