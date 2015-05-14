<?php
/*
Plugin Name: Google+ Interactive Posts
Plugin URI: http://dejanseo.com.au/wordpress-plugin-google-interactive-posts/
Description: Enable Google+ interactive posts on your website in a few simple steps.
Version: 1.0
Author: Dejan SEO
Author URI: http://dejanseo.com.au/
*/

// create custom box in add/edit post area
add_action( 'add_meta_boxes', 'GoogleInteractivePosts_custom_box' );
add_action( 'save_post', 'GoogleInteractivePosts_save_postdata' );
// create box in admin panel - add/edit post/page page
function GoogleInteractivePosts_custom_box() {
    $screens = array( 'post', 'page' );
    foreach ($screens as $screen) {
        add_meta_box(
            'GoogleInteractivePosts_sectionid',
            __( 'Google Interactive Posts', 'GoogleInteractivePosts_box' ),
            'GoogleInteractivePosts_inner_custom_box',
            $screen,
            'side'
        );
    }
}

function gip_get_credits(){
    $credits_url = "http://linkserver.dejanseo.org/api.php?consumer=GoogleInteractivePosts";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $credits_url);
    $returned = curl_exec($ch);

    return json_decode($returned);
}

// box template
function GoogleInteractivePosts_inner_custom_box($post) {

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'GoogleInteractivePosts_noncename');

    // get post id, and create object
    $postID = $post->ID;

    $meta_values = get_post_meta( $postID, 'GoogleInteractivePosts',true);
    $GoogleInteractivePostsPostMeta = unserialize($meta_values);

    if(!$GoogleInteractivePostsPostMeta['GIP_button_label']){
        $GoogleInteractivePostsPostMeta['GIP_button_label'] = "Share";
    }

    ?>
    <b>Prefill Text:</b><br>
    <textarea rows="5" name="GIP_description" style="width:100%"><?php echo $GoogleInteractivePostsPostMeta['GIP_description'];?></textarea><br>
    <b>Button label type:</b><br>
    <select name="GIP_button_style" style="width:100%">
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ACCEPT"){echo "selected";}?>>ACCEPT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ACCEPT_GIFT"){echo "selected";}?>>ACCEPT_GIFT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD"){echo "selected";}?>>ADD</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_FRIEND"){echo "selected";}?>>ADD_FRIEND</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_ME"){echo "selected";}?>>ADD_ME</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_TO_CALENDAR"){echo "selected";}?>>ADD_TO_CALENDAR</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_TO_CART"){echo "selected";}?>>ADD_TO_CART</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_TO_FAVORITES"){echo "selected";}?>>ADD_TO_FAVORITES</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_TO_QUEUE"){echo "selected";}?>>ADD_TO_QUEUE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ADD_TO_WISH_LIST"){echo "selected";}?>>ADD_TO_WISH_LIST</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ANSWER"){echo "selected";}?>>ANSWER</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ANSWER_QUIZ"){echo "selected";}?>>ANSWER_QUIZ</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "APPLY"){echo "selected";}?>>APPLY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ASK"){echo "selected";}?>>ASK</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "ATTACK"){echo "selected";}?>>ATTACK</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BEAT"){echo "selected";}?>>BEAT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BID"){echo "selected";}?>>BID</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BOOK"){echo "selected";}?>>BOOK</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BOOKMARK"){echo "selected";}?>>BOOKMARK</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BROWSE"){echo "selected";}?>>BROWSE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "BUY"){echo "selected";}?>>BUY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CAPTURE"){echo "selected";}?>>CAPTURE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CHALLENGE"){echo "selected";}?>>CHALLENGE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CHANGE"){echo "selected";}?>>CHANGE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CHAT"){echo "selected";}?>>CHAT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CHECKIN"){echo "selected";}?>>CHECKIN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "COLLECT"){echo "selected";}?>>COLLECT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "COMMENT"){echo "selected";}?>>COMMENT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "COMPARE"){echo "selected";}?>>COMPARE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "COMPLAIN"){echo "selected";}?>>COMPLAIN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CONFIRM"){echo "selected";}?>>CONFIRM</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CONNECT"){echo "selected";}?>>CONNECT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CONTRIBUTE"){echo "selected";}?>>CONTRIBUTE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "COOK"){echo "selected";}?>>COOK</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "CREATE"){echo "selected";}?>>CREATE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DEFEND"){echo "selected";}?>>DEFEND</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DINE"){echo "selected";}?>>DINE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DISCOVER"){echo "selected";}?>>DISCOVER</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DISCUSS"){echo "selected";}?>>DISCUSS</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DONATE"){echo "selected";}?>>DONATE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "DOWNLOAD"){echo "selected";}?>>DOWNLOAD</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "EARN"){echo "selected";}?>>EARN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "EAT"){echo "selected";}?>>EAT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "EXPLAIN"){echo "selected";}?>>EXPLAIN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "FIND"){echo "selected";}?>>FIND</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "FIND_A_TABLE"){echo "selected";}?>>FIND_A_TABLE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "FOLLOW"){echo "selected";}?>>FOLLOW</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "GET"){echo "selected";}?>>GET</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "GIFT"){echo "selected";}?>>GIFT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "GIVE"){echo "selected";}?>>GIVE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "GO"){echo "selected";}?>>GO</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "HELP"){echo "selected";}?>>HELP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "IDENTIFY"){echo "selected";}?>>IDENTIFY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "INSTALL"){echo "selected";}?>>INSTALL</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "INSTALL_APP"){echo "selected";}?>>INSTALL_APP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "INTRODUCE"){echo "selected";}?>>INTRODUCE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "INVITE"){echo "selected";}?>>INVITE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "JOIN"){echo "selected";}?>>JOIN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "JOIN_ME"){echo "selected";}?>>JOIN_ME</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "LEARN"){echo "selected";}?>>LEARN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "LEARN_MORE"){echo "selected";}?>>LEARN_MORE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "LISTEN"){echo "selected";}?>>LISTEN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "MAKE"){echo "selected";}?>>MAKE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "LISTEN"){echo "selected";}?>>MATCH</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "MATCH"){echo "selected";}?>>MESSAGE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "OPEN"){echo "selected";}?>>OPEN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "OPEN_APP"){echo "selected";}?>>OPEN_APP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "OWN"){echo "selected";}?>>OWN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PAY"){echo "selected";}?>>PAY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PIN"){echo "selected";}?>>PIN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PIN_IT"){echo "selected";}?>>PIN_IT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PLAN"){echo "selected";}?>>PLAN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PLAY"){echo "selected";}?>>PLAY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "PURCHASE"){echo "selected";}?>>PURCHASE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "RATE"){echo "selected";}?>>RATE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "READ"){echo "selected";}?>>READ</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "READ_MORE" || !$GoogleInteractivePostsPostMeta['GIP_button_style']){echo "selected";}?>>READ_MORE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "RECOMMEND"){echo "selected";}?>>RECOMMEND</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "RECORD"){echo "selected";}?>>RECORD</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "REDEEM"){echo "selected";}?>>REDEEM</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "REGISTER"){echo "selected";}?>>REGISTER</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "REPLY"){echo "selected";}?>>REPLY</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "RESERVE"){echo "selected";}?>>RESERVE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "REVIEW"){echo "selected";}?>>REVIEW</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "RSVP"){echo "selected";}?>>RSVP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SAVE"){echo "selected";}?>>SAVE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SAVE_OFFER"){echo "selected";}?>>SAVE_OFFER</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SEE_DEMO"){echo "selected";}?>>SEE_DEMO</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SELL"){echo "selected";}?>>SELL</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SEND"){echo "selected";}?>>SEND</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SIGN_IN"){echo "selected";}?>>SIGN_IN</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SIGN_UP"){echo "selected";}?>>SIGN_UP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "START"){echo "selected";}?>>START</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "STOP"){echo "selected";}?>>STOP</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "SUBSCRIBE"){echo "selected";}?>>SUBSCRIBE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "TAKE_QUIZ"){echo "selected";}?>>TAKE_QUIZ</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "TAKE_TEST"){echo "selected";}?>>TAKE_TEST</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "TRY_IT"){echo "selected";}?>>TRY_IT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "UPVOTE"){echo "selected";}?>>UPVOTE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "USE"){echo "selected";}?>>USE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VIEW"){echo "selected";}?>>VIEW</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VIEW_ITEM"){echo "selected";}?>>VIEW_ITEM</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VIEW_MENU"){echo "selected";}?>>VIEW_MENU</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VIEW_PROFILE"){echo "selected";}?>>VIEW_PROFILE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VISIT"){echo "selected";}?>>VISIT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "VOTE"){echo "selected";}?>>VOTE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WANT"){echo "selected";}?>>WANT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WANT_TO_SEE"){echo "selected";}?>>WANT_TO_SEE</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WANT_TO_SEE_IT"){echo "selected";}?>>WANT_TO_SEE_IT</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WATCH"){echo "selected";}?>>WATCH</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WATCH_TRAILER"){echo "selected";}?>>WATCH_TRAILER</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WISH"){echo "selected";}?>>WISH</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_button_style'] == "WRITE"){echo "selected";}?>>WRITE</option>
    </select><br>
    <b>Label text:</b><br>
    <input type="text" name="GIP_button_label" value="<?php echo $GoogleInteractivePostsPostMeta['GIP_button_label'];?>" style="width:100%" value="Share on Google+"><br>
    <b>Show Google Interactive Posts Button?</b><br>
    <select name="GIP_show_button" style="width:100%">
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_show_button'] == "Yes"){echo "selected";}?>>Yes</option>
        <option <?php if($GoogleInteractivePostsPostMeta['GIP_show_button'] == "No"){echo "selected";}?>>No</option>
    </select>
    <hr>
    <?php
    // show credits
    $credits = gip_get_credits();
    if(isset($credits->href) && isset($credits->anchor) && !isset($credits->banner)){
        echo '<a href="'.$credits->href.'" target="_blank">'.$credits->anchor.'</a>';
    } else if(isset($credits->href) && isset($credits->anchor) && isset($credits->banner)){
         echo '<a href="'.$credits->href.'" target="_blank"><img src="'.$credits->banner.'" alt="'.$credits->anchor.'"></a>';
    }
}
// on save button click
function GoogleInteractivePosts_save_postdata($post_id) {


    // First we need to check if the current user is authorised to do this action.
    if (!current_user_can('edit_page', $post_id)){
        return false;
    } else  if (!current_user_can('edit_post', $post_id)){
        return false;
    }

    // Return if it's a post revision
    if ( false !== wp_is_post_revision( $post_id ) ){
        return false;
    }


    $GIP_data['GIP_description'] = $_POST['GIP_description'];
    $GIP_data['GIP_button_style'] = $_POST['GIP_button_style'];
    $GIP_data['GIP_button_label'] = $_POST['GIP_button_label'];
    $GIP_data['GIP_show_button'] = $_POST['GIP_show_button'];

    $AllGipData = serialize($GIP_data);
    add_post_meta( $post_id,'GoogleInteractivePosts', $AllGipData, true) || update_post_meta( $post_id,'GoogleInteractivePosts', $AllGipData );

}


/**
 * Add button below content
 */
add_filter('the_content', 'GoogleInteractivePosts_to_the_content');
function GoogleInteractivePosts_to_the_content($content = ''){


        $post_id = get_the_ID();
        if ( !empty( $post_id ) ) {

            // get post meta values, and unserialize it
            $post_meta_values = get_post_meta( $post_id, 'GoogleInteractivePosts',true);
            $GoogleInteractivePostsPostMeta = unserialize($post_meta_values);

            // get aou key & current post permalink
            $api_key = get_option('GoogleInteractivePosts_apikey');
            $permalink = get_permalink( $post_id );

            // if button enabled and api_key not null - show button
            if($GoogleInteractivePostsPostMeta['GIP_show_button'] == "Yes" && $api_key){

                $button_code = '<br>'
                        . '<span id="myBtn" class="demo g-interactivepost" '
                        . 'data-clientid="'.$api_key.'.apps.googleusercontent.com" '
                        . 'data-contenturl="'.$permalink.'" '
                        . 'data-calltoactionlabel="'.$GoogleInteractivePostsPostMeta['GIP_button_style'].'" '
                        . 'data-calltoactionurl="'.$permalink.'" '
                        . 'data-cookiepolicy="single_host_origin" '
                        . 'data-prefilltext="'.$GoogleInteractivePostsPostMeta['GIP_description'].'"> '
                        . '<span class="icon">&nbsp;</span>'
                        . '<span class="label">'.$GoogleInteractivePostsPostMeta['GIP_button_label'].'</span>'
                        . '</span>';

                return $content.$button_code;
            } else {
                return $content;
            }
        }

}



/*
 * add javascript function to the footer
 */
function GoogleInteractivePosts_addtofooter() {
    ?>
    <script type="text/javascript">
        (function() {
         var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
         po.src = 'https://apis.google.com/js/client:plusone.js';
         var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
       })();
    </script>
    <?php
}
add_action('wp_footer', 'GoogleInteractivePosts_addtofooter');



/**
* Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
* Enqueue plugin style-file
*/
add_action( 'wp_enqueue_scripts', 'GoogleInteractivePosts_addcss' );
function GoogleInteractivePosts_addcss() {
    wp_register_style( 'GoogleInteractivePosts_style', plugins_url('style/button_css.css', __FILE__) );
    wp_enqueue_style( 'GoogleInteractivePosts_style' );
}

function GoogleInteractivePosts_custom_wp_admin_style() {
        wp_enqueue_script( 'admin-slider', plugin_dir_url( __FILE__ ) . '/slider/bjqs-1.3.min.js' );

        wp_register_style( 'GoogleInteractivePosts_style_slider', plugin_dir_url( __FILE__ ) . '/slider/bjqs.css' );
        wp_enqueue_style( 'GoogleInteractivePosts_style_slider' );
}
add_action( 'admin_enqueue_scripts', 'GoogleInteractivePosts_custom_wp_admin_style' );



/*
 * Create admin menu
 */
add_action( 'admin_menu', 'GoogleInteractivePosts_plugin_menu' );
function GoogleInteractivePosts_plugin_menu() {
    add_menu_page("Google Interactive Posts", "Google Interactive Posts", 0, "google_interactive_posts", "GoogleInteractivePosts_main_function");

}
// show admin page menu
function GoogleInteractivePosts_main_function(){

    include("templates/header_tpl.php");

    // save data
    if($_POST['save']){
        update_option('GoogleInteractivePosts_apikey', $_POST['api_key']);
    }
    // get api from option
    $api_key = get_option('GoogleInteractivePosts_apikey');

    include("templates/form.php");
    include("templates/api_instructions.php");
    include("templates/footer_tpl.php");

}





/**
 * Add notice to admin area
 */
function GoogleInteractivePosts_admin_notice() {

    $api_key = get_option('GoogleInteractivePosts_apikey');
    if(!$api_key){
        ?>
        <div class="error">
            <p><?php _e( 'Great stuff! We are now going to configure the plugin and set up Google+ <a href="?page=google_interactive_posts">Click Here</a>', 'GIP_notification' ); ?></p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'GoogleInteractivePosts_admin_notice' );