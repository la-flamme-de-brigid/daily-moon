<?php

namespace DailyMoon\Wordpress;

use DailyMoon\AdminController;
use DailyMoon\FrontController;

class Widget extends \WP_Widget
{
    /** @var FrontController */
    private $frontController;

    /** @var AdminController */
    private $adminController;

    public function __construct(
        FrontController $frontController,
        AdminController $adminController
    ) {
        $this->frontController = $frontController;
        $this->adminController = $adminController;

        parent::__construct(
            'daily-moon',
            'Daily moon'
        );
    }

    public function widget($args, $instance)
    {
        $this->frontController->render();
    }

    public function form($instance) {
        echo $this->adminController->render();
    }
}
