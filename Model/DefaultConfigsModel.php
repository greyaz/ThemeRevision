<?php

namespace Kanboard\Plugin\ThemeRevision\Model;

class DefaultConfigsModel
{
    private $default_Configs_Schema = array(
        'version'                           => array('default' => '20230306v1'),

        // Development mode will introduce raw CSS files for easier customization and minify automatically after switching back. 
        // Make sure the "Asset" folder in plugin's root directory is WRITABLE and EXECUTABLE before switching !
        // 'production':    Load a minified CSS file. (default)
        // 'development':   Load all CSS files in the "Asset/dev" folder.
        'mode'                              => array('default' => 'production', 'candidates' => array('production', 'development')),

        // 'user':  Switch the color scheme by the users' choices. (default)
        // 'light': Always show the light scheme.
        // 'dark':  Always show the dark scheme.
        'color_scheme'                      => array('default' => 'user',       'candidates' => array('user', 'light', 'dark')),
        
        // Overwrite the default task color for better UI consistency. The option in project settings will be invalidated
        // 'true':  Overwrite to grey.  (default)
        // 'false': Keep system settings.
        'overwrite_default_task_color'      => array('default' => true,         'candidates' => array(true, false)),

        // 'true':  Replace Font Awesome with Google Material. (default)
        // 'false': Keep Font Awesome icons.
        'enable_google_material_icons'      => array('default' => true,         'candidates' => array(true, false)),

        // Override default fonts with "Google Fonts". Only one font family name supported by Google can be filled in for each category. Note: the font family name of a font may differ from it's general name.
        // If this feature is not working, please check the CSP settings on your server first. 
        // The default value for each category is empty.
        // 'ui':    A font name for Most parts of the system UI. Example: Noto Sans
        // 'codes': A font name for all code blocks, and statistics in the overview page. Monospaced fonts are recommended. Example: Noto Sans Mono
        'google_fonts' => array(
            'ui'                            => array('default' => ''),
            'codes'                         => array('default' => ''),
        ),

        // Display the statistics of a column if they exist. Hide all by default.
        'column_header_info' => array(
            'score'                         => array('default' => false,         'candidates' => array(true, false)),
            'column_description'            => array('default' => false,         'candidates' => array(true, false)),
            'tasks_number'                  => array('default' => false,         'candidates' => array(true, false)),
            'more_statistics'               => array('default' => false,         'candidates' => array(true, false)),
        ),
        
        // Display the information of a task if it exists. Show all by default.
        'board_task_info' => array(
            'category'                      => array('default' => true,         'candidates' => array(true, false)),
            'tags'                          => array('default' => true,         'candidates' => array(true, false)),
            'reference'                     => array('default' => true,         'candidates' => array(true, false)),
            'milestone'                     => array('default' => true,         'candidates' => array(true, false)),
            'score'                         => array('default' => true,         'candidates' => array(true, false)),
            'time_estimated'                => array('default' => true,         'candidates' => array(true, false)),
            'due_date'                      => array('default' => true,         'candidates' => array(true, false)),
            'recurrence_status'             => array('default' => true,         'candidates' => array(true, false)),
            'links_number'                  => array('default' => true,         'candidates' => array(true, false)),
            'subtasks_number'               => array('default' => true,         'candidates' => array(true, false)),
            'files_number'                  => array('default' => true,         'candidates' => array(true, false)),
            'comments_number'               => array('default' => true,         'candidates' => array(true, false)),
            'description'                   => array('default' => true,         'candidates' => array(true, false)),
            'task_age'                      => array('default' => true,         'candidates' => array(true, false)),
            'priority'                      => array('default' => true,         'candidates' => array(true, false)),
            'metaMagik'                     => array('default' => true,         'candidates' => array(true, false)),
            'metaMagik_metadata'            => array('default' => true,         'candidates' => array(true, false)),
        ),

        // The opacity of the above information.
        'task_footer_opacity' => array('default' => 0.08),

        // The corner radius for all elements.
        'corner_radius' => array('default' => '4px'),
        
        // Color Palettes
        // *-prim (primary):      button background, link, selected, alert foreground, helps or hints ...
        // *-secd (secondary):    hovered button foreground, linked comment ...
        // *-cont (contrast):     button foreground, alert background ...
        // grayscales-*:          colors for common UI elements, 1 (min) for foreground / text, 6 (max) for background
        // task-*-bg:             task background
        // task-*-bdr:            task border
        // code-*:                code syntax highlight
        // shadow-*:              shadow

        // Light Colors
        'light_palette' => array(
            // Messages & Actions
            'brand-prim'                    => array('default' => '#3860f4'),
            'brand-cont'                    => array('default' => '#fff'),
            'brand-secd'                    => array('default' => '#dae4fe'),

            'info-prim'                     => array('default' => '#3860f4'),
            'info-cont'                     => array('default' => '#d9e7ff'),

            'reminder-prim'                 => array('default' => '#be7b04'),
            'reminder-cont'                 => array('default' => '#ffed9d'),

            'warning-prim'                  => array('default' => '#d9371c'),
            'warning-cont'                  => array('default' => '#ffd9d9'),
            'warning-secd'                  => array('default' => '#e79392'),

            'success-prim'                  => array('default' => '#428b43'),
            'success-cont'                  => array('default' => '#c4f7c5'),

            // Greyscales
            'greyscale-1'                   => array('default' => '#02021d'),
            'greyscale-2'                   => array('default' => 'rgba(5, 12, 77, .15)'),
            'greyscale-3'                   => array('default' => '#e4e9f0'),
            'greyscale-4'                   => array('default' => '#f0f3f7'),
            'greyscale-5'                   => array('default' => '#f7f9fc'),
            'greyscale-6'                   => array('default' => '#fff'),

            // Tasks
            // Grey
            'task-grey-bg'                  => array('default' => '#fff'),             
            'task-grey-bdr'                 => array('default' => '#dce0e7'),         
            'task-dark-grey-bg'             => array('default' => '#e7eaef'),
            'task-dark-grey-bdr'            => array('default' => '#cfd2d9'),
            // Red
            'task-pink-bg'                  => array('default' => '#ffb3cc'),          
            'task-pink-bdr'                 => array('default' => '#f99dbe'),         
            'task-red-bg'                   => array('default' => '#ffbdbd'),
            'task-red-bdr'                  => array('default' => '#ffa7a7'),
            // Orange
            'task-orange-bg'                => array('default' => '#ffd3ab'),        
            'task-orange-bdr'               => array('default' => '#ffbc80'),       
            'task-deep-orange-bg'           => array('default' => '#fdbca8'),
            'task-deep-orange-bdr'          => array('default' => '#fda489'),
            // Yellow
            'task-yellow-bg'                => array('default' => '#ffe778'),                     
            'task-yellow-bdr'               => array('default' => '#f7d349'),                   
            'task-amber-bg'                 => array('default' => '#fdce63'),
            'task-amber-bdr'                => array('default' => '#edb942'),
            'task-brown-bg'                 => array('default' => '#d9d2d0'),
            'task-brown-bdr'                => array('default' => '#d1bbb7'),
            // Lime
            'task-lime-bg'                  => array('default' => '#e6ee9c'),
            'task-lime-bdr'                 => array('default' => '#d5db3e'),
            // Green
            'task-light-green-bg'           => array('default' => '#dcedc8'),   
            'task-light-green-bdr'          => array('default' => '#acdb82'),  
            'task-green-bg'                 => array('default' => '#bdf4cb'),
            'task-green-bdr'                => array('default' => '#87eda1'),
            // Cyan
            'task-cyan-bg'                  => array('default' => '#b7faf7'),          
            'task-cyan-bdr'                 => array('default' => '#9ae7e4'),         
            'task-teal-bg'                  => array('default' => '#aaecdd'),
            'task-teal-bdr'                 => array('default' => '#87dbc7'),
            // Blue
            'task-blue-bg'                  => array('default' => '#dae4ff'),
            'task-blue-bdr'                 => array('default' => '#c3ccf1'),
            // Purple
            'task-purple-bg'                => array('default' => '#eacbff'),
            'task-purple-bdr'               => array('default' => '#dfb1ff'),

            // Code Highlight
            'code-a'                        => array('default' => '#c56200'),
            'code-b'                        => array('default' => '#d92792'),
            'code-c'                        => array('default' => '#cc5e91'),
            'code-d'                        => array('default' => '#3787c7'),
            'code-e'                        => array('default' => '#0d7d6c'),
            'code-f'                        => array('default' => '#7641bb'),

            // shadow
            'shadow-lit'                    => array('default' => 'rgba(0, 0, 0, .04)'),
            'shadow-hev'                    => array('default' => 'rgba(0, 0, 0, .08)')
        ),
        'dark_palette' => array(
            // Messages & Actions
            'brand-prim'                    => array('default' => '#3860f4'),
            'brand-cont'                    => array('default' => '#e7f0ff'),
            'brand-secd'                    => array('default' => '#051646'),

            'info-prim'                     => array('default' => '#3860f4'),
            'info-cont'                     => array('default' => '#d4d7ff'),

            'reminder-prim'                 => array('default' => '#a46a01'),
            'reminder-cont'                 => array('default' => '#ffe4be'),

            'warning-prim'                  => array('default' => '#b62500'),
            'warning-cont'                  => array('default' => '#fbd0d6'),
            'warning-secd'                  => array('default' => '#450909'),

            'success-prim'                  => array('default' => '#09590d'),
            'success-cont'                  => array('default' => '#82c483'),

            // Greyscales
            'greyscale-1'                   => array('default' => '#ccc'),
            'greyscale-2'                   => array('default' => 'rgba(255, 255, 255, .15)'),
            'greyscale-3'                   => array('default' => 'rgba(255, 255, 255, .043)'),
            'greyscale-4'                   => array('default' => '#27262c'),
            'greyscale-5'                   => array('default' => '#2b292f'),
            'greyscale-6'                   => array('default' => '#302e35'),

            // Tasks
            // Grey
            'task-grey-bg'                  => array('default' => '#302e35'),
            'task-grey-bdr'                 => array('default' => 'rgba(255, 255, 255, .043)'),
            'task-dark-grey-bg'             => array('default' => '#29272d'),
            'task-dark-grey-bdr'            => array('default' => 'rgba(255, 255, 255, .07)'),
            // Red
            'task-pink-bg'                  => array('default' => '#995457'),
            'task-pink-bdr'                 => array('default' => '#ac6064'),
            'task-red-bg'                   => array('default' => '#7b1900'),
            'task-red-bdr'                  => array('default' => '#931d1d'),
            // Orange
            'task-orange-bg'                => array('default' => '#995900'),
            'task-orange-bdr'               => array('default' => '#ae6a1c'),
            'task-deep-orange-bg'           => array('default' => '#9b4500'),
            'task-deep-orange-bdr'          => array('default' => '#b5521d'),
            // Yellow
            'task-yellow-bg'                => array('default' => '#a46a01'),
            'task-yellow-bdr'               => array('default' => '#bd7d08'),
            'task-amber-bg'                 => array('default' => '#683800'),
            'task-amber-bdr'                => array('default' => '#7d430c'),
            'task-brown-bg'                 => array('default' => '#513d2d'),
            'task-brown-bdr'                => array('default' => '#5e4633'),
            // Lime
            'task-lime-bg'                  => array('default' => '#687320'),
            'task-lime-bdr'                 => array('default' => '#7b8820'),
            // Green
            'task-light-green-bg'           => array('default' => '#528248'),
            'task-light-green-bdr'          => array('default' => '#57934a'),
            'task-green-bg'                 => array('default' => '#054208'),
            'task-green-bdr'                => array('default' => '#054e09'),
            // Cyan
            'task-cyan-bg'                  => array('default' => '#007c80'),
            'task-cyan-bdr'                 => array('default' => '#3a8e87'),
            'task-teal-bg'                  => array('default' => '#007360'),
            'task-teal-bdr'                 => array('default' => '#0c886d'),
            // Blue
            'task-blue-bg'                  => array('default' => '#183086'),
            'task-blue-bdr'                 => array('default' => '#1b379b'),
            // Purple
            'task-purple-bg'                => array('default' => '#501d73'),
            'task-purple-bdr'               => array('default' => '#5e2386'),

            // Code Highlight
            'code-a'                        => array('default' => '#c56200'),
            'code-b'                        => array('default' => '#d92792'),
            'code-c'                        => array('default' => '#cc5e91'),
            'code-d'                        => array('default' => '#3787c7'),
            'code-e'                        => array('default' => '#0d7d6c'),
            'code-f'                        => array('default' => '#7641bb'),

            // shadow
            'shadow-lit'                    => array('default' => 'rgba(0, 0, 0, .25)'),
            'shadow-hev'                    => array('default' => 'rgba(0, 0, 0, .4)')
        )
    );

    public function checkDiffColor($paletteName, $oldConfigs){
        $diffs = array();

        if (isset($oldConfigs[$paletteName])){
            foreach ($this->default_Configs_Schema[$paletteName] as $key => $raw){
                if (!isset($oldConfigs[$paletteName][$key])){
                    $diffs[$key] = array(
                        'old' => '',
                        'new' => $this->getConfig($raw)
                    );
                }
                else if ($this->getConfig($raw) != $oldConfigs[$paletteName][$key]){
                    $diffs[$key] = array(
                        'old' => $oldConfigs[$paletteName][$key],
                        'new' => $this->getConfig($raw)
                    );
                }
            }
        }
        
        return $diffs;
    }

    public function getDefaultConfigs(){
        $configs = array();

        foreach ($this->default_Configs_Schema as $key => $raw){
            if (is_array($raw) && isset($raw['default'])){
                $configs[$key] = $raw['default'];
            }
            else if(is_array($raw)){
                $configs[$key] = array();

                foreach($raw as $subKey => $subRaw){
                    if (is_array($subRaw) && isset($subRaw['default'])){
                        $configs[$key][$subKey] = $subRaw['default'];
                    }
                }
            }
        }
        return $configs;
    }

    public function getVersion(){
        return $this->getConfig($this->default_Configs_Schema['version']);
    }

    public function getCandidates($key){
        return $this->default_Configs_Schema[$key]["candidates"];
    }

    private function getConfig($raw){
        return $raw['default'];
    }
}
