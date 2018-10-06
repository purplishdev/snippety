<?php

namespace AppBundle\Controller;

use AppBundle\Repository\SnippetRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    private $snippetRepository;

    public function __construct(SnippetRepositoryInterface $snippetRepository) {
        $this->snippetRepository = $snippetRepository;
    }

    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {

        $limit = 5;

        $snippets = $this->snippetRepository->getLatestSnippets($limit);

        return $this->render('default/index.html.twig', array(
            'snippets' => $snippets,
            'limit' => $limit
        ));
    }
}