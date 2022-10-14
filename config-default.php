<?php
/****************************************************************************/
/* DO NOT REMOVE THIS FILE !!!                                              */
/* Copy and Rename this file to config.php if you want to change the values */
/****************************************************************************/

// Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. 
// Make sure the "Asset" folder in plugin's root directory is WRITABLE and EXECUTABLE before switching !
// 'production':    Load a minified CSS file. (default)
// 'development':   Load all CSS files in the "Asset/dev" folder.
$themeRevisionConfig['mode'] = 'production';

// 'user':  Switch the color scheme by the users' choices. (default)
// 'light': Always show the light scheme.
// 'dark':  Always show the dark scheme.
$themeRevisionConfig['color scheme'] = 'user';

// Overwrite the default task color for better UI consistency. The option in project settings will be invalidated
// 'true':  Overwrite to grey.  (default)
// 'false': Keep system settings.
$themeRevisionConfig['overwrite default task color'] = true;

// 'true':  Replace Font Awesome with Google Material. (default)
// 'false': Keep Font Awesome icons.
$themeRevisionConfig['enable google material icons'] = true;

// Override default fonts with "Google Fonts". Only one font family name supported by Google can be filled in for each category. Note: the font family name of a font may differ from it's general name.
// If this feature is not working, please check the CSP settings on your server first. 
// The default value for each category is empty.
// 'ui':    A font name for Most parts of the system UI. Example: Noto Sans
// 'codes': A font name for all code blocks, and statistics in the overview page. Monospaced fonts are recommended. Example: Noto Sans Mono
$themeRevisionConfig['google fonts'] = array(
    'ui' => '',
    'codes' => ''
);

// *-prim (primary):      button background, link, selected, alert foreground, helps or hints ...
// *-secd (secondary):    hovered button foreground, linked comment ...
// *-cont (contrast):     button foreground, alert background ...
// grayscales-*:          colors for common UI elements, 1 (min) for foreground / text, 6 (max) for background
// task-*-bg:             task background
// task-*-bdr:            task border
// code-*:                code syntax highlight
// shadow-*:              shadow

// Light Colors
$themeRevisionConfig['light palette'] = array(
    // Messages & Actions
    'brand-prim' => '#3860f4',
    'brand-cont' => '#fff',
    'brand-secd' => '#dae4fe',

    'info-prim' => '#5574e3',
    'info-cont' => '#e3ebff',

    'reminder-prim' => '#be7b04',
    'reminder-cont' => '#ffed9d',

    'warning-prim' => '#cf5555',
    'warning-cont' => '#fdd4d4',
    'warning-secd' => '#e79392',

    'success-prim' => '#428b43',
    'success-cont' => '#c4f7c5',

    // Greyscales
    'greyscale-1' => '#02021d',
    'greyscale-2' => '#bec3d0',
    'greyscale-3' => '#e4e9f0',
    'greyscale-4' => '#f0f3f7',
    'greyscale-5' => '#f7f9fc',
    'greyscale-6' => '#fff',

    // Tasks
    // Grey
    'task-grey-bg' => '#fff',             
    'task-grey-bdr' => '#dce0e7',         
    'task-dark-grey-bg' => '#e7eaef',
    'task-dark-grey-bdr' => '#cfd2d9',
    // Red
    'task-pink-bg' => '#ffb3cc',          
    'task-pink-bdr' => '#f99dbe',         
    'task-red-bg' => '#ffbdbd',
    'task-red-bdr' => '#ffa7a7',
    // Orange
    'task-orange-bg' => '#ffd3ab',        
    'task-orange-bdr' => '#ffbc80',       
    'task-deep-orange-bg' => '#fdbca8',
    'task-deep-orange-bdr' => '#fda489',
    // Yellow
    'task-yellow-bg' => '#ffe778',                     
    'task-yellow-bdr' => '#f7d349',                   
    'task-amber-bg' => '#fdce63',
    'task-amber-bdr' => '#edb942',
    'task-brown-bg' => '#d9d2d0',
    'task-brown-bdr' => '#d1bbb7',
    // Lime
    'task-lime-bg' => '#e6ee9c',
    'task-lime-bdr' => '#d5db3e',
    // Green
    'task-light-green-bg' => '#dcedc8',   
    'task-light-green-bdr' => '#acdb82',  
    'task-green-bg' => '#bdf4cb',
    'task-green-bdr' => '#87eda1',
    // Cyan
    'task-cyan-bg' => '#b7faf7',          
    'task-cyan-bdr' => '#9ae7e4',         
    'task-teal-bg' => '#aaecdd',
    'task-teal-bdr' => '#87dbc7',
    // Blue
    'task-blue-bg' => '#dae4ff',
    'task-blue-bdr' => '#c3ccf1',
    // Purple
    'task-purple-bg' => '#eacbff',
    'task-purple-bdr' => '#dfb1ff',

    // Code Highlight
    'code-a' => '#c56200',
    'code-b' => '#d92792',
    'code-c' => '#cc5e91',
    'code-d' => '#3787c7',
    'code-e' => '#0d7d6c',
    'code-f' => '#7641bb',

    // shadow
    'shadow-lit' => 'rgba(0, 0, 0, .04)',
    'shadow-hev' => 'rgba(0, 0, 0, .08)'
);

$themeRevisionConfig['dark palette'] = array(
    // Messages & Actions
    'brand-prim' => '#3860f4',
    'brand-cont' => '#183086',
    'brand-secd' => '#051646',

    'info-prim' => '#7894ff',
    'info-cont' => '#183086',

    'reminder-prim' => '#ffeb9e',
    'reminder-cont' => '#a67100',

    'warning-prim' => '#e33e3e',
    'warning-cont' => '#7b1900',
    'warning-secd' => '#450909',

    'success-prim' => '#55a256',
    'success-cont' => '#054208',

    // Greyscales
    'greyscale-1' => '#b9b8b8',
    'greyscale-2' => '#4c4b53',
    'greyscale-3' => '#2a2a32',
    'greyscale-4' => '#19171e',
    'greyscale-5' => '#1e1c24',
    'greyscale-6' => '#25232b',

    // Tasks
    // Grey
    'task-grey-bg' => '#25232b',
    'task-grey-bdr' => '#312e35',
    'task-dark-grey-bg' => '#18161e',
    'task-dark-grey-bdr' => '#2b2835',
    // Red
    'task-pink-bg' => '#995457',
    'task-pink-bdr' => '#ac6064',
    'task-red-bg' => '#7b1900',
    'task-red-bdr' => '#931d1d',
    // Orange
    'task-orange-bg' => '#995900',
    'task-orange-bdr' => '#ae6a1c',
    'task-deep-orange-bg' => '#9b4500',
    'task-deep-orange-bdr' => '#b5521d',
    // Yellow
    'task-yellow-bg' => '#a67100',
    'task-yellow-bdr' => '#bf8300',
    'task-amber-bg' => '#683800',
    'task-amber-bdr' => '#7d430c',
    'task-brown-bg' => '#513d2d',
    'task-brown-bdr' => '#5e4633',
    // Lime
    'task-lime-bg' => '#687320',
    'task-lime-bdr' => '#7b8820',
    // Green
    'task-light-green-bg' => '#528248',
    'task-light-green-bdr' => '#57934a',
    'task-green-bg' => '#054208',
    'task-green-bdr' => '#054e09',
    // Cyan
    'task-cyan-bg' => '#007c80',
    'task-cyan-bdr' => '#3a8e87',
    'task-teal-bg' => '#007360',
    'task-teal-bdr' => '#0c886d',
    // Blue
    'task-blue-bg' => '#183086',
    'task-blue-bdr' => '#1b379b',
    // Purple
    'task-purple-bg' => '#501d73',
    'task-purple-bdr' => '#5e2386',

    // Code Highlight
    'code-a' => '#c56200',
    'code-b' => '#d92792',
    'code-c' => '#cc5e91',
    'code-d' => '#3787c7',
    'code-e' => '#0d7d6c',
    'code-f' => '#7641bb',

    // shadow
    'shadow-lit' => 'rgba(0, 0, 0, .15)',
    'shadow-hev' => 'rgba(0, 0, 0, .28)'
);
