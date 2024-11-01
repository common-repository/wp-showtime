<form action="" method="get">
City or post code: &nbsp;
<input type="text" name="location" value="<?php echo $_GET["location"]; ?>" />  
<input type="submit" value="Show!" />  

</form>


<?php
$mayday = date("Y-m-d");
?>

<?php $rasp = $_GET["location"]; ?>
        <?php if(!empty($rasp)) { ?>
<a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=0"; ?>">Today</a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=1"; ?>">Tomorrow</a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=2"; ?>"><?php echo date("l, j F",strtotime($mayday)+60*60*24*2); ?></a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=3"; ?>"><?php echo date("l, j F",strtotime($mayday)+60*60*24*3); ?></a>
        <?php }  
else { ?>
<a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=0"; ?>">Today</a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=1"; ?>">Tomorrow</a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=2"; ?>"><?php echo date("l, j F",strtotime($mayday)+60*60*24*2); ?></a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=3"; ?>"><?php echo date("l, j F",strtotime($mayday)+60*60*24*3); ?></a>
        <?php } ?>


<?php

$cit = $_GET["location"];
$dat = $_GET["date"];
$showcit = get_option('showtime_city');
require_once('simple_html_dom.php');

$html = new simple_html_dom();
?>

<?php $gorod = $_GET["location"]; ?>
        <?php if(!empty($gorod)) { ?>
<? $html->load_file('http://www.google.com/movies?mid=&hl=en&near='.$cit.'&date='.$dat); ?>
        <?php }  
else { ?>
<? $html->load_file('http://www.google.com/movies?mid=&hl=en&near='.$showcit.'&date='.$dat); ?>
        <?php } ?>


<?
foreach($html->find('#movie_results .theater') as $div) {
    // print theater and address info
    ?>
    <div class="theater">
<div> 
<h3>Cinema: <?php echo iconv('Windows-1251', 'UTF-8', $div->find('h2',0)->plaintext); ?></h3>
<p>Address and telephone number: <?php echo iconv('Windows-1251', 'UTF-8', $div->find('.info',0)->innertext); ?></p></div>
<?php

    // print all the movies with showtimes
    foreach($div->find('.movie') as $movie) {
    ?><div class="kino">
       <p><b>Movie: <a href="http://www.google.com/search?hl=en&source=hp&q=<?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.name a',0)->innertext); ?>+site%3Aimdb.com&btnI=I%27m+Feeling+Lucky" target="_blank"><?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.name a',0)->innertext); ?></a></b></p>
       <p>Info: <?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.info',0)->plaintext); ?></p>
       <p>Showtimes: <?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.times',0)->plaintext); ?></p>
       <br></div>
        <?php
    }
    print "</div>";
}
print '<div align="center" style="font-size:11px">Powered by <a href="http://tsepelev.ru/wp-showtime">WP Showtime</a></div>';
// clean up memory
$html->clear();


?>