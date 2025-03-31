<?php

class AuthView{
    private $user = null;


    function showLogin($error = ''){
        require 'templates/form_login.phtml';
    }
}