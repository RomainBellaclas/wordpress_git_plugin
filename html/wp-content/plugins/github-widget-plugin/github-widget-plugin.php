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

add_action( 'widgets_init', 'githubCommits_init');

function githubCommits_init() {
    register_widget( "widgetGithubCommits" );
}



class widgetGithubCommits extends WP_Widget {

    // Constructeur du widgets
    function __construct()
    {
        parent::__construct('AAF', $name = "Github repository's Commits", array('description' => 'Affichage des derniers commits de votre dépot GitHub associé.'));   
    }
    
    //  Mise en forme
    function widget($args,$instance)
    {
        $user = $instance['username'];
		$password = $instance['password'];
		
		if(!empty($password)){
		
			$headers = array(
				"Authorization: Basic " . base64_encode( $user . ":" . $password)
			);
			
		}
		
		$url = "https://api.github.com/users/" . $user . "/repos";
		
		// set URL and other appropriate options
		$ch = curl_init();
		$vers = curl_version();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'curl/' . $vers['version'] );
		
		if(!empty($password)){
		
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
		}
		
		// grab URL and pass it to the browser
		$data = curl_exec($ch);
		
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
        $json = json_decode($data);

        // HTML AVANT WIDGET
        echo $before_widget;
        
        // Titre du widget qui va s’afficher
        echo $before_title.'github account'.$after_title;
        
        /*extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $nb_posts = $instance['nb_posts'];
        
        //Récupération des articles
        $lastposts = get_posts(array('numberposts'=>$nb_posts)); 
        
        // HTML AVANT WIDGET
        echo $before_widget;
        
        // Titre du widget qui va s’afficher
        echo $before_title.$title.$after_title;
        
        // Boucle pour afficher les articles
        echo '<ul>';
        foreach ( $lastposts as $post ) : setup_postdata($post); ?>
        <li><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
        <?php endforeach;
        echo '</ul>';
        
        // HTML APRES WIDGET
        echo $after_widget; */      
    }
    
    // Récupération des paramètres
    function update($new_instance, $old_instance)
    {
        /*$instance = $old_instance;

        //Récupération des paramètres envoyés
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['nb_posts'] = $new_instance['nb_posts'];
        
        return $instance;*/     
    }
    
    // Paramètres dans l’administration
    function form($instance)
    {
		
		if(!isset($instance["username"])){
			$instance["username"] = "";
		}
		
		if(!isset($instance["password"])){
			$instance["password"] = "";
		}
		
		echo '<div id="githubwordpress-widget-form">';
		echo '<p><label for="' . $this->get_field_id("username") .'">' . '<b>GitHub Username/Email</b>' . ' :</label><br/>';
		echo '<input type="text" name="' . $this->get_field_name("username") . '" ';
		echo 'id="' . $this->get_field_id("username") . '" value="' . $instance["username"] . '" /></p>';
		echo '<p><label for="' . $this->get_field_id("username") .'">' . "<b>GitHub Password</b>" . ' :</label><br/>';
		echo '<input type="password" name="' . $this->get_field_name("password") . '" ';
		echo 'id="' . $this->get_field_id("password") . '" value="' . $instance["password"] . '" /></p>';
		echo "<p>" . "Ne pas fournir la mot de passe peut entrainer des dépassements de temps de l'API." . "</p>";
		echo '<p><label for="' . $this->get_field_id("hidden") . '">' . "La liste des dépôts est cachée par défaut" . ':</label><br/>';
		echo '<select id="' . $this->get_field_id("hidden") . '" name="' . $this->get_field_name("hidden") . '">';
		if ($instance['hidden'] == "0") {
			echo '<option value="0" selected="selected">' . "no" . '</option>';
			echo '<option value="1">' . "yes" . '</option>';
		} else {
			echo '<option value="0">' . "no" . '</option>';
			echo '<option value="1" selected="selected">' . "yes" . '</option>';
		}
		echo '</select>';
		echo '</div>';
        // Etape 1 - Définition des variables titre et nombre de post
        /*
        $title = esc_attr($instance['title']);
        $nb_posts = esc_attr($instance['nb_posts']);
        */
        
        // Etape 2 - Ajout des deux champs
        
        /*
        ?>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php echo 'Titre:'; ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('nb_posts'); ?>">
        <?php echo 'Nombre d\'articles:'; ?>
        <input class="widefat" id="<?php echo $this->get_field_id('nb_posts'); ?>" name="<?php echo $this->get_field_name('nb_posts'); ?>" type="text" value="<?php echo $nb_posts; ?>" />
        </label>
        </p>
        

        <?php 
        */  
    }
    
    // Fin du widget
    }


    ?>

