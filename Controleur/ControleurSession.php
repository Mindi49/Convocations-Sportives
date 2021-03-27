<?php

require_once 'Session.php';

abstract class ControleurSession {
    protected $session;

    public function __construct() {
        $this->session = new Session();
    }
}