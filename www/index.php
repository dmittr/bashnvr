<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!doctype html>
<html lang="en">
    <head>
        <base href="<?=$_SERVER['REQUEST_SCHEME'] ?>://<?=$_SERVER['HTTP_HOST'].str_replace("index.php","",$_SERVER['SCRIPT_NAME']) ?>" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
<script type="text/javascript">
setInterval(function(){
  $('img.snapshot').each(function() {
      var jqt = $(this);
      var src = jqt.attr('src');
      src = src.substr(0,src.indexOf('?'));
      src += '?_ts=' + new Date().getTime();
      jqt.attr('src',src);
  })
}, 30000);
</script>

    <body>

<div class="collapse bg-inverse" id="navbarHeader">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 py-4">
        <h4 class="text-white">About</h4>
        <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
      </div>
      <div class="col-sm-4 py-4">
        <h4 class="text-white">Contact</h4>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white">Follow on Twitter</a></li>
          <li><a href="#" class="text-white">Like on Facebook</a></li>
          <li><a href="#" class="text-white">Email me</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="navbar navbar-inverse bg-inverse">
  <div class="container d-flex justify-content-between">
    <a href="#" class="navbar-brand">Album</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</div>

<div class="album text-muted">
  <div class="container">
    <div class="row">
<?php

function getimg($path,$name=''){
  $dirs = array_reverse(glob($path . '/*' , GLOB_ONLYDIR));
  $out="";
  if (!empty($dirs)) {
    if (empty($name)) {
      foreach ($dirs as $dir) {
        $tmp=explode("/",$dir);
        $name=end($tmp);
        $out.=getimg($dir,$name);
      }
    } else {
      $out=getimg($dirs[0],$name);
    }
  } else {
    $files=array_reverse(glob($path . '/*.gif'));
    if (!empty($files)) {
      if (empty($name)){
        foreach ($files as $file) {
          $video=str_replace(".gif","",$file);
          $video_name=str_replace($path."/","",str_replace(".gif","",$file));
          $out.='<div class="card"><a href="'.$video.'"><img src="'.$file.'" alt="VideoGIF" width=320><p class="card-text">'.$video_name.'</p></div>';
        }
      } else {
        $out='<div class="card"><a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/'.$name.'"><img src="'.$files[0].'" alt="VideoGIF" width=320><p class="card-text">'.$name.'</p></div>';
      }
    }
  }
  return $out;
}

if (isset($_GET['q']) && (!empty($_GET['q']))) {
  echo getimg('store/'.$_GET['q']);
} else {
  $files=glob('last/*.png');
  foreach ($files as $file){
    $name=str_replace(".png","",str_replace("last/","",$file));
    echo '<div class="card"><a href="'.$name.'"><img class="snapshot" src="'.$file.'?0" alt="Last snap" width=320><p class="card-text">'.$name.'</p></div>';
  }
}

?>
    </div>

  </div>
</div>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
  </div>
</footer>

    </body>
</html>
