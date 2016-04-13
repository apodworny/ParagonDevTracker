<?php
require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Scrape me some data</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="forums.php">Official Forums</a></li>
          <li><a href="reddit.php">reddit</a></li>
        </ul>
      </nav>
    </header>
    <?php
      $sql = "INSERT INTO posts (text, url, employee, timePosted)
      VALUES ('Sure is a lot of text here','https://www.example.com/', '[EPIC]Bob', '2010-05-05 10:30:00')";

      #Run the query
      #$mysqli->query($sql);




      $url = "https://www.epicgames.com/paragon/forums/member.php?21-EPIC-arCtiC&tab=activitystream&type=user";

      $reddit1 = "https://www.reddit.com/user/arctyczyn.rss";
      $reddit2 = "https://www.reddit.com/user/raczilla.rss";

      #XPaths
      $postsAndThreadsXPath = '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " activitybit ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="excerpt"]';

      #posts
      $postsEmployeeXPath =   '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="title"]/a[1]';
      $postsTextXPath =       '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="excerpt"]';
      $postsTitleXPath =      '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="title"]/a[2]';
      $postsUrlXPath =        '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="fulllink"]/a/@href';
      $postsDateXPath =       '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="datetime"]/span[@class="date"]';
      $postsTimeXPath =       '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_post ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="datetime"]/span[@class="date"]/span[@class="time"]';

      #threads
      $threadsTextXPath =     '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_thread ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="excerpt"]';
      $threadsUrlXPath =      '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_thread ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="fulllink"]/a/@href';
      $threadsEmployeeXPath = '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_thread ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="title"]/a[1]';
      $threadsDateXPath =     '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_thread ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="datetime"]/span[@class="date"]';
      $threadsTimeXPath =     '//*[@id="activitylist"]/li[contains(concat(" ", normalize-space(@class), " "), " forum_thread ")]/div[contains(concat(" ", normalize-space(@class), " "), " content ")]/div[@class="datetime"]/span[@class="date"]/span[@class="time"]';



      $html = new DOMDocument();
      @$html->loadHTMLFile($url);
      $xml = simplexml_import_dom($html);
      $postsEmployee = $xml->xpath($postsEmployeeXPath);
      $postsText = $xml->xpath($postsTextXPath);
      $postsTitle = $xml->xpath($postsTitleXPath);
      $postsUrl = $xml->xpath($postsUrlXPath);
      $postsDate = $xml->xpath($postsDateXPath);
      $postsTime = $xml->xpath($postsTimeXPath);

      for ($i = 0; $i < count($postsText); $i++)
      {
        echo('<div class="post"><p class="employee"><strong>' . $postsEmployee[$i] . '</strong> replied to <a href="https://www.epicgames.com/paragon/forums/' . $postsUrl[$i] .'" target="_blank">' . $postsTitle[$i] . '</a></p><p>' . $postsText[$i] . '</p><p class="date-time">' . $postsDate[$i] . ' ' . $postsTime[$i] . '</p></div>');
      }



      #var_dump($postsUrl);

      #foreach($fullPost as $post)
      #{
      #  echo("<p>" . (string)$post . "</p>");
      #}



      $mysqli->close();
    ?>
  </body>
</html>
