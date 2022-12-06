<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Form\SalleType;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/salle')]
//pour donner accès qu'aux admins
#[IsGranted('ROLE_ADMIN')]
class SalleController extends AbstractController
{
    #[Route('/', name: 'app_salle_index', methods: ['GET'])]
    public function index(SalleRepository $salleRepository): Response
    {
        return $this->render('salle/index.html.twig', [
            'salles' => $salleRepository->findAll(),
            'cible' => ''
        ]);
    }

    #[Route('/new', name: 'app_salle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SalleRepository $salleRepository): Response
    {
        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('nom')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_img'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $salle->setImage($FileName);
                }
            $salleRepository->save($salle, true);

            return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salle/index.html.twig', [
            'salle' => $salle,
            'form' => $form->createView(),
            'salles' => $salleRepository->findAll(),
            'cible' => 'modalajouter'
        ]);
    }

    #[Route('/{id}/show', name: 'app_salle_show', methods: ['GET'])]
    public function show(Salle $salle, SalleRepository $salleRepository): Response
    {
        return $this->render('salle/index.html.twig', [
            'salle' => $salle,
            'salles' => $salleRepository->findAll(),
            'cible' => 'modalconsulter'
        ]);
    }

    #[Route('/{id}/edit', name: 'app_salle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
                if ($file != null) {
                date_default_timezone_set('Europe/Paris');
                $date = date('dmyhi');

                    $FileName = $form->get('nom')->getData().'-'.$date.'.'.$file->guessExtension();
                    try {
                        $file->move(
                            $this->getParameter('upload_directory_img'),
                            $FileName
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $salle->setImage($FileName);
                }
            $salleRepository->save($salle, true);

            return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salle/index.html.twig', [
            'salle' => $salle,
            'form' => $form->createView(),
            'salles' => $salleRepository->findAll(),
            'cible' => 'modalmodifier'
        ]);
    }

    #[Route('/{id}', name: 'app_salle_delete')]
    public function delete(int $id, Salle $salle, EntityManagerInterface $entityManager): Response
    {
        $salle = $entityManager
        ->getRepository(Salle::class)
        ->find($id);
    $entityManager->remove($salle);
    $entityManager->flush();

        return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
