<?php

namespace DailyMoon;

use DailyMoon\Repositories\MoonPhaseRepository;
use Twig\Environment;

class FrontController {

    /** @var Environment */
    private $twig;

    /** @var MoonPhaseRepository */
    private $repository;

    public function __construct(Environment $twig, MoonPhaseRepository $repository)
    {
        $this->twig = $twig;
        $this->repository = $repository;
    }

    public function render()
    {
        $moonPhase = $this->repository->find();

        echo $this->twig->render('index.twig', [
            'moonphase' => $moonPhase
        ]);        
    }
}
