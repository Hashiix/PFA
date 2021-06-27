<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Jikan\Jikan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Services\CallApiService;

class ListController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(CallApiService $callApiService)
    {
        $topAnime      = $callApiService->getTopanime();
        $weekSchedule  = $callApiService->getWeekanime();
        $upcomingAnime = $callApiService->getUpcoming();
        $weekSchedule  = $callApiService->getWeekanime();

        $allWeekMerged = array_merge(
            $weekSchedule['monday'],
            $weekSchedule['tuesday'],
            $weekSchedule['wednesday'],
            $weekSchedule['thursday'],
            $weekSchedule['friday'],
            $weekSchedule['saturday'],
            $weekSchedule['sunday']
        );

        return $this->render(
            'list/index.html.twig',
            [
                'top'      => $topAnime,
                'week'     => $allWeekMerged,
                'upcoming' => $upcomingAnime,
            ]
        );

    }


}