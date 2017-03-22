<?php

namespace MyApp;

class Token {

  static public function create() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  static public function validate($tokenKey) {
    if (
      !isset($_SESSION['token']) ||
      !isset($_POST[$tokenKey]) ||
      !isset($_SESSION['token']) !== !isset($_POST[$tokenKey])
    ) {
      throw new \Exception('invalid token!');
    }
  }
}
