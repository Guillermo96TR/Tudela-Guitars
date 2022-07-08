<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {

        $result='ok';
        return $this->json([
            'result' => $result
        ]);
        // return $this->render('user/index.html.twig', [
        //     'users' => $userRepository->findAll(),
        // ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"POST"})
     */
    public function new(Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $data = $request->toArray();

        $resultado = "ko";
        if (isset($data["username"])) {
            $user = new User();
            $user->setUsername($data["username"]);
            $hasherpassword = $userPasswordHasher -> hashPassword(
                $user,$data ["password"]
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
        $resultado=[];

        $userInfo= $userRepository->find($id);
        
        if(!empty($userInfo->getId()))
        {
            $resultado[]=[
                'id'=>$userInfo->getId(),
                'username'=>$userInfo->getUserIdentifier()
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
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
