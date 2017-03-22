<?php

spl_autoload_register(function($class) {
  // '\'はエスケープが必要 -> '\\'
  $prefix = 'MyApp\\';
  // strpos -> $class内に$prefixが最初に現れる場所を見つける
  if (strpos($class, $prefix) === 0) {
    // substr -> $classの$prefix番目以降の文字列を返す（ MyApp\~~ ）
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__ . '/' . $className . '.php';

    if (file_exists($classFilePath)) {
      require $classFilePath;
    } else {
      echo "No such class: " . $className;
      exit;
    }

  }

});
