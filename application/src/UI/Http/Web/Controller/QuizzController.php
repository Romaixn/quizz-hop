<?php

declare(strict_types=1);

namespace UI\Http\Web\Controller;

use App\Quizz\Domain\Quizz;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class QuizzController extends AbstractRenderController
{
    /**
     * @Route(
     *     "/quizz",
     *     name="quizz_index",
     *     methods={"GET"}
     * )
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        return $this->render('quizz/index.html.twig', [
            'quizzes' => []
        ]);
    }

    /**
     * @Route(
     *      "/quizz/add",
     *      name="quizz_add",
     *      methods={"GET"}
     * )
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function add(): Response
    {
        return $this->render('quizz/new.html.twig');
    }
}
