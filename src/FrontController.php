<?php

namespace DailyMoon;

use DailyMoon\Repositories\BackgroundColorOptionRepository;
use DailyMoon\Repositories\ImageModelOptionRepository;
use DailyMoon\Repositories\MoonPhaseRepository;
use Throwable;
use Twig\Environment;

class FrontController {

    /** @var Environment */
    private $twig;

    /** @var MoonPhaseRepository */
    private $moonPhaseRepository;

    /** @var BackgroundColorOptionRepository */
    private $backgroundColorOptionRepository;

    /** @var ImageModelOptionRepository */
    private $imageModelOptionRepository;

    public function __construct(
        Environment $twig,
        MoonPhaseRepository $moonPhaseRepository,
        BackgroundColorOptionRepository $backgroundColorOptionRepository,
        ImageModelOptionRepository $imageModelOptionRepository
    ) {
        $this->twig = $twig;
        $this->moonPhaseRepository = $moonPhaseRepository;
        $this->backgroundColorOptionRepository = $backgroundColorOptionRepository;
        $this->imageModelOptionRepository = $imageModelOptionRepository;
    }

    public function render()
    {
        $bgColor = $this->backgroundColorOptionRepository->find();
        $imageModelOption = $this->imageModelOptionRepository->find();

        try {
            $moonPhase = $this->moonPhaseRepository->find($bgColor, $imageModelOption);
        } catch (Throwable $throwable) {
            error_log($throwable->getMessage());
            echo $this->twig->render('error.twig');

            return;
        }

        echo $this->twig->render('index.twig', [
            'moonphase' => $moonPhase
        ]);        
    }
}
