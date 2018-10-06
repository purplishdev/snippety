<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Snippet;
use AppBundle\Entity\User;
use AppBundle\Form\SnippetType;
use AppBundle\Repository\SnippetRepositoryInterface;
use AppBundle\Repository\UserRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SnippetController extends Controller {

    private $userRepository;
    private $snippetRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                SnippetRepositoryInterface $snippetRepository) {
        $this->userRepository = $userRepository;
        $this->snippetRepository = $snippetRepository;
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function snippetCreateAction(Request $request) {

        $user = $this->getUser();

        $snippet = new Snippet();
        $snippet->setAuthor($user);

        $form = $this->createForm(SnippetType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->snippetRepository->save($snippet);

            return $this->redirectToRoute('user_profile', array(
                'username' => $user->getUsername()
            ));
        }

        return $this->render('user/snippet-edit.html.twig', array(
            'user' => $user,
            'snippet' => $snippet,
            'form' => $form->createView()
        ));
    }

    /**
     * @param string $username
     * @param string $snippet
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function snippetViewAction($username, $snippet, Request $request) {

        $user = $this->userRepository->findOneByUsername($username);
        $snippet = $this->snippetRepository->getUserSnippetByTitle($user, $snippet);

        if ($user === null || $snippet === null) {
            throw new NotFoundHttpException("Page not found.");
        }

        return $this->render('user/snippet-code.html.twig', array(
            'user' => $user,
            'snippet' => $snippet
        ));
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @param string $username
     * @param string $snippet
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function snippetEditAction($username, $snippet, Request $request) {

        $user = $this->userRepository->findOneByUsername($username);
        $snippet = $this->snippetRepository->getUserSnippetByTitle($user, $snippet);

        $this->denyAccessUnlessGranted('edit', $snippet);

        $form = $this->createForm(SnippetType::class, $snippet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->snippetRepository->save($snippet);

            return $this->redirectToRoute('user_snippet', array(
                'username' => $username,
                'snippet' => $snippet->getTitle(),
            ));
        }

        return $this->render('user/snippet-edit.html.twig', array(
            'user' => $user,
            'snippet' => $snippet,
            'form' => $form->createView()
        ));
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @param string $username
     * @param string $snippet
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function snippetDeleteAction($username, $snippet, Request $request) {

        $user = $this->userRepository->findOneByUsername($username);
        $snippet = $this->snippetRepository->getUserSnippetByTitle($user, $snippet);

        $this->denyAccessUnlessGranted('delete', $snippet);

        $this->snippetRepository->delete($snippet);

        return $this->redirectToRoute('user_profile', array(
            'username' => $username
        ));
    }
}