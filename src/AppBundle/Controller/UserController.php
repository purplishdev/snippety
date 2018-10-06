<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\ProfileType;
use AppBundle\Form\UserType;
use AppBundle\Repository\SnippetRepositoryInterface;
use AppBundle\Repository\UserRepositoryInterface;
use AppBundle\Service\AvatarUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller {

    private $userRepository;
    private $snippetRepository;

    public function __construct(UserRepositoryInterface $userRepository, SnippetRepositoryInterface $snippetRepository) {
        $this->userRepository = $userRepository;
        $this->snippetRepository = $snippetRepository;
    }

    /**
     * @Route("/login", name="login")
     *
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils) {
        $error = $authUtils->getLastAuthenticationError();

        return $this->render('default/login.html.twig', array(
            'error' => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction() {
    }

    /**
     * @Route("/register", name="register")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword(
                $user, $user->getPlainPassword()
            );
            $user->setPassword($password);

            $this->userRepository->save($user);

            $this->addFlash("success", "You have been registered successfully. Now you can login.");
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param string $username
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileViewAction($username) {

        $user = $this->userRepository->findOneByUsername($username);

        if ($user === null) {
            throw new NotFoundHttpException("Page not found.");
        }

        $snippets = $user->getSnippets();

        return $this->render('default/profile.html.twig', array(
            'user' => $user,
            'snippets' => $snippets
        ));
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @param Request $request
     * @param AvatarUploader $avatar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileEditAction(Request $request, AvatarUploader $avatar) {

        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get("avatar")->getData();
            $avatar->upload($file);

            if ($avatar->isUploaded()) {
                $fileName = $avatar->getFileName();
                $user->setAvatar($fileName);
            }

            $this->userRepository->save($user);

            return $this->redirectToRoute('user_profile', array(
                'username' => $user->getUsername()
            ));
        }

        return $this->render('user/profile-edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }
}