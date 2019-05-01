<?php


namespace App\Controller\Admin;


use App\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{
    /**
     * @Route("/{id}", name="admin.picture.delete", methods={"DELETE"})
     * @param Request $request
     * @param Picture $picture
     * @return Response
     */
    public function delete(Request $request, Picture $picture): Response
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $data['_token'])) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);
        }
        {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
}