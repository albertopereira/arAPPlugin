<section id="popular-this-week">

  <h2><?php echo __('Popular this week') ?></h2>
  <ul>
    <?php $first = true; ?>
    <?php foreach ($popularThisWeek as $idx => $item): ?>
      <?php 
        $object = QubitObject::getById($item[0]);
        
        $a = $object->ancestors->AndSelf(); 
        
        $isAllowed = true;
      
        foreach ($a as $key => $value) {
          if(!QubitAcl::isAllowed(sfContext::getInstance()->user, (string)$value->getId(), 'read')){
            $isAllowed = false;
          }
        }

        if($first) {
          $img = $object instanceof QubitInformationObject ? $object->digitalObjects[0] : null;
        }
      ?>
      <?php if($isAllowed){ ?>
        <li>
          <?php
            if ($first && $img->thumbnail) {
              echo '<div class="popular-image" style="background: url(\'' . $img->getPublicPath() . '\');background-position: center;background-size: cover;"></div>';
            } else if ($first){
              echo '<div class="popular-image" style="background: url(\'/plugins/arAPPlugin/images/popular_default.jpg\');background-position: center;background-size: cover;"></div>';              
            }
          ?>
          <a href="<?php echo url_for(array($object)) ?>"><?php echo render_title($object) ?><span class="n-visits"><strong><?php echo __('%1% visits', array('%1%' => $item[1])) ?></strong></span></a>
        </li>
      <?php $first = false; } ?>
    <?php endforeach; ?>
  </ul>

</section>
