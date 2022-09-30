<?php
/*******************************************************************/
/* Rename this file to config.php if you want to change the values */
/* Make sure the "Asset" folder is writable and executable !!!     */
/*******************************************************************/

// 'production':    Load a minified CSS file. (default)
// 'development':   Load all CSS files in the "Asset/dev" folder.
$themeRevisionConfig['mode'] = 'production';

// 'user':  Switch the color scheme by the users' choices. (default)
// 'light': Always show the light scheme.
// 'dark':  Always show the dark scheme.
$themeRevisionConfig['color scheme'] = 'user';

// 'true':  Overwrite to grey.  (default)
// 'false': Keep system settings.
$themeRevisionConfig['overwrite default task color'] = true;

// 'true':  Replace Font Awesome with Google Material. (default)
// 'false': Keep Font Awesome icons.
$themeRevisionConfig['enable google material icons'] = true;

// Override default fonts with "Google Fonts". Only one font name supported by Google can be filled in for each category.
// The default value for each category is empty.
// 'ui': A font for Most parts of the system UI.
// 'codes': A font for all code blocks, and statistics in the overview page. Monospaced fonts are recommended.
$themeRevisionConfig['google fonts'] = array(
    'ui' => '',
    'codes' => ''
);

// *-prim (primary):      button background, link, selected, alert foreground, helps or hints ...
// *-secd (secondary):    hovered button foreground, linked comment ...
// *-cont (contrast):     button foreground, alert background ...
// grayscales-*:          colors for common UI elements, 0 (min) for foreground / text, 8 (max) for background
// task-*-bg:             task background
// task-*-bdr:            task border

// Light Colors
$themeRevisionConfig['light palette'] = array(
    // Messages & Actions
    'brand-prim' => '#3860f4',
    'brand-secd' => '#dae4fe',
    'brand-cont' => '#fff',

    'info-prim' => '#5574e3',
    'info-secd' => '#a8baff',
    'info-cont' => '#e3ebff',

    'reminder-prim' => '#be7b04',
    'reminder-secd' => '#f7c400',
    'reminder-cont' => '#ffed9d',

    'warning-prim' => '#cf5555',
    'warning-secd' => '#e79392',
    'warning-cont' => '#fdd4d4',

    'success-prim' => '#428b43',
    'success-secd' => '#4ae371',
    'success-cont' => '#c4f7c5',

    // Greyscales
    'greyscale-0' => '#02021d',
    'greyscale-1' => '#727983',
    'greyscale-2' => '#9ea1a7',
    'greyscale-3' => '#bfc4cb',
    'greyscale-4' => '#cbd0d9',
    'greyscale-5' => '#e4e9f0',
    'greyscale-6' => '#f0f3f7',
    'greyscale-7' => '#f7f9fc',
    'greyscale-8' => '#fff',

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
    'task-purple-bdr' => '#dfb1ff'
);

$themeRevisionConfig['dark palette'] = array(
    // Messages & Actions
    'brand-prim' => '#3860f4',
    'brand-secd' => '#051646',
    'brand-cont' => '#102979',

    'info-prim' => '#5478ff',
    'info-secd' => '#051646',
    'info-cont' => '#193084',

    'reminder-prim' => '#edc52e',
    'reminder-secd' => '#540',
    'reminder-cont' => '#a17908',

    'warning-prim' => '#ce3d3d',
    'warning-secd' => '#450909',
    'warning-cont' => '#6a1616',

    'success-prim' => '#55a256',
    'success-secd' => '#063e14',
    'success-cont' => '#115121',

    // Greyscales
    'greyscale-0' => '#a6a6b5',
    'greyscale-1' => '#515057',
    'greyscale-2' => '#47464a',
    'greyscale-3' => '#424146',
    'greyscale-4' => '#3c3b3e',
    'greyscale-5' => '#211f22',
    'greyscale-6' => '#17161a',
    'greyscale-7' => '#101013',
    'greyscale-8' => '#020202',

    // Tasks
    // Grey
    'task-grey-bg' => '#28262f',
    'task-grey-bdr' => '#393646',
    'task-dark-grey-bg' => '#020202',
    'task-dark-grey-bdr' => '#1c1c1c',
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
    'task-yellow-bg' => '#885d00',
    'task-yellow-bdr' => '#9f7109',
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
    'task-purple-bdr' => '#5e2386'
);
