<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );        
        return $this->render(view:'property/index.html.twig',parameters: [
            'properties' => $properties,
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