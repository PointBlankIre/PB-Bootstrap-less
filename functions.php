<?php 

/// custom widget areas

if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
   'name' => __( 'Sidebar 1'),
   'id' => 'sidebar-1',
   'description' => __( 'An optional widget area', 'pb-bootstrap' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s unstyled">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
   ) );
   
}

if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
   'name' => __( 'Sidebar 2'),
   'id' => 'sidebar-2',
   'description' => __( 'Second optional widget area', 'pb-bootstrap' ),
   'before_widget' => '<aside id="%1$s" class="widget %2$s unstyled">',
   'after_widget' => "</aside>",
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3>',
  ));
  
}

// Editor Styles
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


/// Featured image Support

    if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 900, 273, true ); // default Post Thumbnail dimensions (cropped)

    // additional image sizes
    // uncomment the next lines if you need additional image sizes
    // add_image_size( 'home-thumb', 451, 300, true ); //300 pixels wide (and unlimited height)
    // add_image_size( 'home-list-thumb', 300, 9999, true ); //300 pixels wide (and unlimited height)
    }  

/// Options framework

        //require_once ( get_template_directory() . '/theme-options.php' );

        if ( !function_exists( 'optionsframework_init' ) ) {

        define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');

        require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

        };



/// Bootstrap dropdown functionality

        class BootstrapNavMenuWalker extends Walker_Nav_Menu {

           function start_lvl(&$output, $depth = 0, $args = array()) {
              $output .= "\n<ul class=\"dropdown-menu\">\n";
           }

           function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
               $item_html = '';
               parent::start_el($item_html, $item, $depth, $args);

               if ( $item->is_dropdown && $depth === 0 ) {
                   $item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
                   $item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
               }

               $output .= $item_html;
            }

            function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
                if ( $element->current )
                $element->classes[] = 'active';

                $element->is_dropdown = !empty( $children_elements[$element->ID] );

                if ( $element->is_dropdown ) {
                    if ( $depth === 0 ) {
                        $element->classes[] = 'dropdown';
                    } elseif ( $depth === 1 ) {
                        // Extra level of dropdown menu, 
                        // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
                        $element->classes[] = 'dropdown-submenu';
                    }
                }

            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
            }
        }

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ),'','',true  );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
	
	 // Register the script like this for a theme:
	 wp_register_script( 'custom-script2', get_template_directory_uri() . '/js/validator.min.js', array( 'jquery' ),'',true  );
	  // For either a plugin or a theme, you can then enqueue the script:
	  wp_enqueue_script( 'custom-script2' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );


/// Add PB logo to admin 

      function pb_url_login(){
      	return "http://www.pointblank.ie/"; // your URL here
      }
      add_filter('login_headerurl', 'pb_url_login');

      /// custom admin login logo
      function custom_login_logo() {
      	echo '<style type="text/css">
      	h1 a { background-image: url(https://s3.amazonaws.com/pointblankltd/uploads/bootstrap/pblogo.png) !important; 
      	background-size:172px 112px !important;
      	width:172px !important;
      	height:120px !important;
      	}

      	</style>';
      }
add_action('login_head', 'custom_login_logo');


/**
 * Plugin, Point Blank Recent Posts with Date & Body pbrecentpostsWidget
 * */

class pbrecentpostsWidget extends WP_Widget
{

 /**
  * Declares the Recent Posts With Date class.
  * */

    function pbrecentpostsWidget(){

    $widget_ops = array('classname' => 'widget_pbrecentposts', 'description' => __( "Recent Posts with date, image and excerpt") );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('pbrecentposts', __('Point Blank Recent Posts'), $widget_ops, $control_ops);

    }

  /**
    * Displays the Widget
    * */

    function widget($args, $instance){

      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
      $lineOne = empty($instance['lineOne']) ? 'Hello' : $instance['lineOne'];
      $lineTwo = empty($instance['lineTwo']) ? 'World' : $instance['lineTwo'];
	  $lineThree = empty($instance['lineThree']) ? 'World' : $instance['lineThree'];

      # Before the widget
      echo $before_widget;


      # The title
      if ( $title ) { 	  

	  $title = ''.$title.'';
  

      echo $before_title . $title . $after_title;

	  }

      # Make the Hello World Example widget
     // echo '<div style="text-align:center;padding:10px;">' . $lineOne . '<br />' . $lineTwo . "</div>";

global $post;

       $args = array( 'numberposts' => $lineOne, 'cat' => $lineThree );
$lastposts = get_posts( $args );

echo '<ul class="unstyled">';

foreach($lastposts as $post) : setup_postdata($post); 

	echo '<li>'; ?>

	<?php //echo $post->permalink; ?><?php //echo $post->post_title; ?>

    <h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>

       <span><?php the_time(''.$lineTwo.'') ?></span>

     <?php the_excerpt(); ?>   

	<? echo '</li>'; ?>   

<?php endforeach; 
// echo '<li class="view-all"><a href="news" title="view all">view all</a></li></ul>';

global $current_user;
      get_currentuserinfo();

      # After the widget
      echo $after_widget;

  }

  /**
    * Saves the widgets settings.
    *
    */

    function update($new_instance, $old_instance){
      $instance = $old_instance;

      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['lineOne'] = strip_tags(stripslashes($new_instance['lineOne']));
      $instance['lineTwo'] = strip_tags(stripslashes($new_instance['lineTwo']));
	   $instance['lineThree'] = strip_tags(stripslashes($new_instance['lineThree']));

    return $instance;

  }

  /**
    * Creates the edit form for the widget.
    *
    */

    function form($instance){

      //Defaults
      $instance = wp_parse_args( (array) $instance, array('title'=>'Latest News', 'lineOne'=>'15', 'lineTwo'=>'j.m.Y', 'lineThree'=>'1' ) );

      $title = htmlspecialchars($instance['title']);
      $lineOne = htmlspecialchars($instance['lineOne']);
      $lineTwo = htmlspecialchars($instance['lineTwo']);
	  $lineThree = htmlspecialchars($instance['lineThree']);

      # Output the options
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';

      # Text line 1
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('lineOne') . '">' . __('Number of Posts:') . ' <input style="width: 200px;" id="' . $this->get_field_id('lineOne') . '" name="' . $this->get_field_name('lineOne') . '" type="text" value="' . $lineOne . '" /></label></p>';

      # Text line 2
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('lineTwo') . '">' . __('Date Format:') . ' <input style="width: 200px;" id="' . $this->get_field_id('lineTwo') . '" name="' . $this->get_field_name('lineTwo') . '" type="text" value="' . $lineTwo . '" /></label></p>';
	  
	    # Text line 3
      echo '<p style="text-align:right;"><label for="' . $this->get_field_name('lineThree') . '">' . __('Category:') . ' <input style="width: 200px;" id="' . $this->get_field_id('lineThree') . '" name="' . $this->get_field_name('lineThree') . '" type="text" value="' . $lineThree . '" /></label></p>';

  }
}
// END class


/**
  * Register Hello World widget.
  *
  * Calls 'widgets_init' action after the Hello World widget has been registered.
  */

  function pbrecentpostsInit() {
  register_widget('pbrecentpostsWidget');
  }

  add_action('widgets_init', 'pbrecentpostsInit');


/**
 * Ends Plugin
 */
 
 function add_cookie_warning()
{
  
  // Register the script like this for a theme:
  wp_register_script( 'cookie-script', get_template_directory_uri() . '/js/cookiewarning.js','','',true );

  // For either a plugin or a theme, you can then enqueue the script:
  wp_enqueue_script( 'cookie-script' );
}
add_action( 'wp_enqueue_scripts', 'add_cookie_warning' );

/* ajax send mail function for contact template */

add_action( 'wp_ajax_pb_send_mail', 'pb_send_mail_callback' );
add_action( 'wp_ajax_nopriv_pb_send_mail', 'pb_send_mail_callback');

function pb_send_mail_callback() { 
   
   //if($_POST)
//{
    $to_Email       = "info@pointblank.ie"; //Replace with recipient email address
     $user_Subject     = filter_var($_POST["userSubject"], FILTER_SANITIZE_STRING);
    $subject        =  $user_Subject;
    
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    
        //exit script outputting json data
        $output = json_encode(
        array(
            'type'=>'error', 
            'text' => 'Request must come from Ajax'
        ));
        
        die($output);
    } 
    
    //check $_POST vars are set, exit if any missing
    if(!isset($_POST["userName"]) || !isset($_POST["userEmail"])  || !isset($_POST["userMessage"]))
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
        die($output);
    }

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
   // $user_Phone       = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
    $user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);

    
    //additional php validation
    if(strlen($user_Name)<4) // If length is less than 4 it will throw an HTTP error.
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
        die($output);
    }
    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
        die($output);
    }
   /* if(!is_numeric($user_Phone)) //check entered data is numbers
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Only numbers allowed in phone field'));
        die($output);
    }*/
    if(strlen($user_Message)<5) //check emtpy message
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
        die($output);
    }
    
    //proceed with PHP email.
    $headers = 'From: '.$user_Email.'' . "\r\n" .
    'Reply-To: '.$user_Email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
        // send mail
    $sentMail = @mail($to_Email, $subject, $user_Message .'  -'.$user_Name, $headers);
    
    if(!$sentMail)
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_Name .' Thank you for your email'));
        die($output);
    }
//}
} 


?>
