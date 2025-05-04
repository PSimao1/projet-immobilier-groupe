<?php

namespace Framework\Session;

use Framework\Session\SessionInterface;

class FlashService 
{
private $sessionKey = 'flash';

private $messages;

    public function __construct(private SessionInterface $session)
    {

    }

    public function success(string $message)
    {
        $flash = $this->session->get($this->sessionKey, []);
        $flash['success'] = $message;
        $this->session->set($this->sessionKey, $flash);
    }

    public function error(string $message)
    {
        $flash = $this->session->get($this->sessionKey, []);
        $flash['error'] = $message;
        $this->session->set($this->sessionKey, $flash);
    }

    public function get(string $type): ?string
    {
        if(is_null($this->messages)) {
            $this->messages = $this->session->get($this->sessionKey, []);
            $this->session->delete($this->sessionKey);

        }

        if(array_key_exists($type, $this->messages)) {
            return $this->messages[$type];
        }
        
        return null;
    }

}