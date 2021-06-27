<?php

namespace App\Controller;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index(EntityManagerInterface $em, int $id)
    {
        $user = $em->getRepository(Member::class)->find($id);


        //dd($user);

        return $this->render(
            'profil/index.html.twig',
            [
                'user' => $user,
            ]
        );

    }


}