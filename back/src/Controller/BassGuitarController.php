<?php

namespace App\Controller;

use App\Entity\BassGuitar;
use App\Form\BassGuitarType;
use App\Repository\BassGuitarRepository;
use Doctrine\ORM\EntityManagerInterface;
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
            $imagenBajo = 'http://localhost:8080/uploads/' . $g->getImagen();
            $resultado[] =  [
                'id' => $g->getId(),
                'nombre' =>  $g->getNombre(),
                'caracteristicas' => $g->getCaracteristicas(),
                'imagen' => $imagenBajo
            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/new", name="app_bass_guitar_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em, BassGuitarRepository $bassGuitarRepository): Response
    {
        /** @var User $user */
        $usuario = $this->getUser();
        $resultado = "ko";
        $guitarNombre = $request->request->get("nombre");
        $guitarCaracteristicas = $request->request->get("caracteristicas");
        $guitarPrecio = $request->request->get("precio");
        $imagen = $request->files->get('imagen');

        if (!empty($guitarNombre)) {
            $nombreImagen = '';
            if (!empty($imagen)) {
                if (!empty($imagen->getClientOriginalName())) {
                    $nombreImagen = uniqid() . '_' . strtolower(trim(preg_replace('/[^A-Za-z.]+/', '-', $imagen->getClientOriginalName())));
                    $imagen->move('uploads/', $nombreImagen);
                }
            }
            // Aquí creamos la publicación, con la información introducida
            // Por el usuario.

            $bassguitar = new BassGuitar();

            // Obtenemos toda la información dada por el usuario y 
            // la introducimos en la publicación.

            $bassguitar->setUsuario($usuario);
            $bassguitar->setNombre($guitarNombre);
            $bassguitar->setCaracteristicas($guitarCaracteristicas);
            $bassguitar->setPrice($guitarPrecio);
            $bassguitar->setImagen($nombreImagen);

            $em->persist($bassguitar);
            $em->flush();
        }
        //Aquí lo retornamos com "result", Toda la información.
        return $this->json([
            'result' => $resultado
        ]);
    }

    /**
     * @Route("/{id}", name="app_bass_guitar_show", methods={"GET"})
     */
    public function show(BassGuitar $bassGuitar): Response
    {
        $imagenBajo = 'http://localhost:8080/uploads/' . $bassGuitar->getImagen();
        $resultado = [
            'nombre' => $bassGuitar->getNombre(),
            'caracteristicas' =>  $bassGuitar->getCaracteristicas(),
            'precio' => $bassGuitar->getPrice(),
            'imagen' => $imagenBajo
        ];
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/{id}/edit", name="app_bass_guitar_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em, BassGuitar $bassGuitar, BassGuitarRepository $bassGuitarRepository): Response
    {
        $resultado = "ko";
        $guitarNombre = $request->request->get("nombre");
        $guitarCaracteristicas = $request->request->get("caracteristicas");
        $guitarPrecio = $request->request->get("precio");
        $imagen = $request->files->get('imagen');

        // Si el título no está vacío al hacer el Edit de la publicación,
        // Entonces hacemos el fetch y cambiamos la información de  la 
        // publicación.

        if (!empty($publicacionTitulo)) {
            $nombreImagen = '';
            if (!empty($imagen)) {
                if (!empty($imagen->getClientOriginalName())) {
                    $nombreImagen = uniqid() . '_' . strtolower(trim(preg_replace('/[^A-Za-z.]+/', '-', $imagen->getClientOriginalName())));
                    $imagen->move('uploads/', $nombreImagen);
                }
            }
            // Aquí obtenemos la información del formnulario y la introducimos
            // en la publicación, si algun campo no es modificado, se queda como está.


            $bassGuitar->setNombre($guitarNombre);
            $bassGuitar->setCaracteristicas($guitarCaracteristicas);
            $bassGuitar->setPrice($guitarPrecio);
            $bassGuitar->setImagen($nombreImagen);

            $em->persist($bassGuitar);
            $em->flush();
        }
        return $this->json([
            'resultado' => $resultado
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_bass_guitar_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EntityManagerInterface $em, BassGuitar $bassGuitar, $id, BassGuitarRepository $bassGuitarRepository): Response
    {
        $resultado = "ko";
        if (!empty($id)) {
            $bassGuitar = $bassGuitarRepository->find($id);
            $em->remove($bassGuitar);
            $em->flush();
            $resultado = "ok";
        }

        return $this->json([
            'result' => $resultado,
        ]);
    }
}
