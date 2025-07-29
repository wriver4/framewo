<?php

/**
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

class Security
{
    public function __construct()
    {
        // Initialize security settings
        $this->start_session();
    }

    public function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function is_logged_in()
    {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    public function require_login()
    {
        if (!$this->is_logged_in()) {
            header("Location: /login");
            exit();
        }
    }

    public function login($user_id, $username, $role = null)
    {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['loggedin'] = true;
        $_SESSION['login_time_stamp'] = time();
        
        // Regenerate session ID for security
        session_regenerate_id(true);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function get_user_id()
    {
        return $_SESSION['user_id'] ?? null;
    }

    public function get_username()
    {
        return $_SESSION['username'] ?? null;
    }

    public function get_user_role()
    {
        return $_SESSION['role'] ?? null;
    }

    public function has_permission($required_role)
    {
        $user_role = $this->get_user_role();
        // Implement your role hierarchy logic here
        return $user_role >= $required_role;
    }

    public function check_session_timeout($timeout = 3600)
    {
        if (isset($_SESSION['login_time_stamp'])) {
            if (time() - $_SESSION['login_time_stamp'] > $timeout) {
                $this->logout();
            } else {
                // Update timestamp
                $_SESSION['login_time_stamp'] = time();
            }
        }
    }

    public function generate_csrf_token()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function verify_csrf_token($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verify_password($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function sanitize_input($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public function validate_input($data, $rules)
    {
        $errors = [];
        
        foreach ($rules as $field => $rule_set) {
            $value = $data[$field] ?? '';
            
            foreach ($rule_set as $rule) {
                switch ($rule) {
                    case 'required':
                        if (empty(trim($value))) {
                            $errors[$field][] = ucfirst($field) . ' is required';
                        }
                        break;
                    case 'email':
                        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = ucfirst($field) . ' must be a valid email';
                        }
                        break;
                    case 'min:14':
                        if (!empty($value) && strlen($value) < 14) {
                            $errors[$field][] = ucfirst($field) . ' must be at least 14 characters';
                        }
                        break;
                }
            }
        }
        
        return $errors;
    }
}