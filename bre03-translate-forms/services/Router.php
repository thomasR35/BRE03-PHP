<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Router
{
    private AuthController $am;

    public function __construct()
    {
        $this->am = new AuthController();
    }
    public function handleRequest(array $get) : void
    {
        if (isset($get["route"]) && $get["route"] === "register")
        {
            $this->am->register();
        }
        else if(isset($get["route"]) && $get["route"] === "switch-lang")
        {
            $this->am->switchLang();
        }
        else
        {
            $this->am->login();
        }
    }
}