<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route ("/biens", name="property.index")
     */
    public function index() : Response
    {
    /*
        $property= new Property();
        $property
            ->setTitle('Mon premier bien')
            ->setDescription('ma description')
            ->setSurface('40')
            ->setRooms('4')
            ->setBedroom('1')
            ->setFloor('1')
            ->setPrice('200000')
            ->setHeat('1')
            ->setCity('Villiers le mahieu')
            ->setAddress('4 rue des 24 arpents')
            ->setPostalCode('78770');

        $em = $doctrine->getManager();
        $em->persist($property);
        $em->flush();
    */

        return $this->render(view:'property/index.html.twig',parameters: [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug" : "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        $s = $property->getSlug();
        if($s !== $slug)
        {
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $s
            ], 301);
        }
        return $this->render(view:'property/show.html.twig', parameters:[
            'property' => $property,
            'current_menu' => 'properties']);
    }
}