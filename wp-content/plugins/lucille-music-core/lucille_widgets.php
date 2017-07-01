<?php
class LUCILLE_SWP_recent_posts_with_images extends WP_Widget {
	/* Sets up the widgets name etc */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget widget_lucille_recent_posts widget_recent_entries',
			'description' => esc_html__('Recent Posts With Images', 'lucille-music-core'),
		);
		parent::__construct('LUCILLE_SWP_recent_posts_with_images', 'Lucille Recent Posts', $widget_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance) {
		$allowed_html = array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'li'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'h3'	=> array(
				'id'	=> array(),
				'class'	=> array()
			)
		);

		echo wp_kses($args['before_widget'], $allowed_html);
		if (!empty($instance['title'])) {
			echo wp_kses($args['before_title'], $allowed_html) . apply_filters('widget_title', $instance['title']) . wp_kses($args['after_title'], $allowed_html);
		}
		
		$number_of_posts = intval($instance['number_of_posts']);
		$query_args = array(
			'post_type' 	=> 'post',
			'post_status'   => 'publish',
			'numberposts'	=> $number_of_posts,
			'posts_per_page'=> $number_of_posts,
			'orderby'       => 'post_date',
			'order'         => 'DESC'
		);
		
		$my_query = new WP_Query($query_args);
		if ($my_query->have_posts()) {
			echo '<ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
				?>
				<li class="clearfix">
					<?php 
					if(has_post_thumbnail()) {
						the_post_thumbnail();
					} else {
						/*add default*/
						?>
						<div class="lnwidtget_no_featured_img">
							<?php bloginfo('name'); ?>
						</div>
						<?php
					}
					?>
					<a href="<?php esc_url(the_permalink()); ?>">
					<?php echo esc_html(get_the_title()); ?>
					</a>
					<span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
				</li>
				<?php
			}
			echo '</ul>';
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		echo wp_kses($args['after_widget'], $allowed_html);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance) {
		// outputs the options form on admin
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Latest News', 'lucille-music-core');
		$number_of_posts = !empty($instance['number_of_posts']) ? intval($instance['number_of_posts']) : '5';
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'lucille-music-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
			
			<label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php esc_attr_e('Number of posts:', 'lucille-music-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr(intval($number_of_posts)); ?>">
		</p>
		
		<?php 		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Latest News';
		$instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? intval(($new_instance['number_of_posts'])) : '5';

		return $instance;
	}
}
/*
if (version_compare(PHP_VERSION, '5.3') >= 0) {
    add_action('widgets_init', function(){
		register_widget('LUCILLE_SWP_recent_posts_with_images');
	});
} else {
*/
add_action('widgets_init',
	create_function('', 'return register_widget("LUCILLE_SWP_recent_posts_with_images");')
);
/*
}
*/


class LUCILLE_SWP_next_events extends WP_Widget {
	/* Sets up the widgets name etc */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget widget_lucille_next_events widget_recent_entries',
			'description' => esc_html__('Shows The Next Events', 'lucille-music-core'),
		);
		parent::__construct('LUCILLE_SWP_next_events', 'Lucille Next Events', $widget_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance) {
		$allowed_html = array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'li'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'h3'	=> array(
				'id'	=> array(),
				'class'	=> array()
			)
		);
		echo wp_kses($args['before_widget'], $allowed_html);
		if (!empty($instance['title'])) {
			echo wp_kses($args['before_title'], $allowed_html) . apply_filters('widget_title', $instance['title']) . wp_kses($args['after_title'], $allowed_html);
		}
		
		$number_of_posts = intval($instance['number_of_posts']);
		$query_args = array(
			'numberposts'	=> $number_of_posts,
			'posts_per_page'   => $number_of_posts,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => array('event_date' => 'ASC', 'event_time' => 'ASC'),
			'order'            => 'ASC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => 'event_date',
			'meta_value'       => '',
			'post_type'        => 'js_events',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'meta_query' => array(
				'relation' => 'AND',
				'event_date' => array(
				   'key' => 'event_date',
				   'value' => date('Y/m/d',current_time('timestamp')),
				   'compare' => '>='
				),
				'event_time' => array(
				   'key' => 'event_time'
				)				
			),
			'suppress_filters' => true
		);
		
		$my_query = new WP_Query($query_args);
		if ($my_query->have_posts()) {
			echo '<ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
				
				$post_id = get_the_ID();
				$event_date = esc_html(get_post_meta($post_id, 'event_date', true));
				 if ($event_date != "") {
					@$event_date = str_replace("/","-", $event_date);
					@$dateObject = new DateTime($event_date);
				}
				$el_day = $dateObject->format('d');
				$el_month = $dateObject->format('F');

				?>
				<li class="clearfix">
					<div class="wg_event_date">
						<span class="eventlist_day"><?php echo esc_html($el_day); ?></span>
						<span class="eventlist_month"><?php echo esc_html($el_month); ?></span>
					</div>
					
					<a href="<?php esc_url(the_permalink()); ?>">
						<?php echo esc_html(get_the_title()); ?>
					</a>
				</li>
				<?php
			}
			echo '</ul>';
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		echo wp_kses($args['after_widget'], $allowed_html);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance) {
		// outputs the options form on admin
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Upcoming Events', 'lucille-music-core');
		$number_of_posts = !empty($instance['number_of_posts']) ? intval($instance['number_of_posts']) : '5';
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'lucille-music-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
			
			<label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php esc_attr_e('Number of posts:', 'lucille-music-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr(intval($number_of_posts)); ?>">
		</p>
		
		<?php 		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Upcoming Events';
		$instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? intval(($new_instance['number_of_posts'])) : '5';

		return $instance;
	}
}

/*
if (version_compare(PHP_VERSION, '5.3') >= 0) {
    add_action('widgets_init', function(){
		register_widget('LUCILLE_SWP_next_events');
	});
} else {
*/
add_action('widgets_init',
	create_function('', 'return register_widget("LUCILLE_SWP_next_events");')
);
/*
}
*/


/*
	Contact Data
*/
class LUCILLE_SWP_contact_data extends WP_Widget {
	/* Sets up the widgets name etc */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget widget_lucille_contact_data',
			'description' => esc_html__('Lucille Contact Details', 'lucille-music-core'),
		);
		parent::__construct('LUCILLE_SWP_contact_data', 'Lucille Contact Details', $widget_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance) {
		$allowed_html = array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'li'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'h3'	=> array(
				'id'	=> array(),
				'class'	=> array()
			)
		);

		echo wp_kses($args['before_widget'], $allowed_html);

		if('on' == $instance['replace_title_with_logo']) {
			if (function_exists("LUCILLE_SWP_get_user_logo_img")) {
				echo wp_kses($args['before_title'], $allowed_html);

				$logo_img = LUCILLE_SWP_get_user_logo_img();
				if (!empty($logo_img)) {
					?> <img src="<?php echo esc_url($logo_img); ?>" alt="<?php bloginfo('name'); ?>"> <?php
				} else {
					bloginfo('name');
				}

				echo wp_kses($args['after_title'], $allowed_html);
			}
		} else {
			if (!empty($instance['title'])) {
				echo wp_kses($args['before_title'], $allowed_html) . apply_filters('widget_title', $instance['title']) . wp_kses($args['after_title'], $allowed_html);
			}
		}


		$contact_address = $contact_email = $contact_phone = $contact_fax = "";
		if (function_exists("LUCILLE_SWP_get_contact_address")) {
			$contact_address = LUCILLE_SWP_get_contact_address();
		}
		if (function_exists("LUCILLE_SWP_get_contact_email")) {
			$contact_email = LUCILLE_SWP_get_contact_email();
		}
		if (function_exists("LUCILLE_SWP_get_contact_phone")) {
			$contact_phone = LUCILLE_SWP_get_contact_phone();	
		}
		if (function_exists("LUCILLE_SWP_get_contact_fax")) {
			$contact_fax = LUCILLE_SWP_get_contact_fax();
		}

		if (!empty($contact_address)) { ?>
		<div class="lc_widget_contact contact_address_w_entry">
			<?php echo esc_html($contact_address); ?>
		</div>
		<?php }?>

		<?php if (!empty($contact_phone)) { ?>
		<div class="lc_widget_contact">
			<span class="before_w_contact_data">
				<?php echo esc_html__("Phone: ", "lucille-music-core"); ?>
			</span>
			<?php echo esc_html($contact_phone); ?>
		</div>
		<?php }?>

		<?php if (!empty($contact_fax)) { ?>
		<div class="lc_widget_contact">
			<span class="before_w_contact_data">
				<?php echo esc_html__("Fax: ", "lucille-music-core"); ?>
			</span>
			<?php echo esc_html($contact_fax); ?>
		</div>
		<?php }?>

		<?php if (!empty($contact_email)) { ?>
		<div class="lc_widget_contact">
			<span class="before_w_contact_data">
				<?php echo esc_html__("Email: ", "lucille-music-core"); ?>
			</span>
			<?php echo esc_html(antispambot($contact_email)); ?>
		</div>
		<?php }

		if('on' == $instance['show_social_profiles']) {
			if (function_exists("LUCILLE_SWP_get_available_social_profiles")) {
				$user_profiles = array();
				$user_profiles = LUCILLE_SWP_get_available_social_profiles();

				if (!empty($user_profiles)) {
					?> <div class="footer_w_social_icons"> <?php
				}

				foreach ($user_profiles as $social_profile) {
					?>
						<div class="footer_w_social_icon">
							<a href="<?php echo esc_url($social_profile['url']); ?>" target="_blank">
								<i class="fa fa-<?php echo esc_attr($social_profile['icon']); ?>"></i>
							</a>
						</div>
					<?php
				}
				if (!empty($user_profiles)) {
					?> </div> <?php
				}
			}
		}

		echo wp_kses($args['after_widget'], $allowed_html);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance) {
		// outputs the options form on admin
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Lucille', 'lucille-music-core');
		$show_social_profiles = isset($instance['show_social_profiles']) && ($instance['show_social_profiles'] ==  'on') ? 'true' : 'false';
		$replace_title_with_logo = isset($instance['replace_title_with_logo']) && ($instance['replace_title_with_logo'] == 'on') ? 'true' : 'false';
		if (!isset($instance['show_social_profiles'])) {
			$instance['show_social_profiles'] = "off";
		}
		if (!isset($instance['replace_title_with_logo'])) {
			$instance['replace_title_with_logo'] = "off";
		}		

		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'lucille-music-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">

			<input class="checkbox" type="checkbox" <?php checked($instance['show_social_profiles'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_social_profiles')); ?>" name="<?php echo esc_attr($this->get_field_name('show_social_profiles')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_social_profiles')); ?>"><?php esc_attr_e('Show social profiles icons', 'lucille-music-core'); ?></label><br>
    		
			<input class="checkbox" type="checkbox" <?php checked($instance['replace_title_with_logo'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('replace_title_with_logo')); ?>" name="<?php echo esc_attr($this->get_field_name('replace_title_with_logo')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('replace_title_with_logo')); ?>"><?php esc_attr_e('Replace widget title with logo', 'lucille-music-core'); ?></label>			
		</p>
		
		<?php 		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Latest News';
		$instance['show_social_profiles'] = $new_instance['show_social_profiles'];
		$instance['replace_title_with_logo'] = $new_instance['replace_title_with_logo'];

		return $instance;
	}
}

add_action('widgets_init',
	create_function('', 'return register_widget("LUCILLE_SWP_contact_data");')
);


/*
	Gallery
*/
class LUCILLE_SWP_gallery_widget extends WP_Widget {
	/* Sets up the widgets name etc */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget widget_lucille_gallery',
			'description' => esc_html__('Lucille Gallery', 'lucille-music-core'),
		);
		parent::__construct('LUCILLE_SWP_gallery_widget', 'Lucille Gallery', $widget_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget($args, $instance) {
		$allowed_html = array(
			'div'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'li'	=> array(
				'id'	=> array(),
				'class'	=> array()
			),
			'h3'	=> array(
				'id'	=> array(),
				'class'	=> array()
			)
		);

		$gallery_id = !empty($instance['gallery_id']) ? $instance['gallery_id'] : -1;

		$images = esc_html(get_post_meta($gallery_id, 'js_swp_gallery_images_id', true));
		$id_array = explode(',', $images);
		$id_array = array_filter($id_array);

		echo wp_kses($args['before_widget'], $allowed_html);
		if (!empty($instance['title'])) {
			echo wp_kses($args['before_title'], $allowed_html) . apply_filters('widget_title', $instance['title']) . wp_kses($args['after_title'], $allowed_html);
		}

		?>
		<div class="lc_gallery_widget_container clearfix">
			<a href="<?php echo get_permalink($gallery_id); ?>">
				<?php foreach($id_array as $imgId) { ?>
					<?php echo wp_get_attachment_image($imgId, 'thumbnail'); ?>
				<?php } ?>
			</a>
		</div>
		<?php




		echo wp_kses($args['after_widget'], $allowed_html);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form($instance) {
		/* outputs the options form on admin */
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Featured Gallery', 'lucille-music-core');
		$gallery_id = isset($instance['gallery_id']) ? $instance['gallery_id'] : -1;


		/*get all gallery posts*/
		$args = array(
				'numberposts'		=> 	-1,
				'posts_per_page'   => -1,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'js_photo_albums',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true
			);	
		$gallery_posts = get_posts($args);
		
		$gallery_dropdown = array(); /*key(post_id)	=> value(post_name)*/
		foreach($gallery_posts as $single_gallery) {
				$my_post_id = $single_gallery->ID;
				$my_post_name = $single_gallery->post_title;
				
				$gallery_dropdown[$my_post_id] = $my_post_name;
		}
		wp_reset_postdata();		
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'lucille-music-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">


			<label for="<?php echo esc_attr($this->get_field_id('gallery_id')); ?>"><?php esc_attr_e('Select featured gallery', 'lucille-music-core'); ?></label><br>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('gallery_id')); ?>" name="<?php echo esc_attr($this->get_field_name('gallery_id')); ?>">
				<?php
					$first_in = true;
					foreach($gallery_dropdown as $key => $value) {
						if ((-1 == $gallery_id) && $first_in) {
							?> <option value="<?php echo esc_attr($key); ?>" selected="selected"><?php echo esc_html($value); ?></option> <?php
							$first_in = false;
							continue;
						}

						if ($key == $gallery_id) {
							?> <option value="<?php echo esc_attr($key); ?>" selected="selected"><?php echo esc_html($value); ?></option> <?php
						} else {
							?> <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option> <?php
						}

						if ($first_in) {
							$first_in = false;
						}
					}
				?>
			</select>
		</p>
		<?php 		
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Featued Gallery';
		$instance['gallery_id'] = $new_instance['gallery_id'];

		return $instance;
	}
}

add_action('widgets_init',
	create_function('', 'return register_widget("LUCILLE_SWP_gallery_widget");')
);

?>