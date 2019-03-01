<div class="clear"></div>
<!--End Index-->
<!--Start Footer-->
<div class="footer">
    <?php
    /* A sidebar in the footer? Yep. You can can customize
     * your footer with four columns of widgets.
     */
    get_sidebar('footer');
    ?>
</div>
<div class="footer-strip"></div>
<!--Start footer bottom inner-->
<div class="bottom-footer">
    <div class="footer_bottom_inner"> 
        <?php if (squirrel_get_option('squirrel_cright') != '') { ?>
            <span class="copyright"><?php echo squirrel_get_option('squirrel_cright'); ?></span> 
            <?php
        } else {
            printf('<span class="copyright"><a rel="nofollow" href="' . esc_url('https://www.inkthemes.com/market/tattoo-shop-wordpress-theme/') . '">Squirrel Theme</a> powered by <a href="' . esc_url('http://www.wordpress.org') . '">WordPress</a></span>');
        }
        ?>

<ul class="social_logos">

<?php if (squirrel_get_option('inkthemes_facebook') != '') { ?>
                            <li class="facebook"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_facebook')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_twitter') != '') { ?>
                            <li class="twitter"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_twitter')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_google') != '') { ?>
                            <li class="google"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_google')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

  <?php if (squirrel_get_option('inkthemes_rss') != '') { ?>
                            <li class="rss"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_rss')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_pinterest') != '') { ?>
                            <li class="pinterest"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_pinterest')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_linked') != '') { ?>
                            <li class="linkedin"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_linked')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                             <?php if (squirrel_get_option('inkthemes_instagram') != '') { ?>
                            <li class="instagram"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_instagram')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_youtube') != '') { ?>
                            <li class="youtube"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_youtube')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>


                        <?php if (squirrel_get_option('inkthemes_tumblr') != '') { ?>
                            <li class="tumblr"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_tumblr')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (squirrel_get_option('inkthemes_flickr') != '') { ?>
                            <li class="flickr"><a href="<?php echo esc_url(squirrel_get_option('inkthemes_flickr')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>
                        
                    </ul>

    </div>
</div>
<!--End Footer bottom inner-->
<!--End Footer bottom-->
</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
