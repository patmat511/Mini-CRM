<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Form\DealType;
use App\Repository\DealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/deal')]
final class DealController extends AbstractController
{
    #[Route(name: 'app_deal_index', methods: ['GET'])]
    public function index(DealRepository $dealRepository): Response
    {
        return $this->render('deal/index.html.twig', [
            'deals' => $dealRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_deal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $deal = new Deal();
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($deal);
            $entityManager->flush();

            return $this->redirectToRoute('app_deal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deal/new.html.twig', [
            'deal' => $deal,
            'form' => $form,
        ]);
    }

    #[Route('/{dealId}', name: 'app_deal_show', methods: ['GET'])]
    public function show(Deal $deal): Response
    {
        return $this->render('deal/show.html.twig', [
            'deal' => $deal,
        ]);
    }

    #[Route('/{dealId}/edit', name: 'app_deal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Deal $deal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_deal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('deal/edit.html.twig', [
            'deal' => $deal,
            'form' => $form,
        ]);
    }

    #[Route('/{dealId}', name: 'app_deal_delete', methods: ['POST'])]
    public function delete(Request $request, Deal $deal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deal->getDealId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($deal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_deal_index', [], Response::HTTP_SEE_OTHER);
    }
}
