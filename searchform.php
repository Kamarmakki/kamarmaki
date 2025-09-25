<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input type="search" placeholder="<?php esc_attr_e( 'بحث...', 'kamar-seo' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
  <button type="submit"><i class="fas fa-search"></i></button>
</form>