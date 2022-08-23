<?php

namespace Kanboard\Plugin\ThemeRevision\Model;
use Kanboard\Model\ColorModel;

class CustomColorModel extends ColorModel
{
    protected $default_colors = array(
        'yellow' => array(
            'name' => 'Yellow',
            'background' => 'var(--color-task-yellow-bg)',
            'border' => 'var(--color-task-yellow-bdr)',
        ),
        'blue' => array(
            'name' => 'Blue',
            'background' => 'var(--color-task-blue-bg)',
            'border' => 'var(--color-task-blue-bdr)',
        ),
        'green' => array(
            'name' => 'Green',
            'background' => 'var(--color-task-green-bg)',
            'border' => 'var(--color-task-green-bdr)',
        ),
        'purple' => array(
            'name' => 'Purple',
            'background' => 'var(--color-task-purple-bg)',
            'border' => 'var(--color-task-purple-bdr)',
        ),
        'red' => array(
            'name' => 'Red',
            'background' => 'var(--color-task-red-bg)',
            'border' => 'var(--color-task-red-bdr)',
        ),
        'orange' => array(
            'name' => 'Orange',
            'background' => 'var(--color-task-orange-bg)',
            'border' => 'var(--color-task-orange-bdr)',
        ),
        'grey' => array(
            'name' => 'Grey',
            'background' => 'var(--color-task-grey-bg)',
            'border' => 'var(--color-task-grey-bdr)',
        ),
        'brown' => array(
            'name' => 'Brown',
            'background' => 'var(--color-task-brown-bg)',
            'border' => 'var(--color-task-brown-bdr)',
        ),
        'deep_orange' => array(
            'name' => 'Deep Orange',
            'background' => 'var(--color-task-deep-orange-bg)',
            'border' => 'var(--color-task-deep-orange-bdr)',
        ),
        'dark_grey' => array(
            'name' => 'Dark Grey',
            'background' => 'var(--color-task-dark-grey-bg)',
            'border' => 'var(--color-task-dark-grey-bdr)',
        ),
        'pink' => array(
            'name' => 'Pink',
            'background' => 'var(--color-task-pink-bg)',
            'border' => 'var(--color-task-pink-bdr)',
        ),
        'teal' => array(
            'name' => 'Teal',
            'background' => 'var(--color-task-teal-bg)',
            'border' => 'var(--color-task-teal-bdr)',
        ),
        'cyan' => array(
            'name' => 'Cyan',
            'background' => 'var(--color-task-cyan-bg)',
            'border' => 'var(--color-task-cyan-bdr)',
        ),
        'lime' => array(
            'name' => 'Lime',
            'background' => 'var(--color-task-lime-bg)',
            'border' => 'var(--color-task-lime-bdr)',
        ),
        'light_green' => array(
            'name' => 'Light Green',
            'background' => 'var(--color-task-light-green-bg)',
            'border' => 'var(--color-task-light-green-bdr)',
        ),
        'amber' => array(
            'name' => 'Amber',
            'background' => 'var(--color-task-amber-bg)',
            'border' => 'var(--color-task-amber-bdr)',
        ),
    );
    private $paletteColor;

    public function __construct($c, $paletteColor) {
        parent::__construct($c);

        $this->paletteColor = $paletteColor;
    }

    public function getDefaultColor()
    {
        return $this->configModel->get('default_color', 'grey');
    }

    public function getCss()
    {
        $buffer = '';
        if (isset($GLOBALS['themeRevisionConfig'])){
            $buffer .= ':root{';
            foreach ($GLOBALS['themeRevisionConfig'][$this->paletteColor.' palette'] as $cssName => $cssValue) {
                $buffer .= "--color-".$cssName.":".$cssValue.";";
            }
            $buffer .= "}";
        }
        $buffer .= parent::getCss();
        
        return $buffer;
    }
}

