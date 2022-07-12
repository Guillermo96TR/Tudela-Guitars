<?php

namespace App\Controller\Api;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\BassGuitarRepository;
use App\Repository\GuitarsRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_usuario_index", methods={"GET"})
     */
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        //Funcion para sacar todos los usuarios.
        // Solo accesible por el administrador .
        // Buscamos en el repositorio todos lo susuarios y obtenemos la 
        // Información.


        $usuarios = $usuarioRepository->findAll();
        $resultado = [];
        foreach ($usuarios as $c) {
            $resultado[] = [
                'id' => $c->getId(),
                'nombre' => $c->getNombre(),
                'perfil' => $c->getPerfil(),
                'rol' => $c->getRoles(),
                'email' => $c->getEmail(),

            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/new", name="app_ usuario_new", methods={"GET", "POST"})
     */
    public function new(Request $request,  EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Función para crear nuevo usuario.
        
        // Declaramos las variables donde se guardará la información.

        $resultado = "ko";
        $passwordRequest = $request->request->get("password");
        $usuarioName = $request->request->get("username");
        $usuarioNombre = $request->request->get("nombre");
        $imagen = $request->files->get('perfil');
        
        // Sí el username no está vacío, seguimos.
        if(!empty($usuarioName)){
            $nombreImagen = '';
            if (!empty($imagen)) {
                if (!empty($imagen->getClientOriginalName())) {
                    $nombreImagen = uniqid() . '_' . strtolower(trim(preg_replace('/[^A-Za-z.]+/', '-', $imagen->getClientOriginalName())));
                    $imagen->move('uploads/', $nombreImagen);
                }
            }

            //Creamos el usuario con la información obtenida del formulario.

            $usuario = new Usuario();
            
            //Aquí estamos hasheando la contraseña para que se guarde así en la BD.

            $hashedPassword = $passwordHasher->hashPassword(
                $usuario,
                $passwordRequest
            );
            
            $usuario->setNombre($usuarioNombre);
            $usuario->setEmail($usuarioName);
            $usuario->setPerfil($nombreImagen);
            $usuario->setPassword($hashedPassword);

            $em->persist($usuario);
            $em->flush();
        }
        return $this->json([
            'resultado' => $resultado
        ]);
    }
    /**
     * @Route("/editar/{id}", methods={"POST"})
     */
    public function token1(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, Request $request, UsuarioRepository $usuarioRepository, $id): Response
    {
        //Función para editar usuario.

        //Obtenemos la información actual del usuario.

        $resultado = "ko";
        $passwordRequest = $request->request->get("password");
        $usuarioName = $request->request->get("username");
        $usuarioNombre = $request->request->get("nombre");
        $imagen = $request->files->get('perfil');

        // Sí no está vacío el campo Username(Email), seguimos.

        if (!empty($usuarioName)) {
            $nombreImagen = '';
            if (!empty($imagen)) {
                if (!empty($imagen->getClientOriginalName())) {
                    $nombreImagen = uniqid() . '_' . strtolower(trim(preg_replace('/[^A-Za-z.]+/', '-', $imagen->getClientOriginalName())));
                    $imagen->move('uploads/', $nombreImagen);
                }
            }
            //Obtenemos usuario por ID.
            $usuario = $usuarioRepository->find($id);
            $hashedPassword = $passwordHasher->hashPassword(
                $usuario,
                $passwordRequest
            );

            //Le añadimos la nueva información al usuario.

            $usuario->setNombre($usuarioNombre);
            $usuario->setEmail($usuarioName);
            $usuario->setPerfil($nombreImagen);
            $usuario->setPassword($hashedPassword);

            $em->persist($usuario);
            $em->flush();
        }
        return $this->json([
            'resultado' => $resultado
        ]);
    }


    /**
     * @Route("/get", methods={"GET", "POST"})
     */
    public function token(
        GuitarsRepository $guitarsRepository,
        BassGuitarRepository $bassGuitarRepository
    ): Response {
        //Función para obtener token del usuario actual e información del usuario.


        // Obtenemos el usuario actual.

        /** @var User $user */
        $user = $this->getUser();
        $resultado = [];
        $listaGuitars = [];
        $listabassGuitars= [];

        //Obtenemos sus publicaciones 

        $guitars = $guitarsRepository->findBy(['usuarios' => $user->getId()]);
        if (!empty($guitars)) {
            foreach ($guitars as $guitar) {
                $listaGuitars[] = [
                    "nombre" => $guitar->getNombre(),
                    "imagen" => 'http://localhost:8080/uploads/' . $guitar->getImagen(),
                    "id" => $guitar->getId()
                ];
            }
        }
        $bassguitars = $bassGuitarRepository->findBy(['usuario' => $user->getId()]);
        if (!empty($bassguitars)) {
            foreach ($bassguitars as $bass) {
                $listabassGuitars[] = [
                    "nombre" => $bass->getNombre(),
                    "imagen" => 'http://localhost:8080/uploads/' . $bass->getImagen(),
                    "id" => $bass->getId()
                ];
            }
        }

        // Si el perfil del usuario (Avatar) no está vacío, seguimos.
        if (!empty($user->getPerfil())) {
            $imagenPerfil = 'http://localhost:8080/uploads/' . $user->getPerfil();
        } else {
            $imagenPerfil = '';
        }

        // Obtenemos toda la información del usuario, incluidas sus publicaciones.
        $resultado = [
            'id' => $user->getId(),
            'nombre' => $user->getNombre(),
            'perfil' => $imagenPerfil,
            'role' => $user->getRoles(),
            'email' => $user->getEmail(),
            'guitars' => $listaGuitars,
            'bassguitars' => $listabassGuitars
        ];
        return $this->json([
            'result' => $resultado
        ]);
    }


    /**
     * @Route("/{id}", name="app_admin_usuario_delete", methods={"POST"})
     */
    public function delete(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usuario->getId(), $request->request->get('_token'))) {
            $usuarioRepository->remove($usuario, true);
        }

        return $this->redirectToRoute('app_admin_usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
