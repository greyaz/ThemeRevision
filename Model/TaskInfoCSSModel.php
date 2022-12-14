<?php

namespace Kanboard\Plugin\ThemeRevision\Model;

class TaskInfoCSSModel
{
    public static function getSelectorMap(){
        $commentStr = explode('-1', t('%d comment', -1));
        $commentStr = strlen($commentStr[0]) >= strlen($commentStr[1]) ? $commentStr[0] : $commentStr[1];
        $commentsStr = explode('-1', t('%d comments', -1));
        $commentsStr = strlen($commentsStr[0]) >= strlen($commentsStr[1]) ? $commentsStr[0] : $commentsStr[1];
        return array(
            'column_header_info' => array(
                'score'              => '.board-column-expanded-header>.pull-right>span[title]',
                'column_description' => '.board-column-expanded-header>.pull-right>.tooltip',
                'tasks_number'       => '.board-column-expanded-header>span.board-column-header-task-count[title="'.t('Task count').'"]',
                'more_statistics'    => '.board-column-expanded-header>span.board-column-header-task-count[title="'.t('Total number of tasks in this column across all swimlanes').'"]',
            ),
            'board_task_info' => array(
                'category'           => '.task-board-expanded .task-board-category-container',      
                'tags'               => '.task-board-expanded .task-tags',      
                'reference'          => '.task-board-expanded>.task-board-icons .task-board-reference',      
                'milestone'          => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span[title="'.t('Milestone').'"]',         
                'score'              => '.task-board-expanded>.task-board-icons .task-score',              
                'time_estimated'     => '.task-board-expanded>.task-board-icons .task-time-estimated',               
                'due_date'           => '.task-board-expanded>.task-board-icons .task-date',              
                'recurrence_status'  => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="recurrence"]',   
                'links_number'       => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="links"]',
                'subtasks_number'    => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="subtasks"]',
                'files_number'       => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="attachments"]',      
                'comments_number'    => ['.task-board-expanded>.task-board-icons>.task-board-icons-row>*[title*="'.$commentStr.'"]', '.task-board-expanded>.task-board-icons>.task-board-icons-row>*[title*="'.$commentsStr.'"]'],
                'description'        => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="description"]',
                'task_age'           => '.task-board-expanded>.task-board-icons .task-icon-age', 
                'priority'           => '.task-board-expanded>.task-board-icons .task-priority',
                'metaMagik'          => ['.task-board-expanded>.task-board-icons .metamagik-footer-title', '.task-board-expanded>.task-board-icons .metamagik-footer-value'], 
                'metaMagik_metadata' => '.task-board-expanded>.task-board-icons>.task-board-icons-row>span.tooltip[data-href*="metaMagik"]',
            ),
        );
    }

    public static function getFullCSS($columnList, $taskList){
        $return = '';
        if (!empty($columnList)){
            foreach($columnList as $name){
                $return .= self::getCSS('column_header_info', $name);
            }
        }
        if (!empty($taskList)){
            /*if (empty(array_diff(array_diff(self::getSelectorMap()['board_task_info'], $taskList), ['category', 'tags']))){
                $return .= '.task-board-expanded .task-board-icons{display:none !important}';
            }
            else{*/
                foreach($taskList as $name){
                    $return .= self::getCSS('board_task_info', $name);
                }
            //}
        }
        return $return;
    }

    public static function getCSS($area, $name){
        $contents = self::getSelectorMap()[$area][$name];
        if (gettype($contents) == "array"){
            $value = '';
            foreach($contents as $selector){
                $value .= self::toCSS($selector);
            }
            return $value;
        }
        return self::toCSS($contents);
    }

    public static function toCSS($selector){
        return $selector.'{display:none !important}';
    }
}
