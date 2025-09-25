<?php
if ( post_password_required() ) return;

if ( have_comments() ) : ?>
  <h3><?php printf( esc_html( _n( 'تعليق واحد', '%s تعليقات', get_comments_number(), 'kamar-seo' ) ), number_format_i18n( get_comments_number() ) ); ?></h3>
  <ol class="comment-list">
    <?php wp_list_comments( [ 'style' => 'ol', 'short_ping' => true ] ); ?>
  </ol>
<?php endif; ?>

<?php comment_form(); ?>