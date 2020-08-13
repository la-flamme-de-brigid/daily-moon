<?php

namespace DailyMoon\Wordpress;

use DailyMoon\FrontController;

class Widget extends \WP_Widget
{
    /** @var FrontController */
    private $renderer;

    public function __construct(FrontController $renderer)
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

    public function form($instance) {
        echo 'etste';
    }
}
