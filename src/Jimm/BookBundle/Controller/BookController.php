<?php

namespace Jimm\BookBundle\Controller;

use Jimm\BookBundle\Entity\Book;
use Jimm\BookBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * Show all books
     * @Route(
     *     "/",
     *     name="books_show_list",
     *  )
     */
    public function indexAction()
    {
        $em    = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAll();

        return $this->render(
            '@JimmBook/book/show_list.html.twig',
            [
                'books' => $books,
            ]
        );
    }

    /**
     * Add new book
     * @Route(
     *     "/new",
     *     name="books_new"
     * )
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book)
                ->add('Добавить', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', ' Книга добавлена ');

            return $this->redirectToRoute('books_show_list');
        }

        return $this->render('@JimmBook/book/new.html.twig', [
            'book' => $book,
            'form_book' => $form->createView(),
        ]);
    }

}
