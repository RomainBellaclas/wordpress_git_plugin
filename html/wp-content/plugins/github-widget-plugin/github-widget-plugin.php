<?php 

/**
 * @package GithubWidgetPlugin
 */

 /*
  Plugin Name: Github Widget Plugin
  Plugin URI:  https://github.com/RomainBellaclas/wordpress_git_plugin
  Description: Création d'un plugin affichant les derniers commits d'un dépôt Github, dans un Widget.
  Version: 1.0.0
  Author: Romain Bellaclas
  License: GLPv2 or later
  Text Domain: github-widget-plugin
*/

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

add_action( 'widget_init', 'githubCommits_init');

function githubCommits_init() {
    register_widget( "widgetGithubCommits" );
}

class widgetGithubCommits extends WP_Widget {

    // Constructeur du widgets
    function widgetGithubCommits()
    {
        parent::WP_Widget('AAF', $name = "Github repository's Commits", array('description' => 'Affichage des derniers commits de votre dépot GitHub associé.'));
    }
    
    //  Mise en forme
    function widget($args,$instance)
    {
        // HTML AVNT WIDGET
        echo $before_widget;

        // HTML APRES WIDGET
        echo $after_widget;        
    }
    
    // Récupération des paramètres
    function update($new_instance, $old_instance)
    {
    
    }
    
    // Paramètres dans l’administration
    function form($instance)
    {
    
    }
    
    // Fin du widget
    }

?>