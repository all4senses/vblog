<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <!-- <div class="inside"> -->
<?php else: ?>
  <?php
    $url = 'http://www.voip-weblog.com'. url('node/' . $node->nid);
    echo '<div class="float share">' . vb_blocks_getSocialiteButtons($url, $node->title) . '</div>';
  ?>

  <div class="main-content"> 
<?php endif; ?>

 
  <?php
 
    
    //$created_str = date('F d, Y', $node->created);
    $created_str = date('\<\d\i\v\>d\<\/\d\i\v\>\<\s\p\a\n\>F\<\/\s\p\a\n\>', $node->created);
    $created_rdf = preg_replace('|(.*)content=\"(.*)\"\s(.*)|', '$2', $date); //date('Y-m-d\TH:i:s', $node->created); 

    $extra_data['guest_author'] = NULL;
    if (!empty($node->field_extra_data['und'][0]['value'])) {
      $extra_data = unserialize($node->field_extra_data['und'][0]['value']);

      if (!empty($extra_data['guest_author'])) {
        if (strpos($extra_data['guest_author'], '; ')) {
          $extra_data['guest_author'] = explode('; ', $extra_data['guest_author']);
          $extra_data['guest_author'] = $author_name = l($extra_data['guest_author'][0], $extra_data['guest_author'][1], array('absolute' => TRUE));
        }
        else {
          $extra_data['guest_author'] = $author_name = $extra_data['guest_author'];
        }
      }
      else {
        $extra_data['guest_author'] = $author_name = NULL;
      }
    }

    if (!$extra_data['guest_author']) {
      $authorExtendedData = vb_misc_loadUserExtendedData($node->uid);
      $author_name = $authorExtendedData->realname;
    }

    global $language;

    if (!$extra_data['guest_author']) {
      $author_url = url('user/' . $node->uid);
      $gplus_profile = ($authorExtendedData->field_u_gplus_profile_value) ? ' <a class="gplus" title="Google+ profile of ' . $author_name . '" href="' . $authorExtendedData->field_u_gplus_profile_value . '?rel=author">(G+)</a>' : '';
      $author_title = t('!author\'s profile', array('!author' => $author_name));
    }

              
  ?>

 
          

      <?php if (!$page): ?>
        <header>
      <?php endif; ?>

          <div class="title-block">
          
          <?php 

              
              if ($page) {
                echo '<div class="submitted" property="dc:date dc:created" content="' . $created_rdf . '" datatype="xsd:dateTime">' . $created_str . '</div>';
              }
              else {
                echo '<div class="submitted">', $created_str, '</div>';
              }
              
            ?>
          
          
          <?php 
          if ($page): ?>
          <h1 
          <?php elseif($_GET['q'] == 'home'): ?>
          <h3  
          <?php else: ?>
          <h2 
          <?php endif; ?>
              
            <?php print ' ' /*. $title_attributes*/ /*preg_replace('/datatype=".*"/', '', $title_attributes);*/ /*preg_replace('/datatype=""/', '', $title_attributes)*/; if (!$node->status) {echo ' class="not-published"';} ?>>
            
            <?php if (!isset($node->title_no_link) && !$page): ?>
              <a href="<?php print $node_url; ?>">
                <?php print $title; ?>
              </a>
            <?php else: ?>
              <?php print $title; ?>
            <?php endif; ?>

          <?php if ($page): ?>
          </h1>
          <?php elseif($_GET['q'] == 'home'): ?>
          </h3>  
          <?php else: ?>
          </h2>
          <?php endif; ?> 

            
            
          <?php 

              
              if ($page) {

//                $submitted = '<span property="dc:date dc:created" content="' . $created_rdf . '" datatype="xsd:dateTime" rel="sioc:has_creator">' .
//                                'By: ' .
//                                (!$extra_data['guest_author'] ? '<span class="username" lang="' . $language->language . '" xml:lang="' . $language->language . '" typeof="sioc:UserAccount" property="foaf:name">' . $author_name . '</span>' : '<span class="guest-author">' . $author_name . '</span>') .
//                               ', on ' . $created_str .
//                              '</span>';
//
//                echo '<span class="submitted">', $submitted, '</span>';
                
                
                echo '<div class="author" >By: <span rel="sioc:has_creator" class="username" lang="' . $language->language . '" xml:lang="' . $language->language . '" typeof="sioc:UserAccount" property="foaf:name">'
                      . (!$extra_data['guest_author'] 
                        ? $author_name 
                        : '<span class="guest-author">' . $author_name . '</span>') .
                     '</span></div>';

              }
              else {
                
//                $submitted = 'By: <span class="author">' . $author_name . '</span>, on ' . $created_str;
//                echo '<div class="links"><span class="submitted">', $submitted, '</span></div>';
                
                echo '<div class="author">Posted by ' . $author_name . '</div>';
                
              }
              
            ?>
            
            
          </div>

          <div class="top-line"></div>
          
      <?php if (!$page): ?>
        </header>
      <?php endif; ?>



      <div class="content <?php echo ($page ? 'page' : 'teaser'); ?>"<?php print $content_attributes; ?>><?php
      
          // Hide comments, tags, and links now so that we can render them later.
          hide($content['comments']);
          hide($content['links']);
          hide($content['field_categories']);
          hide($content['disqus']);
          
           if (!$page) {
            
              hide($content['body']);

              if (!empty($node->body['und'][0]['summary'])) {
                //dpm('Summary is not empty... Using');
                //echo l('Read more »', 'node/' . $node->nid, array('attributes' => array('class' => array('more')))) . strip_tags($node->body['und'][0]['summary']);
                echo $node->body['und'][0]['summary'] . l('Read more', 'node/' . $node->nid, array('attributes' => array('class' => array('more'))));
              }
              else{
                
                if (!empty($node->field_a_teaser['und'][0]['value'])) {
                  //dpm('field_a_teaser IS NOT empty');
                  $teaser_data['teaser'] = $node->field_a_teaser['und'][0]['value'];
                }
                else {
                  //dpm('field_a_teaser is empty');
                  //$teaser_data = vb_misc_getArticleTeaserData('all', $content['body'][0]['#markup'], $node->nid);
                  $teaser_data = vb_misc_getArticleTeaserData('all', $node->body['und'][0]['value'], $node->nid);
                }
                echo $teaser_data['teaser'] . l('Read more', 'node/' . $node->nid, array('attributes' => array('class' => array('more'))));
              }
            
            
          }
          else {
          
              $keyword_metatag_name = ($node->type == 'news_post') ? 'news_keywords' : 'keywords';

              if (isset($content['metatags']['keywords'])) {
                hide($content['metatags']['keywords']);
              }

              if (isset($content['metatags']['keywords']['#attached']['drupal_add_html_head'][0][0]['#value']) && $content['metatags']['keywords']['#attached']['drupal_add_html_head'][0][0]['#value']) {
                vb_misc_addMetatag($keyword_metatag_name, $content['metatags']['keywords']['#attached']['drupal_add_html_head'][0][0]['#value']);
              }
              elseif (@$content['field_topics']) {
                vb_misc_pushTagsToMetatags($keyword_metatag_name, $content['field_topics']);
              }
          }
          
          echo render($content);
          
        ?></div>


    
    
      <footer>

        <?php 
        
         if (!$page) {
            ////global $user;
            ////$submitted = 'By: <a href="' . $author_url . '" title="' . $author_title . '" >' . $author_name . '</a>, on ' . $created_str;
            ////////////$submitted = 'By: <span class="author">' . $author_name . '</span>, on ' . $created_str;
            //echo '<div class="links">' . l($content['field_categories'][0]['#title'], $content['field_categories'][0]['#href']). '<span class="delim">|</span><span class="submitted">', $submitted, '</span><span class="delim">|</span>' . l('Comments' . ( ($user->uid && $node->comment_count) ? ' (' . $node->comment_count . ')' : ''), 'node/' . $node->nid, array('fragment' => 'comments')) . '</div>';
            ////echo '<div class="links"><span class="submitted">', $submitted, '</span><span class="delim">|</span>' . l('Comments' . ( ($user->uid && $node->comment_count) ? ' (' . $node->comment_count . ')' : ''), 'node/' . $node->nid, array('fragment' => 'comments')) . '</div>';
            ///////////echo '<div class="links"><span class="submitted">', $submitted, '</span></div>';
         }
         else {
           
          //echo '<div class="links">' . l($content['field_categories'][0]['#title'], $content['field_categories'][0]['#href']) . '</div>';
          //dpm($node);
          //dpm($content);
          
        } 
      ?>
    </footer>
    
    
    
    
    <div class="bottom-clear"></div>
 

  
  
  <?php if ($page && $node->type != 'news_post'): ?>
      
  </div> <!-- main-content -->
  

  <?php endif; ?>
  
    
  <?php 
//    if ($page) {
//      echo '<a id="comments"></a>', render($content['disqus']);//, render($content['comments']); 
//    }
  ?>

<?php if (!$page): ?>
  <!-- </div> --> <!-- /.inside -->
  <!-- <div class="shadow"></div> -->
  </article> <!-- /.node -->
<?php endif; ?>


