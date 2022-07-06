<?php

wp_enqueue_script( 'facebook-login' );

?>

<button data-login="facebook">Facebook Login</button>
<a href="<?=wp_logout_url(); ?>">Logout</a>