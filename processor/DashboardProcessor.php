<?php
use KLib\Base\BaseProcessor;

/**
 *
 * @author mazzo
 *        
 */
class DashboardProcessor extends BaseProcessor
{

    public function __construct()
    {
        parent::__construct(TestBuilder::getInstance());
    }

    /**
     *
     * @hook wp_dashboard_setup
     */
    public function users_processor()
    {
        wp_add_dashboard_widget('widget_id', 'Article de la semaine', 
            [$this, 'users']
        );
    }
    
    public function users() 
    {
        $current_year = date("Y");
        $week = date("W");
        
        $authors = get_users([
            'fields' => [
                'ID',
                'display_name'
            ],
            'orderby' => 'display_name'
        ]);
        
       
        
        foreach ($authors as $author) {
            
            if (in_array(intval($author->ID), [46, 28, 343, 344])) {
                
                $countposts = count(get_posts("year=$current_year&w=$week&author=$author->ID&posts_per_page=-1"));
                
                echo '<p>' . $author->display_name . ' [<span style="color:green">' . $countposts . ']</span></p>';
            }
        }
    }
    
    
}