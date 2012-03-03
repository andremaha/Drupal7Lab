<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 */
?>
<div class="ae" id="wrapper">
    <header id="main-head">
        <?php if ($main_menu): ?>
        <nav id="main-nav">
            <?php print theme('links__system_main_menu', array(
                                                              'links' => $main_menu,
                                                              'attributes' => array(
                                                                  'id' => 'main-menu-links',
                                                                  'class' => array('links', 'clearfix'),
                                                              ),
                                                              'heading' => array(
                                                                  'text' => t('Main menu'),
                                                                  'level' => 'h2',
                                                                  'class' => array('element-invisible'),
                                                              ),
                                                         )); ?>
        </nav> <!-- /#main-nav -->
        <?php endif; ?>

        <?php if ($site_name || $site_slogan): ?>
        <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) {
            print ' class="element-invisible"';
        } ?>>

            <?php if ($site_name && $site_slogan): ?>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                <h1 id="site-name"><?php if ($hide_site_name) {
                    print ' class="element-invisible"';
                } ?>
                    <span><?php print $site_name; ?></span>
                    <strong><?php print $site_slogan; ?></strong>
                </h1>
            </a>
            <?php endif; ?>
        </div> <!-- /#name-and-slogan -->
        <?php endif; ?>
    </header>


    <?php if ($messages): ?>
    <div id="messages">
        <div class="section clearfix">
            <?php // print $messages; ?>
        </div>
    </div> <!-- /.section, /#messages -->
    <?php endif; ?>

    <?php

    // TODO: Do this language switch more elegantly, please!!!
    $lang_code = $_SERVER["REQUEST_URI"];
    if ($lang_code == '/de') {
      $featured = node_load(39);
      $featured_text = substr($featured->body['und'][0]['value'], 0, 548);
    } elseif ($lang_code == '/en') {
      $featured = node_load(41);
      $featured_text = substr($featured->body['und'][0]['value'], 0, 438);
    } else {
      $featured = node_load(8);
      $featured_text = substr($featured->body['und'][0]['safe_value'], 0, 849);
    }
   //var_dump($featured);
    ?>


    <?php if ($is_front): ?>
    <section id="feature">
       <p>
        <a href="/node/<?php echo $featured->nid?>"><?php print $featured_text; ?></a></p>
    </section>
    <?php endif; ?>

    <?php if ($page['translations']): ?>
    <section id="translations" class="group">
        <?php print render($page['translations']); ?>
    </section>
    <?php endif; ?>

    <?php if ($page['regional']): ?>
    <section id="regional" class="group">
        <?php print render($page['regional']); ?>
    </section>
    <?php endif; ?>


    <?php if ($page['triptych_first'] || $page['triptych_middle'] || $page['triptych_last']): ?>
    <div id="triptych-wrapper">
        <div id="triptych" class="clearfix">
            <?php print render($page['triptych_first']); ?>
            <?php print render($page['triptych_middle']); ?>
            <?php print render($page['triptych_last']); ?>
        </div>
    </div> <!-- /#triptych, /#triptych-wrapper -->
    <?php endif; ?>

    <?php if (!$is_front): ?>
    <div id="main-wrapper" class="clearfix">
        <div id="main" class="clearfix">

            <?php if ($breadcrumb): ?>
            <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php endif; ?>

            <?php if ($page['sidebar_first']): ?>
            <aside class="other-articles-in-category">
                <?php print render($page['sidebar_first']); ?>
            </aside>
            <?php endif; ?>

            <section class="article-page">
                <?php if ($page['highlighted']): ?>
                <div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>

                <!--header>
            <?php if ($title): ?>
            <a href="#">
            <h1 class="title" id="page-title">
              // <?php print $title; ?>
            </h1>
            </a>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
        </header-->

                <?php if ($tabs): ?>
                <div class="tabs">
                    <?php print render($tabs); ?>
                </div>
                <?php endif; ?>
                <?php print render($page['help']); ?>
                <?php if ($action_links): ?>
                <ul class="action-links">
                    <?php print render($action_links); ?>
                </ul>
                <?php endif; ?>
                <section class="main-text">
                    <?php print render($page['content']); ?>
                </section>
                <?php print $feed_icons; ?>
                </article>

            </section>

            <?php if ($page['sidebar_second']): ?>
            <div id="sidebar-second" class="column sidebar">
                <div class="section">
                    <?php print render($page['sidebar_second']); ?>
                </div>
            </div> <!-- /.section, /#sidebar-second -->
            <?php endif; ?>

        </div>
    </div> <!-- /#main, /#main-wrapper -->
    <?php endif;?>


    <div id="footer-wrapper">
        <div class="section">

            <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
            <div id="footer-columns" class="clearfix">
                <?php print render($page['footer_firstcolumn']); ?>
                <?php print render($page['footer_secondcolumn']); ?>
                <?php print render($page['footer_thirdcolumn']); ?>
                <?php print render($page['footer_fourthcolumn']); ?>
            </div> <!-- /#footer-columns -->
            <?php endif; ?>

            <?php if ($page['footer']): ?>
            <div id="footer" class="clearfix">
                <?php print render($page['footer']); ?>
            </div> <!-- /#footer -->
            <?php endif; ?>

        </div>
    </div>
    <!-- /.section, /#footer-wrapper -->

</div> <!-- /#page, /#page-wrapper -->
