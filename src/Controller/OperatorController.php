<?php

namespace App\Controller;

use App\Entity\Operator;
use App\Form\OperatorType;
use App\Repository\OperatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/operator')]
class OperatorController extends AbstractController
{
    #[Route('/', name: 'app_operator_index', methods: ['GET'])]
    public function index(OperatorRepository $operatorRepository): Response
    {
        return $this->render('operator/index.html.twig', [
            'operators' => $operatorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_operator_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OperatorRepository $operatorRepository): Response
    {
        $operator = new Operator();
        $form = $this->createForm(OperatorType::class, $operator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operatorRepository->save($operator, true);

            return $this->redirectToRoute('app_operator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('operator/new.html.twig', [
            'operator' => $operator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_operator_show', methods: ['GET'])]
    public function show(Operator $operator): Response
    {
        return $this->render('operator/show.html.twig', [
            'operator' => $operator,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_operator_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Operator $operator, OperatorRepository $operatorRepository): Response
    {
        $form = $this->createForm(OperatorType::class, $operator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operatorRepository->save($operator, true);

            return $this->redirectToRoute('app_operator_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('operator/edit.html.twig', [
            'operator' => $operator,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_operator_delete', methods: ['POST'])]
    public function delete(Request $request, Operator $operator, OperatorRepository $operatorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operator->getId(), $request->request->get('_token'))) {
            $operatorRepository->remove($operator, true);
        }

        return $this->redirectToRoute('app_operator_index', [], Response::HTTP_SEE_OTHER);
    }
}
