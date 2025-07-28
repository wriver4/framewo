<?php

/**
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

class Helpers
{
  public function __construct()
  {
    // Constructor can be extended by child classes
  }

  // Password utilities
  public function hash_password($password)
  {
    $hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    return $hash;
  }

  public function is_password($password)
  {
    $get_prefix = substr($password, 0, 3);
    $prefix = ['$2y', '$2a', '$2b', '$2x'];
    if (in_array($get_prefix, $prefix)) {
      return true;
    } else {
      return false;
    }
  }

  public function verify_password($password, $hash)
  {
    $get_prefix = substr($hash, 0, 3);
    switch ($get_prefix) {
      case '$2a':
        $converted = str_replace("$2a", "$2y", $hash);
        break;
      case '$2b':
        $converted = str_replace("$2b", "$2y", $hash);
        break;
      case '$2x':
        $converted = str_replace("$2x", "$2y", $hash);
        break;
      case '$2y':
        $converted = $hash;
        break;
      default:
        $converted = $hash;
        break;
    }
    $verify = password_verify($password, $converted);
    return $verify;
  }

  // Status utilities
  public function get_status($status)
  {
    $status = $status == 1 ? 'Active' : 'Inactive';
    return $status;
  }

  public function set_status($status)
  {
    echo '<option value="' . $status . '">' . $this->get_status($status) . '</option>';
    echo $status == 1 ? '<option value="0">Inactive</option>' : '<option value="1">Active</option>';
  }

  // Time utilities
  public function ago($time)
  {
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $difference = $now - $time;
    $tense = 'ago';
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
      $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
      $periods[$j] .= "s";
    }
    return $difference . " " . $periods[$j] . " ago";
  }

  // Session management
  public function sessionmanager($timeout = 600)
  {
    if (isset($_SESSION["user_id"])) {
      if (time() - $_SESSION["login_time_stamp"] > $timeout) {
        session_unset();
        session_destroy();
        header("Location: /login");
      }
    } else {
      header("Location: /login");
    }
  }

  // String utilities
  public function sanitize_input($input)
  {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
  }

  public function clean_string($string)
  {
    $string = trim($string);
    $string = ltrim($string, ',');
    $string = rtrim($string, ',');
    if (strpos($string, ', ') == true) {
      $string = str_replace(", ", ",", $string);
    }
    if (strpos($string, ' ') == true) {
      $string = str_replace(" ", ",", $string);
    }
    return $string;
  }

  // URL utilities
  public function redirect($url)
  {
    header("Location: " . $url);
    exit();
  }

  public function current_url()
  {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  // Validation utilities
  public function validate_email($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  public function validate_required($fields)
  {
    $errors = [];
    foreach ($fields as $field => $value) {
      if (empty(trim($value))) {
        $errors[] = $field . ' is required';
      }
    }
    return $errors;
  }

  // Array utilities
  public function array_to_select_options($array, $selected = null, $value_key = null, $text_key = null)
  {
    $options = '';
    foreach ($array as $key => $item) {
      $value = $value_key ? $item[$value_key] : $key;
      $text = $text_key ? $item[$text_key] : $item;
      $selected_attr = ($selected == $value) ? ' selected="selected"' : '';
      $options .= '<option value="' . htmlspecialchars($value) . '"' . $selected_attr . '>' . htmlspecialchars($text) . '</option>';
    }
    return $options;
  }
}