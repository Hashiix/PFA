<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Jikan\Jikan;
use Jikan\Helper\Constants;
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
        $jikan = new Jikan();
        $jikanTopTitles = new Jikan();
        $topAnimeTitles = [];

        $topAnime = $jikan->Top("anime", 0);


        /*foreach ($topAnime->response['top'] as $anime ) {
            array_push($topAnimeTitles, ($jikanTopTitles->Anime($anime['mal_id'])->response['title_english']));
            dd($topAnimeTitles);
        }*/

        //dd($topAnimeTitles);
        //dd($topAnime->response['top']);

        return $this->render('list/index.html.twig', [
            'top' => $topAnime,
        ]);
    }
}