<?php

namespace DailyMoon;

use DailyMoon\Repositories\BackgroundColorOptionRepository;
use DailyMoon\Repositories\MoonPhaseRepository;
use Exception;
use Twig\Environment;

class FrontController {

    /** @var Environment */
    private $twig;

    /** @var MoonPhaseRepository */
    private $moonPhaseRepository;

    /** @var BackgroundColorOptionRepository */
    private $backgroundColorOptionRepository;

    public function __construct(
        Environment $twig,
        MoonPhaseRepository $moonPhaseRepository,
        BackgroundColorOptionRepository $backgroundColorOptionRepository
    ) {
        $this->twig = $twig;
        $this->moonPhaseRepository = $moonPhaseRepository;
        $this->backgroundColorOptionRepository = $backgroundColorOptionRepository;
    }

    public function render()
    {
        $bgColor = $this->backgroundColorOptionRepository->find();

        try {
            $moonPhase = $this->moonPhaseRepository->find($bgColor);
        } catch (Exception $exception) {
            error_log($exception->getMessage());
            echo $this->twig->render('error.twig');

            return;
        }

        echo $this->twig->render('index.twig', [
            'moonphase' => $moonPhase
        ]);        
    }
}
