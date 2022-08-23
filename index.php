<html>
  <head>
    <title>
      Kiana 1.0
    </title>
  </head>

  <style type="text/css">
    body{
      background-color:#111;
      font-family: Courier;
    }

    a{
      color:#00FF00;
      text-decoration: none;
    }
  </style>

  <div align='center'>
    <table width='80%'>
      <tr>
        <td>
          <br><br><br><br>
          <table width='100%'>
            <tr>
              <td>
                <img src='img/logo_1.png'>
                <br>
              </td>
              <td>
                <div style='padding-left: 5%; color: #EEE;'>      
                  <i><b>Kiana</b></i> is a compilation of electronic music under Creative Commons License.
                  Anyone is legally free to download and share the contents of Kiana collection for personal use.
                  <br><br>        
                  <a href='http://t.me/kianamusicapp' target='_blank'>Telegram</a>
                  <a href='https://kiana-music.blogspot.com'>Blogger</a>
                  <a href='' OnClick="alert('@KianaMusics');">TikTok</a>
                  <a href='https://facebook.com/groups/765188451390796' target='_blank'>Facebook</a>
                  <a href='https://www.youtube.com/channel/UCKrukUvgGpWqNDRJFPfmpjA' target='_blank'>Youtube</a>
                  <a href='http://kiana.rf.gd' target='_blank'>Site01</a>
                  <a href='https://kianamusic.000webhostapp.com' target='_blank'>Site02</a>
                  <a href='http://kiana.atwebpages.com/' target='_blank'>Site03</a>
                  <a href='https://kianas.neocities.org/' target='_blank'>Neocities</a>
                  <a href='https://rumble.com/user/KianaMusic' target='_blank'>Rumble</a>
                  <a href='PHP/index.php' target='_blank'>Search</a>
                  <a href='kiana1.0.zip' target='_blank'>Sourcecode</a>
                </div>         
              </td>
            </tr>
          </table>	
          <br><br><br><br>

          <div style='letter-spacing: 3px; color: #EEE;'>TRACKLIST</div>
          <br><br>
          <div style='color:#00FF00;'>

<?php

foreach(glob('music/*')as$music){

  $music_get_name = explode('/', $music);

  $music_name = $music_get_name[1];

  $music_get_num = explode('.', $music_name);

  $music_num = $music_get_num[0];

  $item[$music_num] = "<br><a href='$music' target='_blank'>$music_name</a><br><br><hr></hr>";
}

for($i=1; $i < 26; $i++){

  echo $item[$i];

}

?>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div align='center'><img src='img/slogan_1.png'></div>
  <br>
  <div align='center'>
    <a href='#' OnClick="alert('1PERdhYj1JcLjJBxJ3XvyacuXjYGNHX3PG');"><img src='img/foot_1.gif'></a>
    <a href='#' OnClick="alert('0x265c5f1c2a2771A164956e95Bd03C524eAE13759');"><img src='img/foot_2.gif'></a>
    <a href='https://www.paypal.com/donate/?hosted_button_id=PUEFNPP2GVGD6' target='_blank'><img src='img/foot_3.gif'></a>
    <a href='#' OnClick="alert('aerae4@gmail.com');"><img src='img/foot_4.gif'></a>
    <a href='#' OnClick="alert('');"><img src='img/foot_5.gif'></a>
  </div>