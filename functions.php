<?php

add_filter( 'product_type_selector', 'cartible_product_type_selector', 10, 2 );
 
/**
 * Remove product types we do not want to be shown.
 */
function cartible_product_type_selector( $product_types ) {
  unset( $product_types['grouped'] );
  unset( $product_types['external'] );
  unset( $product_types['simple'] );
  unset( $product_types['variable'] );
 
  return $product_types;
}


// Add custom product fields
function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';

	// Number Field
	woocommerce_wp_text_input( 
		array( 
			'id'                => '_number_field', 
			'label'             => __( 'Program Number', 'woocommerce' ), 
			'placeholder'       => '', 
			'description'       => __( 'Enter the program number.', 'woocommerce' ),
			'type'              => 'number', 
			'custom_attributes' => array(
					'step' 	=> 'any',
					'min'	=> '0'
				) 
		)
	);

	// Select
	woocommerce_wp_select( 
	array( 
		'id'      => '_select', 
		'label'   => __( 'Ticket Status', 'woocommerce' ), 
		'options' => array(
			'one'   => __( 'Available', 'woocommerce' ),
			'two'   => __( 'Rush Only', 'woocommerce' ),
			'three'   => __( 'Sold Out', 'woocommerce' )
			)
		)
	);
  
	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_text_field', 
			'label'       => __( 'Date', 'woocommerce' ), 
			'placeholder' => 'Ex) SATURDAY, OCT. 10',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the date here', 'woocommerce' ) 
		)
	);

	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_text_field', 
			'label'       => __( 'Time', 'woocommerce' ), 
			'placeholder' => 'Ex) 11:30 AM',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the start time of the program', 'woocommerce' ) 
		)
	);

	// Select
	woocommerce_wp_select( 
	array( 
		'id'      => '_select', 
		'label'   => __( 'Location', 'woocommerce' ), 
		'options' => array(
			'one'   => __( 'Little Theater 1', 'woocommerce' ),
			'two'   => __( 'Dryden Theater', 'woocommerce' )
			)
		)
	);

  
	// Number Field
	woocommerce_wp_text_input( 
		array( 
			'id'                => '_number_field', 
			'label'             => __( 'Community Partner', 'woocommerce' ), 
			'placeholder'       => 'Type here', 
			'description'       => __( '', 'woocommerce' ),
			'type'              => 'number', 
			'custom_attributes' => array(
					'step' 	=> 'any',
					'min'	=> '0'
				) 
		)
	);

	// Textarea
	woocommerce_wp_textarea_input( 
		array( 
			'id'          => '_textarea', 
			'label'       => __( 'Special Guests', 'woocommerce' ), 
			'placeholder' => 'Type here', 
			'description' => __( 'Enter the special guests here.', 'woocommerce' ) 
		)
	);

	// Checkbox
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_checkbox', 
		'wrapper_class' => 'show_if_simple', 
		'label'         => __('After Party', 'woocommerce' ), 
		'description'   => __( 'Will there be an after party?', 'woocommerce' ) 
		)
	);

	// Checkbox
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_checkbox', 
		'wrapper_class' => 'show_if_simple', 
		'label'         => __('Interpreted', 'woocommerce' ), 
		'description'   => __( 'This film will be interpreted!', 'woocommerce' ) 
		)
	);

	// Select
	woocommerce_wp_select( 
	array( 
		'id'      => '_select', 
		'label'   => __( 'Category', 'woocommerce' ), 
		'options' => array(
			'one'   => __( 'Narrative', 'woocommerce' ),
			'two'   => __( 'Shorts', 'woocommerce' )
			)
		)
	);


	// Product Select
	?>
	<p class="form-field product_field_type">
	<label for="product_field_type"><?php _e( 'Product Select', 'woocommerce' ); ?></label>
	<select id="product_field_type" name="product_field_type[]" class="ajax_chosen_select_products" multiple="multiple" data-placeholder="<?php _e( 'Search for a product&hellip;', 'woocommerce' ); ?>">
		<?php
			$product_field_type_ids = get_post_meta( $post->ID, '_product_field_type_ids', true );
			$product_ids = ! empty( $product_field_type_ids ) ? array_map( 'absint',  $product_field_type_ids ) : null;
			if ( $product_ids ) {
				foreach ( $product_ids as $product_id ) {
					$product      = get_product( $product_id );
					$product_name = woocommerce_get_formatted_product_name( $product );
					echo '<option value="' . esc_attr( $product_id ) . '" selected="selected">' . esc_html( $product_name ) . '</option>';
				}
			}
		?>
	</select> <img class="help_tip" data-tip='<?php _e( 'Your description here', 'woocommerce' ) ?>' src="<?php echo $woocommerce->plugin_url(); ?>/assets/images/help.png" height="16" width="16" />
	</p>
	<?php



  echo '</div>';
	
}

function woo_add_custom_general_fields_save( $post_id ){
	
	// Number Field
	$woocommerce_number_field = $_POST['_number_field'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
	
	// Select
	$woocommerce_select = $_POST['_select'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_select', esc_attr( $woocommerce_select ) );	

	// Text Field
	$woocommerce_text_field = $_POST['_text_field'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );

	// Text Field
	$woocommerce_text_field = $_POST['_text_field'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );
		
	// Select
	$woocommerce_select = $_POST['_select'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_select', esc_attr( $woocommerce_select ) );

	// Number Field
	$woocommerce_number_field = $_POST['_number_field'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
		
	// Textarea
	$woocommerce_textarea = $_POST['_textarea'];
	if( !empty( $woocommerce_textarea ) )
		update_post_meta( $post_id, '_textarea', esc_html( $woocommerce_textarea ) );

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_checkbox', $woocommerce_checkbox );

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_checkbox', $woocommerce_checkbox );
		
	// Select
	$woocommerce_select = $_POST['_select'];
	if( !empty( $woocommerce_select ) )
		update_post_meta( $post_id, '_select', esc_attr( $woocommerce_select ) );
		
	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_checkbox', $woocommerce_checkbox );
	
		
	// Product Field Type
	$product_field_type =  $_POST['product_field_type'];
	update_post_meta( $post_id, '_product_field_type_ids', $product_field_type );
	
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );


//add custom product types

// add a program product type
add_filter( 'product_type_selector', 'program_add_custom_product_type' );
function program_add_custom_product_type( $types ){
    $types[ 'program_custom_product' ] = __( 'Program' );
    return $types;
}

add_action( 'plugins_loaded', 'program_create_custom_product_type' );
function program_create_custom_product_type(){
     // declare the product class
     class WC_Product_Program extends WC_Product{
        public function __construct( $product ) {
           $this->product_type = 'program_custom_product';
           parent::__construct( $product );
           // add additional functions here
        }
    }
}

// add a film product type
add_filter( 'product_type_selector', 'film_add_custom_product_type' );
function film_add_custom_product_type( $types ){
    $types[ 'film_custom_product' ] = __( 'Film' );
    return $types;
}

add_action( 'plugins_loaded', 'film_create_custom_product_type' );
function film_create_custom_product_type(){
     // declare the product class
     class WC_Product_Film extends WC_Product{
        public function __construct( $product ) {
           $this->product_type = 'film_custom_product';
           parent::__construct( $product );
           // add additional functions here
        }
    }
}

//Disable the reviews tab
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}
