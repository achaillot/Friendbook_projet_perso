<?php

namespace App\Controller;

use App\Entity\Advice;
use App\Form\AdviceType;
use App\Form\AnswerType;
use App\Repository\AdviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advice")
 */
class AdviceController extends AbstractController
{
    /**
     * @Route("/", name="advice_index", methods={"GET"})
     */
    public function index(AdviceRepository $adviceRepository): Response
    {
        return $this->render('advice/index.html.twig', [
            'advices' => $adviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="advice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $advice = new Advice();
        $form = $this->createForm(AdviceType::class, $advice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advice);
            $entityManager->flush();

            return $this->redirectToRoute('advice_index');
        }

        return $this->render('advice/new.html.twig', [
            'advice' => $advice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advice_show", methods={"GET"})
     */
    public function show(Advice $advice): Response
    {
        return $this->render('advice/show.html.twig', [
            'advice' => $advice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Advice $advice): Response
    {
        $form = $this->createForm(AdviceType::class, $advice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advice_index');
        }

        return $this->render('advice/edit.html.twig', [
            'advice' => $advice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Advice $advice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advice_index');
    }

    /**
     * @Route("/{id}/response", name="advice_response", methods={"GET","POST"})
     * @param Request $request
     * @param Advice $advice
     * @return Response
     */
    public function response(Request $request, Advice $advice): Response
    {
        $form = $this->createForm(AnswerType::class, $advice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advice_index');
        }

        return $this->render('advice/answer.html.twig', [
            'advice' => $advice,
            'form' => $form->createView(),
        ]);
    }
}
