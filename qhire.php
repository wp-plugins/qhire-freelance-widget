<?php

/**
 * QHire
 *
 * @package QHire
 * @version 0.5.0
 * @author Narayan Prusty
 *
 *
 * Plugin Name: QHire
 * Plugin URI: http://qnimate.com/
 * Description: Freelance Contact Widget
 * Version: 1.0
 * Author: Narayan Prusty
 * Author URI: http://qnimate.com/
 * License: GPLv2
 */

	//this function enqueues widget CSS and JavaScript files on frontend.
	function qhire_scripts()
	{
		wp_enqueue_style( 'qhire', plugin_dir_url( __FILE__ ) . 'css/default.css' );
		wp_enqueue_script('raphael', plugin_dir_url( __FILE__ ) . 'js/raphael.js', array( 'jquery' ), '1.0.0', true );
	}

	//this is the QHire widget class.
	class QHire_Widget extends WP_Widget 
	{
		public function __construct() 
	    {
	        parent::__construct("QHire_Widget", "QHire Freelance Widget", array("description" => __("This plugin displays a freelance widget with skills and contact form.")));

	        //enqueue CSS and JS on frontend only if widget is active.
	        if ( is_active_widget(false, false, $this->id_base) )
	        {
 		   		add_action( 'wp_enqueue_scripts', 'qhire_scripts' );
	        }
	    }

	    //displays widget on admin panel
	    public function form( $instance ) 
	    {
	        if($instance) 
	        {
	            $title = esc_attr($instance['title']);
	            $qhire_widget_markup = esc_attr($instance['qhire_widget_markup']);
	            $name = esc_attr($instance['name']);
	            $profile_pic = esc_attr($instance['profile_pic']);
	            $information = esc_attr($instance['information']);
	            $desc = esc_attr($instance['desc']);
	            $portfolio = esc_attr($instance['portfolio']);

	            $skill_name = esc_attr($instance['skill_name']);
	            $skill_percentage = esc_attr($instance['skill_percentage']);
	            $skill_color = esc_attr($instance['skill_color']);

	            $footer_text = esc_attr($instance['footer_text']);
	        } 
	        else
	        {
	            $title = '';
	            $qhire_widget_markup = '';
	            $name = '';
	            $profile_pic = '';
	            $information = '';
	            $desc = '';
	            $portfolio = '';

	            $skill_name = '';
	            $skill_color = '';
	            $skill_percentage = '';

	            $footer_text = '';
	        }
	       
	        ?>
	 
	        <p>
	            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __("Title"); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	        </p>

	        <p>
	            <input class="widefat" id="<?php echo $this->get_field_id('qhire_widget_markup'); ?>" name="<?php echo $this->get_field_name('qhire_widget_markup'); ?>" type="checkbox" value="<?php echo __("False") ?>" <?php
	            	if($qhire_widget_markup == "False")
	            	{
	            		echo 'checked';
	            	}
	            	else
	            	{
	            		echo '';
	            	}
	             ?> /> <?php echo __("Don't Wrap Inside Widget Markup"); ?>
	        </p>

	        <p>
	            <input class="widefat" id="<?php echo $this->get_field_id('information'); ?>" name="<?php echo $this->get_field_name('information'); ?>" type="checkbox" value="<?php echo __("False") ?>" <?php
	            	if($information == "False")
	            	{
	            		echo 'checked';
	            	}
	            	else
	            	{
	            		echo '';
	            	}
	             ?> /> <?php echo __("Don't Display Author Information"); ?>
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('name'); ?>"><?php echo __("Name"); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('profile_pic'); ?>"><?php echo __("Your Photo URL. Size: 64x64"); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('profile_pic'); ?>" name="<?php echo $this->get_field_name('profile_pic'); ?>" type="text" value="<?php echo $profile_pic; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php echo __("Description. Not too long."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo $desc; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('portfolio'); ?>"><?php echo __("Your Portfolio URL."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('portfolio'); ?>" name="<?php echo $this->get_field_name('portfolio'); ?>" type="text" value="<?php echo $portfolio; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('skill_name'); ?>"><?php echo __("Comma seperated list of skill name."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('skill_name'); ?>" placeholder="HTML, CSS, WordPress, JavaScript" name="<?php echo $this->get_field_name('skill_name'); ?>" type="text" value="<?php echo $skill_name; ?>" />
	        </p>
	        
	        <p>
	            <label for="<?php echo $this->get_field_id('skill_color'); ?>"><?php echo __("Comma seperated list of skill colors."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('skill_color'); ?>" name="<?php echo $this->get_field_name('skill_color'); ?>" placeholder="red, blue, yellow, orange" type="text" value="<?php echo $skill_color; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('skill_percentage'); ?>"><?php echo __("Comma seperated list of skill percentages."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('skill_percentage'); ?>" name="<?php echo $this->get_field_name('skill_percentage'); ?>" placeholder="50, 77, 44, 98" type="text" value="<?php echo $skill_percentage; ?>" />
	        </p>

	        <p>
	            <label for="<?php echo $this->get_field_id('footer_text'); ?>"><?php echo __("Footer text."); ?></label>  
	            <input class="widefat" id="<?php echo $this->get_field_id('footer_text'); ?>" name="<?php echo $this->get_field_name('footer_text'); ?>" type="text" value="<?php echo $footer_text; ?>" />
	        </p>

	        <p>
	        	When user submits the quota form a email will be sent to administrator's email address.
	        </p>

	        <?php
	    }

	    //updates widget's field values on submit
	    public function update( $new_instance, $old_instance ) 
	    {
	        $instance = $old_instance;
	        $instance['title'] = strip_tags($new_instance['title']);
	        $instance['qhire_widget_markup'] = strip_tags($new_instance['qhire_widget_markup']);
	        $instance['name'] = strip_tags($new_instance['name']);
	        $instance['profile_pic'] = strip_tags($new_instance['profile_pic']);
	        $instance['information'] = strip_tags($new_instance['information']);
			$instance['desc'] = strip_tags($new_instance['desc']);
			$instance['portfolio'] = strip_tags($new_instance['portfolio']);
			
			$instance['skill_percentage'] = strip_tags($new_instance['skill_percentage']);
			$instance['skill_color'] = strip_tags($new_instance['skill_color']);
			$instance['skill_name'] = strip_tags($new_instance['skill_name']);

			$instance['footer_text'] = strip_tags($new_instance['footer_text']);

	        return $instance;
	    }

	    //displays widget on frontend
	    public function widget( $args, $instance ) 
    	{

    		extract($args);
         
	        $title = apply_filters('widget_title', $instance['title']);
	        $qhire_widget_markup = apply_filters('qhire_widget_markup', $instance['qhire_widget_markup']);
	        $name = apply_filters('name', $instance['name']);
	        $profile_pic = apply_filters('profile_pic', $instance['profile_pic']);
	        $information = apply_filters('information', $instance['information']);
	        $desc = apply_filters('desc', $instance['desc']);
	        $portfolio = apply_filters('portfolio', $instance['portfolio']);

	        $skill_percentage = apply_filters('skill_percentage', $instance['skill_percentage']);
	        $skill_color = apply_filters('skill_color', $instance['skill_color']);
	        $skill_name = apply_filters('skill_name', $instance['skill_name']);

	        $footer_text = apply_filters('footer_text', $instance['footer_text']);

	        if($qhire_widget_markup != "False")
	        {
	        	echo $before_widget;
	         
		        if($title) 
		        {
		            echo $before_title . $title . $after_title ;
		        }	
	        }

	        ?>

				<div id="qhire-width-test"></div>
				<div class="qhire" id="qhire">
					<div class="head">
						<div class="signal"></div>
						<span class="freelance"><b>Freelance: </b><span class="available">I am available</span></span>
						<div class="clear"></div>
					</div>
					<?php
						if($information != "False")
						{
							?>
								<div class="information">
									<?php
										if(isset($profile_pic))
										{
											?>
												<img src="<?php echo $profile_pic; ?>" width="64" height="64" />
											<?php
										}
									?>
									<b><?php echo $name . "<br>"; ?></b>
									<span>
										<?php
											echo $desc;
										?>
									</span>
									<?php
										if(isset($portfolio))
										{
											?>
												<a target="_blank" class="portfolio" href="<?php echo $portfolio; ?>">Portfolio →</a>
											<?php
										}
									?>
									<div class="clear"></div>
								</div>
							<?php
						}
					?>
					
					<div class="box" id="box">
						<div id="diagram"></div>
						<div id="quote" class="quote">
							<form method="post" id="qhire_form" action="javascript:return false;">
								<input id="qhire_email" name="email" type="text" placeholder="Your E-Mail Address">
								<br><br>
								<textarea id="qhire_desc" name="details" placeholder="Complete project details."></textarea> 
								<br><br>
								<input id="qhire_submit" data-url="<?php echo admin_url(); ?>" onclick="qhire_request_quota();" type="submit" value="Request Quota">
							</form>
							<div class="thanks" id="qhire_thanks">
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/handshake.png" />
								<br>
								<h5>Will get back to you soon!!!</h5>
							</div>
						</div>		
					</div>
					<div class="get">
					<?php
						$skill_color_array = explode(',', $skill_color);
						$skill_percentage_array = explode(',', $skill_percentage);
						$skill_name_array = explode(',', $skill_name);

						$number = sizeof($skill_name_array);

						for ($i=0; $i < $number; $i++) 
						{
							?>
								<div class="arc">
									<span class="text"><?php echo $skill_name_array[$i]; ?></span>
									<input type="hidden" class="percent" value="<?php echo $skill_percentage_array[$i]; ?>" />
									<input type="hidden" class="color" value="<?php echo $skill_color_array[$i]; ?>" />
								</div>								
							<?php 
						}
					?>
					</div>
					<div class="foot">
						<span class="available availables"><b><?php echo $footer_text; ?></b></span>
						<button id="hire_button" data onclick="qhire_display_form();">Hire ME →</button>
						<div class="clear"></div>
					</div>
				</div>
	        <?php
		
	        if($qhire_widget_markup != "False")
	        {
	        	echo $after_widget;
	        }     
    	}
	}

	//register the widget
	add_action('widgets_init', 'qhire_register_widget');
	
	function qhire_register_widget() 
	{
		register_widget("QHire_Widget");
	}

	function qhire()
	{
		$client = $_GET["client"];
		$desc = $_GET["desc"];

		$email = get_bloginfo('admin_email');

		if($client == "")
		{
			die();
		}

		if($desc == "")
		{
			die();
		}

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		
		$headers .= 'From: QHire<admin@qnimate.com>' . "\r\n";
		echo mail($email, "New Job Request", "Client E-Mail Address: " . $client . '<br> Project Details: ' . $desc , $headers);


		die();
	}

	//register AJAX api's for contact form submit.
	add_action("wp_ajax_qhire", "qhire");
	add_action("wp_ajax_nopriv_qhire", "qhire");

?>