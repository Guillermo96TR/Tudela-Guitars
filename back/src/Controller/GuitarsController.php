<?php

namespace App\Controller;

use App\Entity\Guitars;
use App\Form\GuitarsType;
use App\Repository\GuitarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guitars")
 */
class GuitarsController extends AbstractController
{
    /**
     * @Route("/", name="app_guitars_index", methods={"GET"})
     */
    public function index(GuitarsRepository $guitarsRepository): Response
    {
        $guitarra = $guitarsRepository->findAll();
        $resultado = [];
        foreach ($guitarra as $g) {
            $resultado[] =  [
                'id' => $g->getId(),
                'nombre' =>  $g->getNombre(),
                'caracteristicas' => $g->getCaracteristicas(),
                'imagen' => $g->getImagen()
            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/new", name="app_guitars_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GuitarsRepository $guitarsRepository): Response
    {
        $guitar = new Guitars();
        $form = $this->createForm(GuitarsType::class, $guitar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guitarsRepository->add($guitar, true);

            return $this->redirectToRoute('app_guitars_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guitars/new.html.twig', [
            'guitar' => $guitar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guitars_show", methods={"GET"})
     */
    public function show(Guitars $guitar): Response
    {
        $resultado = [
            'nombre' => $guitar->getNombre(),
            'caracteristicas' =>  $guitar->getCaracteristicas(),
            'precio' => $guitar->getPrice(),
            'imagen' => $guitar->getImagen()
        ];
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/{id}/edit", name="app_guitars_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Guitars $guitar, GuitarsRepository $guitarsRepository): Response
    {
        $form = $this->createForm(GuitarsType::class, $guitar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guitarsRepository->add($guitar, true);

            return $this->redirectToRoute('app_guitars_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guitars/edit.html.twig', [
            'guitar' => $guitar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guitars_delete", methods={"POST"})
     */
    public function delete(Request $request, Guitars $guitar, GuitarsRepository $guitarsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $guitar->getId(), $request->request->get('_token'))) {
            $guitarsRepository->remove($guitar, true);
        }

        return $this->redirectToRoute('app_guitars_index', [], Response::HTTP_SEE_OTHER);
    }
}
