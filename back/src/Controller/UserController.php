<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\BassGuitarRepository;
use App\Repository\GuitarsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        $resultado = [];
        foreach ($users as $c) {
            $resultado[] = [
                'id' => $c->getId(),
                'avatar' => $c->getAvatar(),
                'rol' => $c->getRoles(),
                'username' => $c->getUserIdentifier(),

            ];
        }
        return $this->json(['result' => $resultado]);
    }

    /**
     * @Route("/get", name="app_user_get", methods={"GET", "POST"})
     */
    public function token(UserRepository $userRepository, EntityManagerInterface $em, Request $request, GuitarsRepository $guitarsRepository, BassGuitarRepository $bassGuitarRepository): Response
    {
        

        // $resultado = [];
        // $listaGuitars = [];
        // $listaBassGuitars = [];


        // $guitars = $guitarsRepository->findBy(['user' => $users->getId()]);
        // $bassguitars = $bassGuitarRepository->findBy(['user' => $users->getId()]);
        // if (!empty($publicaciones)) {
        //     foreach ($guitars as $guitar) {
        //         $listaGuitars[] = [
        //             "titulo" => $guitar->getNombre(),
        //             "imagen" => 'http://localhost:8080/uploads/' . $guitar->getImagen(),
        //             "id" => $guitar->getId()
        //         ];
        //     }
        //     foreach ($bassguitars as $bassguitar) {
        //         $listaBassGuitars[] = [
        //             "titulo" => $bassguitar->getNombre(),
        //             "imagen" => 'http://localhost:8080/uploads/' . $bassguitar->getImagen(),
        //             "id" => $bassguitar->getId()
        //         ];
        //     }
        // }

        // // Si el perfil del usuario (Avatar) no está vacío, seguimos.
        // if (!empty($users->getAvatar())) {
        //     $imagenPerfil = 'http://localhost:8080/uploads/' . $users->getAvatar();
        // } else {
        //     $imagenPerfil = '';
        // }

        // Obtenemos toda la información del usuario, incluidas sus publicaciones.
        // $resultado = [
        //     'id' => $users->getId(),
        //     // 'perfil' => $imagenPerfil,
        //     'role' => $users->getRoles(),
        //     'username' => $users->getUserIdentifier(),
        //     'guitars' => $listaGuitars,
        //     'bassguitars' => $listaBassGuitars,
        //     'avatar' => $imagenPerfil
        // ];
        return $this->json([
            'result' => $this->getUser()

        ]);
    }
    /**
     * @Route("/new", name="app_user_new", methods={"POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $data = $request->toArray();

        $resultado = "ko";
        if (isset($data["username"])) {
            $user = new User();
            $user->setUsername($data["username"]);
            $hasherpassword = $userPasswordHasher->hashPassword(
                $user,
                $data["password"]
            );

            $user->setPassword($hasherpassword);

            $em->persist($user);
            $em->flush();

            if (!empty($user->getId())) {
                $resultado = "ok";
            }
        }

        return $this->json([
            'resultado' => $resultado
        ]);
    }


    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user, UserRepository $userRepository, $id): Response
    {
        $resultado = [];

        $userInfo = $userRepository->find($id);

        if (!empty($userInfo->getId())) {
            $resultado[] = [
                'id' => $userInfo->getId(),
                'username' => $userInfo->getUserIdentifier()
            ];
        }

        return $this->json([
            'resultado' => $resultado
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
