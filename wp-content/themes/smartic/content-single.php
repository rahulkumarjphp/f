<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <?php
        /**
         * Functions hooked in to smartic_single_post_top action
         *
         * @see smartic_post_header        - 10
         */
        do_action('smartic_single_post_top');

        /**
         * Functions hooked in to smartic_single_post action
         *
         * @see smartic_post_thumbnail         - 10
         * @see smartic_post_content         - 30
         */
        do_action('smartic_single_post');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to smartic_single_post_bottom action
     *
     * @see smartic_post_taxonomy      - 5
     * @see smartic_post_nav            - 10
     * @see smartic_display_comments    - 20
     */
    do_action('smartic_single_post_bottom');
    ?>

</article><!-- #post-## -->
