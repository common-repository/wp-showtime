<form action="" method="get">
Город или индекс: &nbsp;
<input type="text" name="location" value="<?php echo $_GET["location"]; ?>" />  
<input type="submit" value="Показать" />  

</form>

<?php
function russian_date() {
   $translation = array(
      "am" => "дп",
      "pm" => "пп",
      "AM" => "ДП",
      "PM" => "ПП",
      "Monday" => "Понедельник",
      "Mon" => "Пн",
      "Tuesday" => "Вторник",
      "Tue" => "Вт",
      "Wednesday" => "Среда",
      "Wed" => "Ср",
      "Thursday" => "Четверг",
      "Thu" => "Чт",
      "Friday" => "Пятница",
      "Fri" => "Пт",
      "Saturday" => "Суббота",
      "Sat" => "Сб",
      "Sunday" => "Воскресенье",
      "Sun" => "Вс",
      "January" => "Января",
      "Jan" => "Янв",
      "February" => "Февраля",
      "Feb" => "Фев",
      "March" => "Марта",
      "Mar" => "Мар",
      "April" => "Апреля",
      "Apr" => "Апр",
      "May" => "Мая",
      "May" => "Мая",
      "June" => "Июня",
      "Jun" => "Июн",
      "July" => "Июля",
      "Jul" => "Июл",
      "August" => "Августа",
      "Aug" => "Авг",
      "September" => "Сентября",
      "Sep" => "Сен",
      "October" => "Октября",
      "Oct" => "Окт",
      "November" => "Ноября",
      "Nov" => "Ноя",
      "December" => "Декабря",
      "Dec" => "Дек",
      "st" => "ое",
      "nd" => "ое",
      "rd" => "е",
      "th" => "ое",
      );
   if (func_num_args() > 1) {
      $timestamp = func_get_arg(1);
      return strtr(date(func_get_arg(0), $timestamp), $translation);
   } else {
      return strtr(date(func_get_arg(0)), $translation);
   };
}
?>

<?php
$mayday = date("Y-m-d");
?>

<?php $rasp = $_GET["location"]; ?>
        <?php if(!empty($rasp)) { ?>
<a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=0"; ?>">Сегодня</a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=1"; ?>">Завтра</a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=2"; ?>"><?php echo russian_date("l, j F",strtotime($mayday)+60*60*24*2); ?></a> | <a href="<?php echo preg_replace("/&date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."&date=3"; ?>"><?php echo russian_date("l, j F",strtotime($mayday)+60*60*24*3); ?></a>
        <?php }  
else { ?>
<a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=0"; ?>">Сегодня</a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=1"; ?>">Завтра</a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=2"; ?>"><?php echo russian_date("l, j F",strtotime($mayday)+60*60*24*2); ?></a> | <a href="<?php echo preg_replace("/?date=(0|1|2|3)/", "", $_SERVER['REQUEST_URI'])."?date=3"; ?>"><?php echo russian_date("l, j F",strtotime($mayday)+60*60*24*3); ?></a>
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
<? $html->load_file('http://www.google.com/movies?mid=&hl=ru&near='.$cit.'&date='.$dat); ?>
        <?php }  
else { ?>
<? $html->load_file('http://www.google.com/movies?mid=&hl=ru&near='.$showcit.'&date='.$dat); ?>
        <?php } ?>


<?
foreach($html->find('#movie_results .theater') as $div) {
    // print theater and address info
    ?>
    <div class="theater">
<div> 
<h3>Кинотеатр: <?php echo iconv('Windows-1251', 'UTF-8', $div->find('h2',0)->plaintext); ?></h3>
<p>Адрес и телефон: <?php echo iconv('Windows-1251', 'UTF-8', $div->find('.info',0)->innertext); ?></p></div>
<?php

    // print all the movies with showtimes
    foreach($div->find('.movie') as $movie) {
    ?><div class="kino">
       <p><b>Фильм: <a href="http://www.google.com/search?hl=ru&source=hp&q=<?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.name a',0)->innertext); ?>+site%3Akinopoisk.ru&btnI=I%27m+Feeling+Lucky" target="_blank"><?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.name a',0)->innertext); ?></a></b></p>
       <p>Информация: <?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.info',0)->plaintext); ?></p>
       <p>Сеансы: <?php echo iconv('Windows-1251', 'UTF-8', $movie->find('.times',0)->plaintext); ?></p>
       <br></div>
        <?php
    }
    print "</div>";
}
print '<div align="center" style="font-size:11px">Работает на <a href="http://tsepelev.ru/wp-showtime">WP Showtime</a></div>';
// clean up memory
$html->clear();


?>