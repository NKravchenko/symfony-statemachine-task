<?php

namespace Jimm\BookBundle\Controller\Api;

use Jimm\BookBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class BookApiController
 * @Route("/api")
 */
class BookApiController extends Controller
{
    /**
     * @Route("/apply-transition/{id}", name="api_book_apply_transition")
     * @ParamConverter("book", options={"mapping" :{"id" : "id"}})
     * @Method("POST")
     */
    public function applyTransitionAction(Request $request, Book $book)
    {
        try {
            $this->get('state_machine.book')
                ->apply($book, $request->request->get('transition'));
            $this->get('doctrine')->getManager()->flush();
        } catch (\LogicException $e) {
            return $this->json(['msg' => 'Ошибка сервера. Пожалуйста, попробуйте позже'], 501);
        }

        $result = $this->renderView('@JimmBook/book/marking_only.html.twig', ['item' => $book]);

        return $this->json(['html' => $result], 200);
    }

}
