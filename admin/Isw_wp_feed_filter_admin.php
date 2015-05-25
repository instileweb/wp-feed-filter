<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Isw_wp_feed_filter_admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	//	wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * 
	 *
	 * @since    1.0.0
	 */
	public function add_feed_meta_box() 
	{

		$types = array( 'post' );

		foreach( $types as $type )
		{
				//campi aggiuntivi homebox
			add_meta_box( 
				'isw-wp-feed-filter', // id attribute
				 __('Feed filter', 'isw-wp-feed-filter'), // Metabox title
				array( $this, 'feed_post_check_box' ), // callback function who generate html
				$type,  // post type
				'side' // sidebar
			 );
		}		

	}


	/**
	 * 
	 *
	 * @since    1.0.0
	 */
	public function feed_post_check_box( $post ) 
	{
		

		$escluso_da_feed = esc_html( get_post_meta( $post->ID, 'isw_post_ex_feed', true ) );
		
	    $checked = '';
	    if ( $escluso_da_feed == '1' )
	    {
	        $checked = 'checked=checked';
	    }	
		   
	    ?>
	        <tr style="width: 100%">
	            <td><input type="checkbox" size="30" name="isw-post-ex-feed" value="1" <?php echo $checked; ?> /></td>
	            <?php _e( 'Exclude from feed', 'isw-wp-feed-filter' ) ?>
	        </tr>       
		<?php
	
	}


	/**
	 * 
	 *
	 * @since    1.0.0
	 */
	public function feed_post_save_check_box( $id ) 
	{

		   			
       		if ( isset( $_POST['isw-post-ex-feed'] ) && $_POST['isw-post-ex-feed'] != '' ) 
       		{       			
       		    update_post_meta( $id, 'isw_post_ex_feed', $_POST['isw-post-ex-feed'] );
       		}  
       		else
        		update_post_meta( $id, 'isw_post_ex_feed', '' );    


	
	}


	public function category_check_box( $tag ) {
	 	
	    $exclude_category = get_option( "exclude_category_" . $tag->term_id );
	    
	    $checked = '';
	    if ( $exclude_category == '1' )
	    {
	    	 $checked = 'checked=checked';
	    }

	    ?>
	    <tr class="form-field">
	        <th scope="row" valign="top"><label for="category-title"><?php _e( "Feed filter " ); ?></label></th>
	        <td>
	            <input type="checkbox" size="30" id="exclude-category" name="exclude-category" value="1" <?php echo $checked; ?>/>
	            <span class="description"><?php _e('Exclude category from feeds'); ?></span>
	        </td>
	    </tr>
	    <!-- rinse & repeat for other fields you need -->
	    <?php
	}


	public function feed_category_save_check_box( $term_id )
	{
	    $key = 'exclude_category_' . $term_id;
	 	

	    if ( isset( $_POST['exclude-category'] ) )	        
	        update_option( $key, $_POST['exclude-category']);	        
	     else
	     	update_option( $key, '0' );
	 
	}
 




}



 
 










