<?php

namespace App\Controller;

use App\Entity\BassGuitar;
use App\Form\BassGuitarType;
use App\Repository\BassGuitarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bass/guitar")
 */
class BassGuitarController extends AbstractController
{
    /**
     * @Route("/", name="app_bass_guitar_index", methods={"GET"})
     */
    public function index(BassGuitarRepository $bassGuitarRepository): Response
    {
        $guitarra = $bassGuitarRepository->findAll();
        $resultado = [];
        foreach ($guitarra as $g) {
            $resultado[] =  [
                'id'=> $g->getId(),
                'nombre' =>  $g->getNombre(),
                'caracteristicas' => $g->getCaracteristicas(),
                'imagen' => $g->getImagen()
            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/new", name="app_bass_guitar_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BassGuitarRepository $bassGuitarRepository): Response
    {
        $bassGuitar = new BassGuitar();
        $form = $this->createForm(BassGuitarType::class, $bassGuitar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bassGuitarRepository->add($bassGuitar, true);

            return $this->redirectToRoute('app_bass_guitar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bass_guitar/new.html.twig', [
            'bass_guitar' => $bassGuitar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bass_guitar_show", methods={"GET"})
     */
    public function show(BassGuitar $bassGuitar): Response
    {
        return $this->render('bass_guitar/show.html.twig', [
            'bass_guitar' => $bassGuitar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_bass_guitar_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BassGuitar $bassGuitar, BassGuitarRepository $bassGuitarRepository): Response
    {
        $form = $this->createForm(BassGuitarType::class, $bassGuitar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bassGuitarRepository->add($bassGuitar, true);

            return $this->redirectToRoute('app_bass_guitar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bass_guitar/edit.html.twig', [
            'bass_guitar' => $bassGuitar,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bass_guitar_delete", methods={"POST"})
     */
    public function delete(Request $request, BassGuitar $bassGuitar, BassGuitarRepository $bassGuitarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bassGuitar->getId(), $request->request->get('_token'))) {
            $bassGuitarRepository->remove($bassGuitar, true);
        }

        return $this->redirectToRoute('app_bass_guitar_index', [], Response::HTTP_SEE_OTHER);
    }
}
