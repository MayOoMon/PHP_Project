<?php

  function base_path($file){
    return BASE_PATH . $file;
  }
  
  function login($user){
    $_SESSION['user']=$user;
  }

  function urlIs($value)
  {
    return $_SERVER["REQUEST_URI"] == $value;
  }
  
  function view($path , $options = [])
  {
    extract($options);
    require base_path('view/' . $path);
  }


  