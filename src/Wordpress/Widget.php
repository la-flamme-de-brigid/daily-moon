<?php

namespace DailyMoon\Wordpress;

use DailyMoon\Renderer;

class Widget extends \WP_Widget
{
    /** @var Renderer */
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;

        parent::__construct(
            'daily-moon',
            'Daily moon'
        );
    }

    public function widget($args, $instance)
    {
        $this->renderer->render();
    }
}
