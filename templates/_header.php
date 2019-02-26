<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link href="/css/fullWidthTreeView.css" rel="stylesheet">
<link href="/vendor/jstree/themes/default/style.min.css" rel="stylesheet">
<script src="/js/treeviewTypes.js"></script>
<script src="/js/pager.js"></script>
<script src="/js/treeViewPager.js"></script>
<script src="/js/fullWidthTreeView.js"></script>
<script src="/vendor/jstree/jstree.min.js"></script>

<script>
  jQuery(function(){
    jQuery('#fullwidth-treeview-row').append('<a href="#" class="fullwidth-treeview-row-close">X</a>')
    jQuery('#addInformationObjectWrapper').width('100%')
    jQuery('.fullwidth-treeview-row-close').on('click', function (e) {
      jQuery('#fullwidth-treeview-row').hide();
      e.preventDefault();
    })
  })
</script>

<?php echo get_component('default', 'updateCheck') ?>

<?php echo get_component('default', 'privacyMessage') ?>

<?php if ($sf_user->isAdministrator() && (string)QubitSetting::getByName('siteBaseUrl') === ''): ?>
  <div class="site-warning">
    <?php echo link_to(__('Please configure your site base URL'), 'settings/siteInformation', array('rel' => 'home', 'title' => __('Home'))) ?>
  </div>
<?php endif; ?>

<header id="top-bar">
  <div class="background-gradient"></div>
  <?php if (sfConfig::get('app_toggleLogo')): ?>
    <?php echo link_to(image_tag('logo', array('alt' => 'AtoM')), '@homepage', array('id' => 'logo', 'rel' => 'home')) ?>
  <?php endif; ?>

  <?php if (sfConfig::get('app_toggleTitle')): ?>
    <h1 id="site-name">
      <?php echo link_to('<span>'.esc_specialchars(sfConfig::get('app_siteTitle')).'</span>', '@homepage', array('rel' => 'home', 'title' => __('Home'))) ?>
    </h1>
  <?php endif; ?>

  <?php if (sfConfig::get('app_toggleDescription')): ?>
    <div id="site-slogan">
      <span><?php echo esc_specialchars(sfConfig::get('app_siteDescription')) ?></span>
    </div>
  <?php endif; ?>

  <nav>

    <?php echo get_component('menu', 'userMenu') ?>

    <?php echo get_component('menu', 'quickLinksMenu') ?>

    <?php if (sfConfig::get('app_toggleLanguageMenu')): ?>
      <?php echo get_component('menu', 'changeLanguageMenu') ?>
    <?php endif; ?>

    <?php echo get_component('menu', 'clipboardMenu') ?>

    <?php echo get_component('menu', 'mainMenu', array('sf_cache_key' => $sf_user->getCulture().$sf_user->getUserID())) ?>

  </nav>

  <?php echo get_component('search', 'box') ?>

  <div id="search-bar">

    <?php echo get_component('menu', 'browseMenu', array('sf_cache_key' => $sf_user->getCulture().$sf_user->getUserID())) ?>


  </div>

  <?php echo get_component_slot('header') ?>

</header>

<?php echo get_component('default', 'popular', array('limit' => 10)) ?>

