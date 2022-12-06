<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Repository\SalleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilterController extends AbstractController
{
    #[Route('/salles', name: 'salles')]
    public function index(SalleRepository $salleRepository,Request $request): Response
    {
        $sallesFiltre = $salleRepository->findAll();
        $filtrForm = $this->createForm(FiltreType::class);
        $filtrForm->handleRequest($request);
        if($filtrForm->isSubmitted() && $filtrForm->isValid()) {
            $data = $filtrForm->getData();

            $sallesFiltre = $salleRepository->filtreSalle($data);
        }
        return $this->render('salles.html.twig', [
            'salles' => $sallesFiltre,
            'filtersForm' => $filtrForm->createView(),
        ]);
    }
}