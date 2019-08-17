<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Twig\Environment;

use Symfony\Component\HttpFoundation\Response;

class AccueilController extends AbstractController
{

    public function index ()
    {


        return $this->render('accueil/index.html.twig');

    }






    /*private $twig;

    public function _construct($twig)
    {
        $this->twig=$twig;
    }





    public function index() : Response
    {
        return  new Response($this->twig->render('home/index.html.twig'));
    }*/
}
