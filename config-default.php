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

// 'true': Overwrite to grey.  (default)
// 'false': Keep system settings.
$themeRevisionConfig['overwrite default task color'] = true;


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
    'greyscale-0' => '#767680',
    'greyscale-1' => '#515057',
    'greyscale-2' => '#47464a',
    'greyscale-3' => '#424146',
    'greyscale-4' => '#353437',
    'greyscale-5' => '#211f22',
    'greyscale-6' => '#1d1c20',
    'greyscale-7' => '#101013',
    'greyscale-8' => '#090909',

    // Tasks
    // Grey
    'task-grey-bg' => '#2c2a33',
    'task-grey-bdr' => '#393646',
    'task-dark-grey-bg' => '#26242c',
    'task-dark-grey-bdr' => '#322d3a',
    // Red
    'task-pink-bg' => '#ff949a',
    'task-pink-bdr' => '#eb858a',
    'task-red-bg' => '#6a0000',
    'task-red-bdr' => '#811010',
    // Orange
    'task-orange-bg' => '#ff9b2a',
    'task-orange-bdr' => '#ee8711',
    'task-deep-orange-bg' => '#ff8b3c',
    'task-deep-orange-bdr' => '#f77733',
    // Yellow
    'task-yellow-bg' => '#ffb91b',
    'task-yellow-bdr' => '#eaa50b',
    'task-amber-bg' => '#683300',
    'task-amber-bdr' => '#733e0c',
    'task-brown-bg' => '#513d2d',
    'task-brown-bdr' => '#5e4633',
    // Lime
    'task-lime-bg' => '#c3d738',
    'task-lime-bdr' => '#b5c830',
    // Green
    'task-light-green-bg' => '#98ec85',
    'task-light-green-bdr' => '#8ad778',
    'task-green-bg' => '#054208',
    'task-green-bdr' => '#054e09',
    // Cyan
    'task-cyan-bg' => '#5edbcf',
    'task-cyan-bdr' => '#54ccc1',
    'task-teal-bg' => '#0dd2a6',
    'task-teal-bdr' => '#0ec19a',
    // Blue
    'task-blue-bg' => '#183086',
    'task-blue-bdr' => '#1b379b',
    // Purple
    'task-purple-bg' => '#501d73',
    'task-purple-bdr' => '#5e2386'
);
