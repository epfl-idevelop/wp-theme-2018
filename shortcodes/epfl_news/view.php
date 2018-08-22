<?php
  $template = get_query_var('epfl_news_template');
  $data = get_query_var('epfl_news_data');

  $count = 1;
  $header = false;
  $last = count($data);
?>

<div class="container-full">
  <div class="container">
    <div class="list-group">
      <?php 
        foreach($data as $news) {

          $is_first_event = ($count==1);

          if (get_locale() == 'fr_FR') {
            $image_description = $news->fr_description;
          } else {
            $image_description = $news->en_description;
          }

          if (get_locale() == 'fr_FR') {
            $category = $news->category->fr_label;
          } else {
            $category = $news->category->en_label;
          }
    
          $publish_date = new DateTime($news->publish_date);
          $publish_date = $publish_date->format('d.m.y');
          $subtitle = str_ireplace('<p>', '', $news->subtitle);
        
          if ($template == 2 and $count != 1 and $header == false) {

            $header = true;
              echo '<div class="container pb-5 offset-xl-top pt-5 pt-xl-0">';
              echo '<div class="row">';
              echo '<div class="col-lg-10 offset-lg-1">';
              echo '<div class="row mb-4">';
          }
      ?>

<?php 
  if ("1" == $template): // TEMPLATE LISTING
?>
        <a href="<?php echo $news->news_url ?>" class="list-group-item list-group-teaser link-trapeze-vertical">
          <div class="list-group-teaser-container">
            <div class="list-group-teaser-thumbnail">
              <picture>
                <img src="<?php echo $news->visual_url ?>" class="img-fluid" alt="<?php echo $image_description ?>" >
              </picture>
            </div>
            <div class="list-group-teaser-content">
              <p class="h5"><?php echo $news->title ?></p>
              <p>
                <time datetime="<?php echo $publish_date ?>"><span class="sr-only">Published:</span><?php echo $publish_date ?></time>
                <span class="text-muted">— <?php echo $subtitle ?></span>
              </p>
            </div>
          </div>
        </a>
<?php 
  elseif ("2" == $template): // TEMPLATE WWW WITH 3 NEWS
?>
<?php if (true === $is_first_event): ?>

        <div class="fullwidth-teaser fullwidth-teaser-horizontal">
          <picture>
            <img src="<?php echo $news->visual_url ?>" aria-labelledby="background-label" alt="<?php echo $image_description ?>"/>
          </picture>
          <div class="fullwidth-teaser-text">
            <div class="fullwidth-teaser-header">
              <div class="fullwidth-teaser-title">
                <h3><?php echo $news->title ?></h3>
                <ul class="list-inline mt-2">
                  <li class="list-inline-item"><?php if (get_locale() == 'fr_FR'): ?>Actualités<?php else: ?>News<?php endif; ?></li>
                  <li class="list-inline-item"><?php echo $category ?></li>
                </ul>
              </div>
              <a href="<?php echo $news->news_url ?>" aria-label="Link to read more of that page" class="btn btn-primary triangle-outer-top-right d-none d-xl-block">
                <?php if (get_locale() == 'fr_FR'): ?> En savoir plus <?php else: ?> Read more <?php endif; ?>
                <span class="sr-only">sur Tech Transfer.</span>
                <svg class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg>
              </a>
            </div>
            <div class="fullwidth-teaser-content">
              <p><?php echo $subtitle ?></p>
            </div>
            <div class="fullwidth-teaser-footer">
              <a href="<?php echo $news->news_url ?>" aria-label="Link to read more of that page" class="btn btn-primary btn-block d-xl-none"><?php if (get_locale() == 'fr_FR'): ?> En savoir plus <?php else: ?> Read more <?php endif; ?></a>
            </div>
          </div>
        </div>

  <?php else: ?>

        <div class="col-md-6 d-flex">
          <a href="<?php echo $news->news_url ?>" class="card link-trapeze-horizontal">
            <div class="card-body">
              <h3 class="card-title"><?php echo $news->title ?></h3>
              <div class="card-info">
                <span class="card-info-date">
                  <time datetime="DATETIME HERE"><?php echo $publish_date ?></time>
                </span>
                <span><?php if (get_locale() == 'fr_FR'): ?>Actualités<?php else: ?>News<?php endif; ?></span>
                <span><?php echo $category ?></span>
              </div>
              <p><?php echo $subtitle ?></p>
            </div>
          </a>
        </div>

  <?php endif; ?>
<?php endif; ?>

<?php if ($template == 2 and $last == $count): ?>
      </div>
      <p class="text-center">
        <a class="link-pretty" href="https://actu.epfl.ch/search/mediacom/">
          <?php
          if (get_locale() == 'fr_FR') {
            echo 'Toutes les actualités';
          } else {
            echo 'All news';
          }
          ?>
        </a>
      </p>
    </div>
  </div>
</div>
<?php endif; ?>

<?php
      $count++;
    } // end foreach
?>
</div>
</div>
</div>