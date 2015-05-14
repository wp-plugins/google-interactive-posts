<br><br><hr>
<h2>Setup Instructions</h2>
<p>You will need to visit two places to get the necessary details and permissions: Google Developer Console and Google+ Page Admin.</p>
<ul>
    <li>1. <a href="https://cloud.google.com/console#/project" target="_blank">Click here</a> to open google API console, and create new project</li>
    <li>2. Open recently created project, and in left sidebar click on APIs & auth.</li>
    <li>3. Enable Google+ API</li>
    <li>4. Click on "Credential" link in left sidebar, and create new client ID (screenshot 5)</li>
    <li>5. Click on "Consent screen" link, and fill all necessary data.</li>
    <li>6. Log into your Google+ Page as an admin and verify the app by visiting <b>"Dashboard > Connected services"</b></li>
</ul>
<p>When creating or editing posts you will see the interactive post panel which will allow you to set the pre-fill text, button label type and text. You will also be able to disable or enable the interactive post feature on each page.</p>
<p>For detailed installation guidance visit the following page: <a href="http://dejanseo.com.au/wordpress-plugin-google-interactive-posts/">http://dejanseo.com.au/wordpress-plugin-google-interactive-posts/</a>
<hr>
<h2>Screenshots</h2>



<div id="my-slideshow">
    <ul class="bjqs">
        <li><a href="<?php echo plugins_url( 'imgs/1_1.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/1_1.png' , __FILE__ );?>"></a></li>
        <li><a href="<?php echo plugins_url( 'imgs/2_2.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/2_2.png' , __FILE__ );?>"></a></li>
        <li><a href="<?php echo plugins_url( 'imgs/3_3.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/3_3.png' , __FILE__ );?>"></a></li>
        <li><a href="<?php echo plugins_url( 'imgs/4_4.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/4_4.png' , __FILE__ );?>"></a></li>
        <li><a href="<?php echo plugins_url( 'imgs/5_5.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/5_5.png' , __FILE__ );?>"></a></li>
        <li><a href="<?php echo plugins_url( 'imgs/6_6.png' , __FILE__ );?>" target="_blank"><img width="100%" src="<?php echo plugins_url( 'imgs/6_6.png' , __FILE__ );?>"></a></li>
    </ul>
</div>

<script>
jQuery(document).ready(function($) {
    $('#my-slideshow').bjqs({
        'width' : 1000,
        'height' : 520,
        'responsive' : true
    });
});
</script>

click on image to enlarge
<br><br>
<hr>
<?php
// show credits
$credits = gip_get_credits();
if(isset($credits->href) && isset($credits->anchor) && !isset($credits->banner)){
    echo '<a href="'.$credits->href.'" target="_blank">'.$credits->anchor.'</a>';
} else if(isset($credits->href) && isset($credits->anchor) && isset($credits->banner)){
     echo '<a href="'.$credits->href.'" target="_blank"><img src="'.$credits->banner.'" alt="'.$credits->anchor.'"></a>';
}