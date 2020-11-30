<!doctype html>
<html <?php language_attributes(); ?> style="--primary-color: <?= get_global_option('theme_primary_color','option') ?>; --secondary-color: <?= get_global_option('theme_secondary_color','option') ?>; --dark-color: <?= get_global_option('theme_dark_color','option') ?>; --light-color: <?= get_global_option('theme_light_color','option') ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
  </head>

  <body data-module-load <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>

    <div data-load-container id="app">
      <?php echo \Roots\view(\Roots\app('sage.view'), \Roots\app('sage.data'))->render(); ?>
    </div>

    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
  </body>
</html>
