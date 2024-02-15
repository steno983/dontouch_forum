<?php

if (!function_exists('isLogged')) {
  function isLogged(): bool
  {
    return (bool)getToken();
  }
}

if (!function_exists('getToken')) {
  function getToken()
  {
    return session('token', null);
  }
}
