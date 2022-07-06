<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    /**
     * @Route ("/biens", name="property.index")
     */
    public function index() : Response
    {
        return $this->render(view:'property/index.html.twig',parameters: [
            'current_menu' => 'properties'
        ]);
    }
}