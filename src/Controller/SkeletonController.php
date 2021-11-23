<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkeletonController extends AbstractController
{
    #[Route('/skeleton', name: 'skeleton')]
    public function index(): Response
    {
        return $this->render('skeleton/index.html.twig', [
            'controller_name' => 'SkeletonController',
        ]);
    }
}
