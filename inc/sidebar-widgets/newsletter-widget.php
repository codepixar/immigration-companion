<?php
/**
 * @version  1.0
 * @package  Immigration
 *
 */
 
 
/**************************************
*Creating Newsletter Widget
***************************************/
 
class immigration_newsletter_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'immigration_newsletter_widget',


// Widget name will appear in UI
esc_html__( '[ Immigration ] Newsletter Form', 'immigration-companion' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer newsletter signup form.', 'immigration-companion' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		= apply_filters( 'widget_title', $instance['title'] );
$actionurl 	= apply_filters( 'widget_actionurl', $instance['actionurl'] );
$desc 		= apply_filters( 'widget_desc', $instance['desc'] );

// mc validation
wp_enqueue_script( 'mc-validate');

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );


if( $desc ){
	echo '<p>'.esc_html( $desc ).'</p>';
}
?>
<div id="mc_embed_signup" class="immigration-subscribe-newsletter newsletter-form">
	<form target="_blank" novalidate action="<?php echo esc_url( $actionurl ); ?>" id="mc-embedded-subscribe-form" method="post" class="navbar-form">
		<div class="input-group add-on align-items-center d-flex">
		<input type="email" name="EMAIL" class="form-control" placeholder="<?php esc_html_e( 'Email address', 'immigration-companion' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
		<div class="input-group-btn">
			<button type="submit" class="click-btn btn btn-default genric-btn"><span class="lnr lnr-arrow-right"></span></button>
		</div>
		</div>
		<div style="position: absolute; left: -5000px;">
			<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
		</div>

		<div class="info"></div>
	</form>
</div>

<?php
echo wp_kses_post( $args['after_widget'] );
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Newsletter', 'immigration-companion' );
}


//	Action Url
if ( isset( $instance[ 'actionurl' ] ) ) {
	$actionurl = $instance[ 'actionurl' ];
}else {
	$actionurl = '';
}

//	Text Area
if ( isset( $instance[ 'desc' ] ) ) {
	$desc = $instance[ 'desc' ];
}else {
	$desc = '';
}


// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'immigration-companion'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>"><?php esc_html_e( 'Action URL:' ,'immigration-companion'); ?></label> 
<p >Enter here your MailChimp action URL. <a href="http://docs.creativegigs.net/docs/aproch/how-to-use-optin-form/how-to-locate-mailchimp-newsletter-form-action-url/" target="_blank">How to</a></p>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'actionurl' ) ); ?>" type="text" value="<?php echo esc_attr( $actionurl ); ?>" />

</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Short Description:' ,'fashe'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
</p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['actionurl'] = ( ! empty( $new_instance['actionurl'] ) ) ? strip_tags( $new_instance['actionurl'] ) : '';
$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';

return $instance;

}

} // Class immigration_newsletter_widget ends here


// Register and load the widget
function immigration_newsletter_load_widget() {
	register_widget( 'immigration_newsletter_widget' );
}
add_action( 'widgets_init', 'immigration_newsletter_load_widget' );