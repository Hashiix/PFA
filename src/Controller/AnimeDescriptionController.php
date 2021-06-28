<?php

namespace App\Controller;

use App\Entity\Complete;
use App\Entity\Member;
use App\Entity\Planning;
use App\Entity\Watching;
use App\Services\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimeDescriptionController extends AbstractController
{
    /**
     * @Route("/anime/{id}", name="description")
     */
    public function description(CallApiService $callApiService, EntityManagerInterface $em, int $id, Request $request)
    {
        $anime = $callApiService->getAnime($id);
        $user = $this->getUser();

        $watching = $request->request->get('watching');
        $complete = $request->request->get('complete');
        $planning = $request->request->get('planning');

        $wCount = $em->getRepository(Watching::class)->findBy(['anime' => $id]);
        $cCount = $em->getRepository(Complete::class)->findBy(['anime' => $id]);
        $pCount = $em->getRepository(Planning::class)->findBy(['anime' => $id]);

        $alreadyW = 0;
        $alreadyC = 0;
        $alreadyP = 0;

        if($user) {
            foreach ($wCount as $w) {
                foreach ($w->getMember() as $m) {
                    if ($m->getId() == $user->getId()) {
                        $alreadyW = 1;
                    }
                }
            }

            foreach ($cCount as $c) {
                foreach ($c->getMember() as $m) {
                    if ($m->getId() == $user->getId()) {
                        $alreadyC = 1;
                    }
                }
            }

            foreach ($pCount as $p) {
                foreach ($p->getMember() as $m) {
                    if ($m->getId() == $user->getId()) {
                        $alreadyP = 1;
                    }
                }
            }

            if ($watching != null) {
                if ($alreadyW == 0) {
                    if ($alreadyC == 1) {
                        foreach ($cCount as $c) {
                            foreach ($c->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($c);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyC = 0;
                    }

                    if ($alreadyP == 1) {
                        foreach ($pCount as $p) {
                            foreach ($p->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($p);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyP = 0;
                    }

                    $setWatching = new Watching();

                    $setWatching->addMember($user);
                    $setWatching->setAnime($id);

                    $em->persist($setWatching);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'This anime has been added to your watching list !'
                    );
                } else {
                    foreach ($wCount as $w) {
                        foreach ($w->getMember() as $m) {
                            if ($m->getId() == $user->getId()) {
                                $em->remove($w);
                                $em->flush();

                                $this->addFlash(
                                    'warning',
                                    'This anime is not in your watching list anymore !'
                                );
                            }
                        }
                    }
                }
            }

            if ($complete != null) {

                if ($alreadyC == 0) {
                    if ($alreadyW == 1) {
                        foreach ($wCount as $w) {
                            foreach ($w->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($w);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyW = 0;
                    }

                    if ($alreadyP == 1) {
                        foreach ($pCount as $p) {
                            foreach ($p->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($p);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyP = 0;
                    }

                    $setComplete = new Complete();

                    $setComplete->addMember($user);
                    $setComplete->setAnime($id);

                    $em->persist($setComplete);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'This anime has been added to your completed list !'
                    );
                } else {
                    foreach ($cCount as $c) {
                        foreach ($c->getMember() as $m) {
                            if ($m->getId() == $user->getId()) {
                                $em->remove($c);
                                $em->flush();

                                $this->addFlash(
                                    'warning',
                                    'This anime is not in your completed list anymore !'
                                );
                            }
                        }
                    }
                }
            }

            if ($planning != null) {
                if ($alreadyP == 0) {
                    if ($alreadyW == 1) {
                        foreach ($wCount as $w) {
                            foreach ($w->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($w);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyW = 0;
                    }

                    if ($alreadyC == 1) {
                        foreach ($cCount as $c) {
                            foreach ($c->getMember() as $m) {
                                if ($m->getId() == $user->getId()) {
                                    $em->remove($c);
                                    $em->flush();
                                }
                            }
                        }
                        $alreadyC = 0;
                    }

                    $setPlanning = new Planning();

                    $setPlanning->addMember($user);
                    $setPlanning->setAnime($id);

                    $em->persist($setPlanning);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'This anime has been added to your planning list !'
                    );
                } else {
                    foreach ($pCount as $p) {
                        foreach ($p->getMember() as $m) {
                            if ($m->getId() == $user->getId()) {
                                $em->remove($p);
                                $em->flush();

                                $this->addFlash(
                                    'warning',
                                    'This anime is not in your planning list anymore !'
                                );
                            }
                        }
                    }
                }
            }
        }

        return $this->render(
            'anime_description/index.html.twig',
            [
                'anime'  => $anime,
                'wCount' => $wCount,
                'cCount' => $cCount,
                'pCount' => $pCount,
            ]
        );

    }


}