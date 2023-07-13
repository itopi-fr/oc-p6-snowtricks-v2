<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Trick;
use App\Entity\TrickCategory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
//    #[Route(['/', '/home'], name: 'app_home')]
//    #[Route(['/{pseudo}'], name: 'app_home')]
    #[Route(['/{slug}'], name: 'app_home')]
    public function index(Trick $obj): Response
    {
        dump($obj);

        // Test Trick
        // URL : /
        dump($obj->getTitle());
        dump($obj->getCategory()->getTitle());

        // User
//        dump($obj->getAvatarFile());
//        dump($obj->getForumMessages());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
