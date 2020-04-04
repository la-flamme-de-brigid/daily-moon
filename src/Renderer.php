<?php

namespace DailyMoon;

use Twig\Environment;

class Renderer {

    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render()
    {
        echo $this->twig->render('index.twig');        
    }
}
