<?php
declare(strict_types=1);

namespace DailyMoon;

use DailyMoon\Entities\BackgroundColorOption;
use DailyMoon\Entities\ImageModelOption;
use DailyMoon\Repositories\BackgroundColorOptionRepository;
use DailyMoon\Repositories\ImageModelOptionRepository;
use Twig\Environment;

class AdminController
{
    /** @var Environment */
    private $twig;

    /** @var BackgroundColorOptionRepository */
    private $backgroundColorOptionRepository;

    /** @var ImageModelOptionRepository */
    private $imageModelOptionRepository;

    public function __construct(
        Environment $twig,
        BackgroundColorOptionRepository $backgroundColorOptionRepository,
        ImageModelOptionRepository $imageModelOptionRepository
    ) {
        $this->twig = $twig;
        $this->backgroundColorOptionRepository = $backgroundColorOptionRepository;
        $this->imageModelOptionRepository = $imageModelOptionRepository;
    }

    public function render(): string
    {
        return $this->twig->render('widget-form.twig', [
            'bgColorInitialValue' => $this->backgroundColorOptionRepository->find(),
            'imageModelsAvailable' => ImageModelOption::AVAILABLE_IMAGE_MODEL,
            'imageModelInitialValue' => $this->imageModelOptionRepository->find()->toInt()
        ]);
    }

    public function update(array $data)
    {
        $this->backgroundColorOptionRepository->store(new BackgroundColorOption($data['bg-color']));
    }
}
