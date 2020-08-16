<?php
declare(strict_types=1);

namespace DailyMoon;

use DailyMoon\Entities\BackgroundColorOption;
use DailyMoon\Entities\LanguageOption;
use DailyMoon\Repositories\BackgroundColorOptionRepository;
use DailyMoon\Repositories\LanguageOptionRepository;
use Twig\Environment;

class AdminController
{
    /** @var Environment */
    private $twig;

    /** @var BackgroundColorOptionRepository */
    private $backgroundColorOptionRepository;
    /**
     * @var LanguageOptionRepository
     */
    private $languageOptionRepository;

    public function __construct(
        Environment $twig,
        BackgroundColorOptionRepository $backgroundColorOptionRepository,
        LanguageOptionRepository $languageOptionRepository
    ) {
        $this->twig = $twig;
        $this->backgroundColorOptionRepository = $backgroundColorOptionRepository;
        $this->languageOptionRepository = $languageOptionRepository;
    }

    public function render(): string
    {
        return $this->twig->render('widget-form.twig', [
            'bgColor' => $this->backgroundColorOptionRepository->find(),
            'language' => $this->languageOptionRepository->find()
        ]);
    }

    public function update(array $data)
    {
        $this->backgroundColorOptionRepository->store(new BackgroundColorOption($data['bg-color']));
        $this->languageOptionRepository->store(new LanguageOption($data['language']));
    }
}
