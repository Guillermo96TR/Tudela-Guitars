<?php

namespace App\Controller;

use App\Entity\Guitars;
use App\Form\GuitarsType;
use App\Repository\GuitarsRepository;
use Doctrine\ORM\EntityManagerInterface;
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
            $imagenGuitarra = 'http://localhost:8080/uploads/' . $g->getImagen();
            $resultado[] =  [
                'id' => $g->getId(),
                'nombre' =>  $g->getNombre(),
                'caracteristicas' => $g->getCaracteristicas(),
                'imagen' => $imagenGuitarra,
                'usuario' => $g-> getUsuarios()->getNombre()
            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/new", name="app_guitars_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em, GuitarsRepository $guitarsRepository): Response
    {
        /** @var User $user */
        $usuario = $this->getUser();

        $resultado =  $usuario;
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
            // Aqu?? creamos la publicaci??n, con la informaci??n introducida
            // Por el usuario.
            $guitar = new Guitars;

            // Obtenemos toda la informaci??n dada por el usuario y 
            // la introducimos en la publicaci??n.

            $guitar->setUsuarios($usuario);
            $guitar->setNombre($guitarNombre);
            $guitar->setCaracteristicas($guitarCaracteristicas);
            $guitar->setPrice($guitarPrecio);
            $guitar->setImagen($nombreImagen);

            $em->persist($guitar);
            $em->flush();
        }
        // Aqu?? lo retornamos com "result", Toda la informaci??n.
        return $this->json([
            'result' => $resultado
        ]);
    }

    /**
     * @Route("/{id}", name="app_guitars_show", methods={"GET"})
     */
    public function show(Guitars $guitar): Response

    {
        $imagenGuitarra = 'http://localhost:8080/uploads/' . $guitar->getImagen();
        $resultado = [
            'nombre' => $guitar->getNombre(),
            'caracteristicas' =>  $guitar->getCaracteristicas(),
            'precio' => $guitar->getPrice(),
            'imagen' => $imagenGuitarra,
            'usuario' => $guitar->getUsuarios()->getNombre()
        ];
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/{id}/edit", name="app_guitars_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em, Guitars $guitar, GuitarsRepository $guitarsRepository): Response
    {
        $resultado = "ko";
        $guitarNombre = $request->request->get("nombre");
        $guitarCaracteristicas = $request->request->get("caracteristicas");
        $guitarPrecio = $request->request->get("precio");
        $imagen = $request->files->get('imagen');

        // Si el t??tulo no est?? vac??o al hacer el Edit de la publicaci??n,
        // Entonces hacemos el fetch y cambiamos la informaci??n de  la 
        // publicaci??n.

        if (!empty($publicacionTitulo)) {
            $nombreImagen = '';
            if (!empty($imagen)) {
                if (!empty($imagen->getClientOriginalName())) {
                    $nombreImagen = uniqid() . '_' . strtolower(trim(preg_replace('/[^A-Za-z.]+/', '-', $imagen->getClientOriginalName())));
                    $imagen->move('uploads/', $nombreImagen);
                }
            }
            // Aqu?? obtenemos la informaci??n del formnulario y la introducimos
            // en la publicaci??n, si algun campo no es modificado, se queda como est??.


            $guitar->setNombre($guitarNombre);
            $guitar->setCaracteristicas($guitarCaracteristicas);
            $guitar->setPrice($guitarPrecio);
            $guitar->setImagen($nombreImagen);

            $em->persist($guitar);
            $em->flush();
        }
        return $this->json([
            'resultado' => $resultado
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_guitars_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Guitars $guitar, $id, EntityManagerInterface $em, GuitarsRepository $guitarsRepository): Response
    {
        $resultado = "ko";
        if (!empty($id)) {
            $guitar = $guitarsRepository->find($id);
            $em->remove($guitar);
            $em->flush();
            $resultado = "ok";
        }

        return $this->json([
            'result' => $resultado,
        ]);
    }
}
