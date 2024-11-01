<div class="wrap"><h2>Settings Wp Showtime Plugin</h2>
<p>Place <strong>[showtime]</strong> in your post or page body</p>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
 
<label>City or post code by default: <input type="text" name="showtime_city" value="<?php echo get_option('showtime_city'); ?>" /></label>
<br>
<label>Language: <input type="text" name="showtime_lang" value="<?php echo get_option('showtime_lang'); ?>" /></label>
<small>ru - Русский, en - English | Other languages are not supported yet.</small>
<br>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="showtime_city,showtime_lang" />
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
</p>
</form>

</div>