<?php $menu = get_component('menu', 'staticPagesMenu') ?>
<?php $layout = 'layout_1col' ?>
<?php if (!empty($menu)): ?>
  <?php $layout = 'layout_2col' ?>
  <?php slot('sidebar') ?>
    <?php echo $menu ?>
  <?php end_slot() ?>
<?php endif; ?>
<?php decorate_with($layout) ?>

<?php $query = '_X-'; ?>

<?php slot('title') ?>
  <h1><?php 
    echo substr($resource->getTitle(array('cultureFallback' => true)), 0, strlen($query)) === $query ? substr(render_title($resource->getTitle(array('cultureFallback' => true))), strlen($query)) : render_title($resource->getTitle(array('cultureFallback' => true)));
  ?></h1>
<?php end_slot() ?>

<div class="page">
  <div>
    <?php echo render_value_html($sf_data->getRaw('content')) ?>
  </div>

  <?php if ($resource->getTitle(array('cultureFallback' => true)) == 'Blog') { ?>
    <ul class="blog">
      <?php foreach ($pager->getResults() as $item): ?>

  
        <?php if (substr($item->title, 0, strlen($query)) === $query) { ?>
          <li class="<?php echo 0 == @++$row % 2 ? 'even' : 'odd' ?>">
              <?php echo '<div class="blog-title">' . link_to(render_title(substr($item->title, strlen($query))), array($item, 'module' => 'staticpage')) . '</div>'; ?>
              <?php //echo $item->slug; ?>
              <?php echo '<div class="blog-content">' . substr(render_value_html($item->content), 0, 500) . '...</div>'; ?>
          </li>
        <?php } ?>  
      <?php endforeach; ?>
    </ul>
  <?php } ?>

</div>

<?php if (QubitAcl::check($resource, 'update')): ?>
  <?php slot('after-content') ?>
      <section class="actions">
        <ul>
          <li><?php echo link_to(__('Edit'), array($resource, 'module' => 'staticpage', 'action' => 'edit'), array('class' => 'c-btn c-btn-submit', 'title' => __('Edit this page'))) ?></li>
          <?php if (QubitAcl::check($resource, 'delete')): ?>
            <li><?php echo link_to(__('Delete'), array($resource, 'module' => 'staticpage', 'action' => 'delete'), array('class' => 'c-btn c-btn-delete')) ?></li>
          <?php endif; ?>
        </ul>
      </section>
  <?php end_slot() ?>
<?php endif; ?>
