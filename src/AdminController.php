<?php
declare(strict_types=1);

namespace DailyMoon;

use DailyMoon\Repositories\BackgroundColorOptionRepository;
use Twig\Environment;

class AdminController
{
    /** @var Environment */
    private $twig;

    /** @var BackgroundColorOptionRepository */
    private $backgroundColorOptionRepository;

    public function __construct(
        Environment $twig,
        BackgroundColorOptionRepository $backgroundColorOptionRepository
    ) {
        $this->twig = $twig;
        $this->backgroundColorOptionRepository = $backgroundColorOptionRepository;
    }

    public function render(): string
    {
        return $this->twig->render('widget-form.twig', [
            'bgColor' => $this->backgroundColorOptionRepository->find()
        ]);
    }

    public function update(array $data)
    {
        $this->backgroundColorOptionRepository->store($data['bg-color']);
    }
}
