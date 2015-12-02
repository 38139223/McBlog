<?php
require_once 'markdown.php';

function mc_site_name($print = true) {
  global $mc_config;

  $site_name = htmlspecialchars($mc_config['site_name']);

  if ($print) {
    echo $site_name;
    return;
  }

  return $site_name;
}

function mc_site_desc($print = true) {
  global $mc_config;

  $site_desc = htmlspecialchars($mc_config['site_desc']);

  if ($print) {
    echo $site_desc;
    return;
  }

  return $site_desc;
}

function mc_site_link($print = true) {
  global $mc_config;

  $site_link = $mc_config['site_link'];

  if ($print) {
    echo $site_link;
    return;
  }

  return $site_link;
}

function mc_nick_name($print = true) {
  global $mc_config;

  $nick_name = htmlspecialchars($mc_config['user_nick']);

  if ($print) {
    echo $nick_name;
    return;
  }

  return $nick_name;
}

function mc_theme_url($path, $print = true) {
  global $mc_config;

  $url = $mc_config['site_link'].'/mc-files/theme/'. $mc_config['site_theme'] . '/' .$path;

  if ($print) {
    echo $url;
    return;
  }

  return $url;
}

function mc_is_post() {
  global $mc_get_type;

  return $mc_get_type == 'post';
}

function mc_is_page() {
  global $mc_get_type;

  return $mc_get_type == 'page';
}

function mc_is_tag() {
  global $mc_get_type;
  return $mc_get_type == 'tag';
}

function mc_is_date() {
  global $mc_get_type;
  return $mc_get_type == 'date';
}

function mc_is_archive() {
  global $mc_get_type;
  return $mc_get_type == 'archive';
}

function mc_tag_name($print=true) {
  global $mc_get_name;

  if ($print) {
    echo htmlspecialchars($mc_get_name);
    return;
  }

  return $mc_get_name;
}

function mc_date_name($print=true) {
  global $mc_get_name;

  if ($print) {
    echo htmlspecialchars($mc_get_name);
    return;
  }

  return $mc_get_name;
}

function mc_has_new() {
  global $mc_page_num;

  return $mc_page_num != 1;
}

function mc_has_old() {
  global $mc_page_num, $mc_post_count, $mc_post_per_page;

  return $mc_page_num < ($mc_post_count / $mc_post_per_page);
}

function mc_goto_old($text) {
  global $mc_get_type, $mc_get_name, $mc_page_num, $mc_config;

  if ($mc_get_type == 'tag') {
    echo '<a href="';
    echo $mc_config['site_link'];
    echo '/?tag/';
    echo $mc_get_name;
    echo '/?page=';
    echo ($mc_page_num + 1);
    echo '">';
    echo $text;
    echo '</a>';
  } else {
    echo '<a href="';
    echo $mc_config['site_link'];
    echo '/?page=';
    echo ($mc_page_num + 1);
    echo '">';
    echo $text;
    echo '</a>';
  }
}

function mc_goto_new($text) {
  global $mc_get_type, $mc_get_name, $mc_page_num, $mc_config;

  if ($mc_get_type == 'tag') {
    echo '<a href="';
    echo $mc_config['site_link'];
    echo '/?tag/';
    echo $mc_get_name;
    echo '/?page=';
    echo ($mc_page_num - 1);
    echo '">';
    echo $text;
    echo '</a>';
  } else {
    echo '<a href="';
    echo $mc_config['site_link'];
    echo '/?page=';
    echo ($mc_page_num - 1);
    echo '">';
    echo $text;
    echo '</a>';
  }
}

function mc_date_list($item_begin='<li>', $item_gap='', $item_end='</li>') {
  global $mc_dates, $mc_config;

  if (isset($mc_dates)) {
    $date_count = count($mc_dates);

    for ($i = 0; $i < $date_count; $i ++) {
      $date = $mc_dates[$i];

      echo $item_begin;
      echo '<a href="';
      echo $mc_config['site_link'];
      echo '/?date/';
      echo $date;
      echo '/">';
      echo $date;
      echo '</a>';
      echo $item_end;

      if ($i < $date_count - 1)
        echo $item_gap;
    }
  }
}

function mc_tag_list($item_begin='<li>', $item_gap='', $item_end='</li>') {
  global $mc_tags, $mc_config;

  if (isset($mc_tags)) {
    $tag_count = count($mc_tags);

    for ($i = 0; $i < $tag_count; $i ++) {
      $tag = $mc_tags[$i];

      echo $item_begin;
      echo '<a href="';
      echo $mc_config['site_link'];
      echo '/?tag/';
      echo urlencode($tag);
      echo '/">';
      echo $tag;
      echo '</a>';
      echo $item_end;

      if ($i < $tag_count - 1)
        echo $item_gap;
    }
  }
}

function mc_next_post() {
  global $mc_posts, $mc_post_ids, $mc_post_count, $mc_post_i, $mc_post_i_end, $mc_post_id, $mc_post, $mc_page_num, $mc_post_per_page;

  if (!isset($mc_posts))
    return false;

  if (!isset($mc_post_i)) {
    $mc_post_i = 0 + ($mc_page_num - 1) * $mc_post_per_page;
    $mc_post_i_end = $mc_post_i + $mc_post_per_page;
    if ($mc_post_count < $mc_post_i_end)
      $mc_post_i_end = $mc_post_count;
  }

  if ($mc_post_i == $mc_post_i_end)
    return false;

  if (!isset($mc_post_ids[$mc_post_i]))
    return false;

  $mc_post_id = $mc_post_ids[$mc_post_i];
  
  $mc_post = $mc_posts[$mc_post_id];

  $mc_post_i += 1;

  return true;
}

function mc_the_title($print = true) {
  global $mc_post;

  if ($print) {
    echo htmlspecialchars($mc_post['title']);
    return;
  }

  return htmlspecialchars($mc_post['title']);
}

function mc_the_date($print = true) {
  global $mc_post;

  if ($print) {
    echo $mc_post['date'];
    return;
  }

  return $mc_post['date'];
}

function mc_the_time($print = true) {
  global $mc_post;

  if ($print) {
    echo $mc_post['time'];
    return;
  }

  return $mc_post['time'];
}

function mc_the_tags($item_begin='', $item_gap=', ', $item_end='', $as_link = true) {
  global $mc_post, $mc_config;

  $tags = $mc_post['tags'];
  
  $count = count($tags);

  for ($i = 0; $i < $count; $i ++) {
    $tag = htmlspecialchars($tags[$i]);
    
    echo $item_begin;

    if ($as_link) {
      echo '<a href="';
      echo $mc_config['site_link'];
      echo '/?tag/';
      echo urlencode($tag);
      echo '/">#';
    }

    echo $tag;

    if ($as_link) {
      echo '</a>';
    }

    echo $item_end;

    if ($i < $count - 1)
      echo $item_gap;
  }
}

function mc_the_content($print = true) {
  global $mc_data;

  if (!isset($mc_data)) {
    global $mc_post_id;
    $data = unserialize(file_get_contents('mc-files/posts/data/'.$mc_post_id.'.dat')); 
    $html = Markdown($data['content']); 
  }
  else {
    $html = Markdown($mc_data['content']);
  }
  if ($print) {
    echo $html;
    return;
  }
  return $html;
}

function mc_the_excerpt($num) {
    global $mc_data;
	  if (!isset($mc_data)) {
		global $mc_post_id;
		$data = unserialize(file_get_contents('mc-files/posts/data/'.$mc_post_id.'.dat'));
		if( $num <10 || $num == '' ) $num=80;
		echo $html = mb_substr(trim(strip_tags(Markdown($data['content']),'')), 0, $num, 'utf-8') . '...';
	  }
	  return ;
}

function mc_the_thumbnail() {
    global $mc_data;
	  if (!isset($mc_data)) {
		global $mc_post_id;
		$data = unserialize(file_get_contents('mc-files/posts/data/'.$mc_post_id.'.dat'));
		$matches[0]=null;
		if(preg_match('/<img(.*)\/>/iU',trim(strip_tags(Markdown($data['content']),'<img>')),$matches))
			echo $html = $matches[0];
	  }
	  return ;
}

function mc_the_link() {
  global $mc_post_id, $mc_post, $mc_config;

  echo '<a href="';
  mc_the_url();
  echo '">';
  echo htmlspecialchars($mc_post['title']);
  echo '</a>';
}

function mc_the_url($print = true) {
  global $mc_post_id, $mc_post, $mc_config;

  $url = $mc_config['site_link'].'/?post/'.$mc_post_id;

  if ($print) {
    echo $url;
    return;
  }

  return $url;
}

function mc_can_comment() { //是否已开启评论，失效？
  global $mc_post_id, $mc_post;

  return isset($mc_post['can_comment']) ? $mc_post['can_comment'] == '1' : true;
}

function mc_comment_code() {
  global $mc_config;

  return isset($mc_config['comment_code']) ? $mc_config['comment_code'] : '';
}
?>