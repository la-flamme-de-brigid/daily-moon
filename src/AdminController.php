<?php
declare(strict_types=1);

namespace DailyMoon;

use Twig\Environment;

class AdminController
{
    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(): string
    {
        return $this->twig->render('widget-form.twig');
    }
}
