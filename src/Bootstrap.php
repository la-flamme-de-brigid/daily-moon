<?php
namespace DailyMoon;

class Bootstrap
{
    /** @var Widget */
    private $widget;

    public function __construct(Widget $widget)
    {
        $this->widget = $widget;
    }

    public function __invoke()
    {
        add_action('widgets_init', function() {
            register_widget($this->widget);
        });
    }
}
