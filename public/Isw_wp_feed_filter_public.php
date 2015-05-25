<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Isw_wp_feed_filter_public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function pre_get_feed( $query ) 
	{


		

		if ( !is_admin() )
		{
 			if ( $query->is_feed ) 
 			{
 			   	// post id to exclude in array
 			   	global $wpdb;
 				$prefix = $wpdb->prefix;
 			 
 			   $sql ='SELECT  post_id '; 			  
 			   $sql .='FROM ' . $prefix . 'postmeta ';
 			   $sql .='WHERE meta_key = \'isw_post_ex_feed\'';
 			   $sql .='AND meta_value = \'1\' ';

 			   $myrows = $wpdb->get_results( $sql , ARRAY_A);

 			   foreach ($myrows as $key => $row) 
 			   {
 			     $post_id[] = $row[ 'post_id' ];
 			   }




 			   // cat id to exclude
  				$cat_id = array();
 			   	$all_cat = array( 2, 3 );
 			    foreach ( $all_cat as $cat) 
 			    {
 			    	if ( get_option( "exclude_category_" . $cat ) )
 			    		$cat_id[] = $cat;
 			    }
 			  
 			     // exclude posts from query
 			   if ( count( $post_id ) > 0 )
 			   		$query->set( 'post__not_in' , $post_id );
 			   	if( count( $cat_id ) > 0 )
   					$query->set('category__not_in', $cat_id );
 
 			   // $query->set('cat', '-2');

 			}
 		}	

 		return $query;   

	}






}
