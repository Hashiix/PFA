<?php

namespace App\Controller;

use App\Entity\Member;
use App\Services\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index(CallApiService $callApiService, EntityManagerInterface $em, int $id, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $em->getRepository(Member::class)->find($id);

        $form = $this->createFormBuilder($user)
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Password',
                    'class'       => 'form-control',
                    'style'       => 'display: initial',
                    'minlength'   => 8,
                    'empty_data'  => $user->getPassword()
                ]
            ])
            ->add('passwordVerify', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Password confirmation',
                    'class'       => 'form-control',
                    'style'       => 'display: initial',
                    'minlength'   => 8,
                    'empty_data'  => $user->getPassword()
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'class'       => 'form-control',
                    'style'       => 'display: initial',
                ]
            ])
            ->add('avatar', FileType::class, [
                'mapped'   => false,
            ])
            ->getForm()
        ;

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            dd($request);
            if($user->getPassword() != null) {
                $hash = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($hash);
            }



            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Your information has been updated !'
            );

            return $this->redirectToRoute('profile', ['id' => $user->getId()]);
        }

        $getW     = $user->getWatchings();
        $wIds     = [];
        $wContent = [];

        foreach ($getW as $anime) {
            array_push($wIds, $anime->getAnime());
        }

        foreach ($wIds as $anime) {
            array_push($wContent, $callApiService->getAnime($anime));
        }

        $getC     = $user->getCompletes();
        $cIds     = [];
        $cContent = [];

        foreach ($getC as $anime) {
            array_push($cIds, $anime->getAnime());
        }

        foreach ($cIds as $anime) {
            array_push($cContent, $callApiService->getAnime($anime));
        }

        $getP     = $user->getPlannings();
        $pIds     = [];
        $pContent = [];

        foreach ($getP as $anime) {
            array_push($pIds, $anime->getAnime());
        }

        foreach ($pIds as $anime) {
            array_push($pContent, $callApiService->getAnime($anime));
        }

        return $this->render(
            'profil/index.html.twig',
            [
                'user'  => $user,
                'form'  => $form->createView(),
                'wList' => $wContent,
                'cList' => $cContent,
                'pList' => $pContent,
            ]
        );

    }


}