<?php
/*******************************************************************/
/* Rename this file to config.php if you want to change the values */
/* Make sure the "Asset" folder is writable and executable !!!     */
/*******************************************************************/

// 'production':    Load a minified CSS file. (default)
// 'development':   Load all CSS files in the "Asset/dev" folder.
$themeRevisionConfig['mode'] = 'production';

// 'user':  Switch the color scheme by the users' choices. (default)
// 'dark':  Always show the dark scheme.
// 'light': Always show the light scheme.
$themeRevisionConfig['color scheme'] = 'user';

// 'true': Overwrite to grey.  (default)
// 'false': Keep system settings.
$themeRevisionConfig['overwrite default task color'] = true;

// Light Colors
// *-prim (primary):      button background, link, high-lighted border, selected item's background, alert text ...
// *-secd (secondary):    hovered text or icon in a button, high-lighted background, prompts or hints ...
// *-cont (contrast):     default text or icon in a button, alert background ...
// grayscales-*:          0 (min) for foreground, 8 (max) for background, the brightnesses of other colors increase or decrease gradiently
// task-*-bg:             task background
// task-*-bdr:            task border
$themeRevisionConfig['light palette'] = array(
    // Messages & Actions
    'brand-prim' => '#3860f4',
    'brand-secd' => '#e2eafe',
    'brand-cont' => '#fff',

    'info-prim' => '#3860f4',
    'info-secd' => '#a8baff',
    'info-cont' => '#e2eafe',

    'reminder-prim' => '#c57f00',
    'reminder-secd' => '#f7c400',
    'reminder-cont' => '#ffe778',

    'warning-prim' => '#e55a5a',
    'warning-secd' => '#FF706D',
    'warning-cont' => '#ffbebe',

    'success-prim' => '#468847',
    'success-secd' => '#4ae371',
    'success-cont' => '#bdf4cb',

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
    // high brightness                    // medium brightness                      // low brightness
    // Grey
    'task-grey-bg' => '#fff',             'task-dark-grey-bg' => '#e8ecf1',
    'task-grey-bdr' => '#dce0e7',         'task-dark-grey-bdr' => '#c9ccd2',
    // Red
    'task-pink-bg' => '#ffb3cc',          'task-red-bg' => '#ffbdbd',
    'task-pink-bdr' => '#f96b9f',         'task-red-bdr' => '#ff7676',
    // Orange
    'task-orange-bg' => '#ffd3ab',        'task-deep-orange-bg' => '#fdbca8',
    'task-orange-bdr' => '#ffac62',       'task-deep-orange-bdr' => '#ff8762',
    // Yellow
    'task-yellow-bg' => '#ffe778',        'task-amber-bg' => '#ffd868',             'task-brown-bg' => '#d9d2d0',
    'task-yellow-bdr' => '#f7c400',       'task-amber-bdr' => '#feb310',            'task-brown-bdr' => '#b79f9a',
    // Lime
    'task-lime-bg' => '#e6ee9c',
    'task-lime-bdr' => '#afb42b',
    // Green
    'task-light-green-bg' => '#dcedc8',   'task-green-bg' => '#bdf4cb',
    'task-light-green-bdr' => '#689f38',  'task-green-bdr' => '#4ae371',
    // Cyan
    'task-cyan-bg' => '#b7f2fa',          'task-teal-bg' => '#aaece5',
    'task-cyan-bdr' => '#4ed5e7',         'task-teal-bdr' => '#6bb7ad',
    // Blue
    'task-blue-bg' => '#dae4ff',
    'task-blue-bdr' => '#97acff',
    // Purple
    'task-purple-bg' => '#eacbff',
    'task-purple-bdr' => '#d9a1ff'
);

// Dark Colors
// *-prim (primary):      primary button, link, high-lighted border, selected item's background, alert text ...
// *-secd (secondary):    hovered text or icon in a button, high-lighted background, prompts or hints ...
// *-cont (contrast):     default text or icon in a button, alert background ...
// grayscales-*:          0 (min) for foreground, 8 (max) for background, the brightnesses of other colors increase or decrease gradiently
// task-*-bg:             task background
// task-*-bdr:            task border
$themeRevisionConfig['dark palette'] = array(
    // Messages & Actions
    'brand-prim' => '#1448ff',
    'brand-secd' => '#051440',
    'brand-cont' => '#102979',

    'info-prim' => '#1448ff',
    'info-secd' => '#051440',
    'info-cont' => '#102979',

    'reminder-prim' => '#ffe891',
    'reminder-secd' => '#540',
    'reminder-cont' => '#9f7b00',

    'warning-prim' => '#e13d3d',
    'warning-secd' => '#900',
    'warning-cont' => '#822828',

    'success-prim' => '#529b53',
    'success-secd' => '#063e14',
    'success-cont' => '#0a6421',

    // Greyscales
    'greyscale-0' => '#9b9b9b',
    'greyscale-1' => '#838383',
    'greyscale-2' => '#646464',
    'greyscale-3' => '#4f4f4f',
    'greyscale-4' => '#404040',
    'greyscale-5' => '#313131',
    'greyscale-6' => '#121315',
    'greyscale-7' => '#1a1a1a',
    'greyscale-8' => '#1f1f1f',

    // Tasks
    // high brightness                    // medium brightness                      // low brightness
    // Grey
    'task-grey-bg' => '#2e2e2f',          'task-dark-grey-bg' => '#000',
    'task-grey-bdr' => '#404040',         'task-dark-grey-bdr' => '#202020',
    // Red
    'task-pink-bg' => '#995d5e',          'task-red-bg' => '#861212',
    'task-pink-bdr' => '#713737',         'task-red-bdr' => '#ac1a1a',
    // Orange
    'task-orange-bg' => '#9f5d22',        'task-deep-orange-bg' => '#793711',
    'task-orange-bdr' => '#883e00',       'task-deep-orange-bdr' => '#551f00',
    // Yellow
    'task-yellow-bg' => '#846100',        'task-amber-bg' => '#7b2101',             'task-brown-bg' => '#644f37',
    'task-yellow-bdr' => '#423500',       'task-amber-bdr' => '#531100',            'task-brown-bdr' => '#402d17',
    // Lime
    'task-lime-bg' => '#728224',
    'task-lime-bdr' => '#536400',
    // Green
    'task-light-green-bg' => '#5e972d',   'task-green-bg' => '#136c18',
    'task-light-green-bdr' => '#347100',  'task-green-bdr' => '#094d0d',
    // Cyan
    'task-cyan-bg' => '#298678',          'task-teal-bg' => '#236853',
    'task-cyan-bdr' => '#00534c',         'task-teal-bdr' => '#094835',
    // Blue
    'task-blue-bg' => '#3754a2',
    'task-blue-bdr' => '#062e97',
    // Purple
    'task-purple-bg' => '#652f8a',
    'task-purple-bdr' => '#40006c'
);
