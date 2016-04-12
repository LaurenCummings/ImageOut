<?php

add_filter( 'product_type_selector', 'cartible_product_type_selector', 10, 2 );
 
/**
 * Remove product types we do not want to be shown.
 */
function cartible_product_type_selector( $product_types ) {
  unset( $product_types['grouped'] );
  unset( $product_types['external'] );
  unset( $product_types['variable'] );
 
  return $product_types;
}


// Add custom product fields
function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';

//Program Product Fields
  echo '<h1>Program Fields</h1>';
	// Program Number
	woocommerce_wp_text_input( 
		array( 
			'id'                => '_program_number', 
			'label'             => __( 'Program Number', 'woocommerce' ), 
			'wrapper_class' 	=> 'hide_if_simple',
			'placeholder'       => '', 
			'description'       => __( 'Enter the program number.', 'woocommerce' ),
			'type'              => 'number', 
			'custom_attributes' => array(
					'step' 	=> 'any',
					'min'	=> '0'
				) 
		)
	);

	// Ticket Status
	woocommerce_wp_select( 
	array( 
		'id'      => '_ticket_status', 
		'label'   => __( 'Ticket Status', 'woocommerce' ), 
		'wrapper_class' => 'hide_if_simple',
		'options' => array(
			'one'   => __( 'Available', 'woocommerce' ),
			'two'   => __( 'Rush Only', 'woocommerce' ),
			'three'   => __( 'Sold Out', 'woocommerce' )
			)
		)
	);
  
	// Date
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_date', 
			'label'       => __( 'Date', 'woocommerce' ),
			'wrapper_class' => 'hide_if_simple', 
			'placeholder' => 'Ex) SATURDAY, OCT. 10',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the date here', 'woocommerce' ) 
		)
	);

	// Time
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_time', 
			'label'       => __( 'Time', 'woocommerce' ), 
			'wrapper_class' => 'hide_if_simple',
			'placeholder' => 'Ex) 11:30 AM',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the start time of the program', 'woocommerce' ) 
		)
	);

	// Location
	woocommerce_wp_select( 
	array( 
		'id'      => '_location', 
		'label'   => __( 'Location', 'woocommerce' ), 
		'wrapper_class' => 'hide_if_simple',
		'options' => array(
			'one'   => __( 'Little Theater 1', 'woocommerce' ),
			'two'   => __( 'Dryden Theater', 'woocommerce' )
			)
		)
	);

  
	// Community Partner
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_community_partner', 
			'label'       => __( 'Community Partner', 'woocommerce' ), 
			'wrapper_class' => 'hide_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Community Partner', 'woocommerce' ) 
		)
	);

	// Special Guests
	woocommerce_wp_textarea_input( 
		array( 
			'id'          => '_special_guests', 
			'label'       => __( 'Special Guests', 'woocommerce' ), 
			'wrapper_class' => 'hide_if_simple',
			'placeholder' => 'Type here', 
			'description' => __( 'Enter the special guests here.', 'woocommerce' ) 
		)
	);

	// After Pary
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_party', 
		'wrapper_class' => 'hide_if_simple', 
		'label'         => __('After Party?', 'woocommerce' ), 
		'description'   => __( 'Will there be an after party?', 'woocommerce' ) 
		)
	);

	// Interpreted
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_interpreted', 
		'wrapper_class' => 'hide_if_simple', 
		'label'         => __('Interpreted?', 'woocommerce' ), 
		'description'   => __( 'This film will be interpreted!', 'woocommerce' ) 
		)
	);

	// Program Category
	woocommerce_wp_select( 
	array( 
		'id'      => '_program_category', 
		'label'   => __( 'Category', 'woocommerce' ), 
		'wrapper_class' => 'hide_if_simple',
		'options' => array(
			'one'   => __( 'Narrative', 'woocommerce' ),
			'two'   => __( 'Shorts', 'woocommerce' )
			)
		)
	);

	// Opening Night
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_opening_night', 
		'wrapper_class' => 'hide_if_simple', 
		'label'         => __('Opening Night?', 'woocommerce' ), 
		'description'   => __( 'This film will be shown on opening night', 'woocommerce' ) 
		)
	);

//Film Product Fields
  echo '<h1>Film Fields</h1>';
	// Website
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_website', 
			'label'       => __( 'Website', 'woocommerce' ), 
			'wrapper_class' => 'hide_if_bundle',
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the website', 'woocommerce' ) 
		)
	);

	// Trailer
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_trailer', 
			'label'       => __( 'Trailer', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter a link to the trailer', 'woocommerce' ) 
		)
	);

	// Film Details
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_film_details', 
			'label'       => __( 'Language/Year/Length', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'EX) Germany/2014/90 min.',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Film Details', 'woocommerce' ) 
		)
	);

	// Director
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_director', 
			'label'       => __( 'Director', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Director', 'woocommerce' ) 
		)
	);

	// Film Description
	woocommerce_wp_textarea_input( 
		array( 
			'id'          => '_description', 
			'label'       => __( 'Film Description', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here', 
			'description' => __( 'Enter the film description here.', 'woocommerce' ) 
		)
	);

	// Film Title
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_title', 
			'label'       => __( 'Title', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Title', 'woocommerce' ) 
		)
	);

	// Alternate Film Title
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_alt_title', 
			'label'       => __( 'Alternate Title', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Alternate Title', 'woocommerce' ) 
		)
	);

	// Language Note
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_language_note', 
			'label'       => __( 'Language Note', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here',
			'desc_tip'    => 'true',
			'description' => __( 'Enter a note on the Language', 'woocommerce' ) 
		)
	);

	// Awards
	woocommerce_wp_textarea_input( 
		array( 
			'id'          => '_awards', 
			'label'       => __( 'Awards', 'woocommerce' ), 
			'wrapper_class' => 'show_if_simple',
			'placeholder' => 'Type here', 
			'description' => __( 'Enter any film awards here.', 'woocommerce' ) 
		)
	);

	// Premiere
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_premiere', 
		'wrapper_class' => 'show_if_simple', 
		'label'         => __('Film Premiere?', 'woocommerce' ), 
		'description'   => __( 'This is the premiere of the film.', 'woocommerce' ) 
		)
	);

  echo '</div>';
	
}

function woo_add_custom_general_fields_save( $post_id ){

//Program Product Fields	
	// Number Field
	$woocommerce_number_field = $_POST['_program_number'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_program_number', esc_attr( $woocommerce_number_field ) );
	
	// Select
	$woocommerce_select = $_POST['_ticket_status'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_ticket_status', esc_attr( $woocommerce_select ) );	

	// Text Field
	$woocommerce_text_field = $_POST['_date'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_date', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_time'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_time', esc_attr( $woocommerce_text_field ) );
		
	// Select
	$woocommerce_select = $_POST['_location'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_location', esc_attr( $woocommerce_select ) );

	// Text Field
	$woocommerce_text_field = $_POST['_community_partner'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_community_partner', esc_attr( $woocommerce_text_field ) );
		
	// Textarea
	$woocommerce_textarea = $_POST['_special_guests'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_special_guests', esc_html( $woocommerce_textarea ) );

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_party'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_party', $woocommerce_checkbox );

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_interpreted'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_interpreted', $woocommerce_checkbox );
		
	// Select
	$woocommerce_select = $_POST['_program_category'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_program_category', esc_attr( $woocommerce_select ) );
		
	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_opening_night'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_opening_night', $woocommerce_checkbox );

//Film Product Fields
	// Text Field
	$woocommerce_text_field = $_POST['_website'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_website', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_trailer'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_trailer', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_film_details'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_film_details', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_director'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_director', esc_attr( $woocommerce_text_field ) );

	// Textarea
	$woocommerce_textarea = $_POST['_description'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_description', esc_html( $woocommerce_textarea ) );

	// Text Field
	$woocommerce_text_field = $_POST['_title'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_title', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_alt_title'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_alt_title', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_language_note'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_language_note', esc_attr( $woocommerce_text_field ) );

	// Textarea
	$woocommerce_textarea = $_POST['_awards'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_awards', esc_html( $woocommerce_textarea ) );

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_premiere'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_premiere', $woocommerce_checkbox );

}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );



//Disable the reviews tab
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}

//Disable the SKU on each product from being shown
add_filter( 'wc_product_sku_enabled', '__return_false' );