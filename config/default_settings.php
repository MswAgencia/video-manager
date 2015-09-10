<?php
use Cake\Core\Configure;

return [
    'WebImobApp.Plugins.VideoManager.Settings' => [
        'General' => ['display_panel_menu' => true],
        'Template' => [
            'layout' => Configure::read('WebImobApp.Plugins.ControlPanel.Settings.Template.layout'),
            'theme' => Configure::read('WebImobApp.Plugins.ControlPanel.Settings.Template.theme')
        ],
    ]
];
