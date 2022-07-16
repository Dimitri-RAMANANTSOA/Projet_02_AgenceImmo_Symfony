<?php
namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/picture')]
class AdminPictureController extends AbstractController
{
    #[Route("/{id}", name: "admin.picture.delete", methods: ['POST'])]
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $data['_token'])) {
            $pictureRepository->remove($picture, true);
            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);        
    }    
}