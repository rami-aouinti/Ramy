<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(UserRepository $userRepository, TranslatorInterface $translator): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => $translator->trans('project_name'),
            'users' => $userRepository->findAll()
        ]);
    }
}
