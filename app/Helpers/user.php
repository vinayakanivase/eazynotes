<?php

/**
 * Return current logged-in user.
 * 
 * @return mixed
 */
if (! function_exists('user')) {
  function user() {
    return auth()->user();
  }
}

/**
 * Return Api Token for current logged-in user.
 * 
 * @return mixed
 */
if (! function_exists('api_token')) {
  function api_token() {
    return (auth()->check()) ? auth()->user()->api_token : null;
  }
}
