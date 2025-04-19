<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer')]
final class CustomerController extends AbstractController
{
    #[Route(name: 'app_customer_index', methods: ['GET'])]
    public function index(CustomerRepository $customerRepository): Response
    {
        return $this->render('customer/index.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{customerId}', name: 'app_customer_show', methods: ['GET'])]
    public function show(int $customerId, CustomerRepository $customerRepository): Response
    {
        $customer = $customerRepository->find($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('Klient o ID '.$customerId.' nie istnieje.');
        }

        return $this->render('customer/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    #[Route('/{customerId}/edit', name: 'app_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $customerId, CustomerRepository $customerRepository, EntityManagerInterface $entityManager): Response
    {
        $customer = $customerRepository->find($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('Klient o ID '.$customerId.' nie istnieje.');
        }

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{customerId}', name: 'app_customer_delete', methods: ['POST'])]
    public function delete(Request $request, int $customerId, CustomerRepository $customerRepository, EntityManagerInterface $entityManager): Response
    {
        $customer = $customerRepository->find($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('Klient o ID '.$customerId.' nie istnieje.');
        }

        if ($this->isCsrfTokenValid('delete'.$customer->getCustomerId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
