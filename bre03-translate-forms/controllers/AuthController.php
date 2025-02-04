<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    public function __construct()
    {
        $lang = $_SESSION["lang"];

        parent::__construct("auth", $lang);
    }

    public function getTranslator() : Translator
    {
        return $this->translator;
    }

    public function login()
    {
        $this->render("login", []);
    }

    public function register()
    {
        $this->render("register", []);
    }

    public function switchLang()
    {
        if($_SESSION["lang"] === "fr")
        {
            $_SESSION["lang"] = "en";
        }
        else
        {
            $_SESSION["lang"] = "fr";
        }

        $this->redirect("index.php");
    }
}