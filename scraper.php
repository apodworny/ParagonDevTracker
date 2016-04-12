<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Scrape me some data</title>
    <link rel="stylesheet" href="public/css/main.css">
  </head>
  <body>
    <?php

      $url = "https://www.epicgames.com/paragon/forums/member.php?21-EPIC-arCtiC&tab=activitystream&type=user";
      $xpath = '//*[@id="activitylist"]/li[@class="activitybit forum_post"]/div[@class="content hasavatar"]/div[@class="excerpt"]';

      $html = new DOMDocument();
      @$html->loadHTMLFile($url);
      $xml = simplexml_import_dom($html);
      $fullPost = $xml->xpath($xpath);

      foreach($fullPost as $post)
      {

        echo("<p>" . (string)$post . "</p>");
      }

    ?>
  </body>
</html>
