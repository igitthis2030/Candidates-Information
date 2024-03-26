<?php // vim: et fdm=marker
/*
 * No. You did not find a security hole.
 * This is an open source website.
 */

// Modified headers {{{
// Get the modification date of this PHP file
$timestamps = array(@getlastmod());

/*
   The date of prepend.inc represents the age of ALL
   included files. Please touch it if you modify any
   other include file (and the modification affects
   the display of the index page). The cost of stat'ing
   them all is prohibitive. Also note the file path,
   we aren't using the include path here.
*/
$timestamps[] = @filemtime("include/prepend.inc");

// Calendar, conference teasers & latest releaes box are the only "dynamic" features on this page
$timestamps[] = @filemtime("include/pregen-events.inc");
$timestamps[] = @filemtime("include/pregen-confs.inc");
$timestamps[] = @filemtime("include/pregen-news.inc");
$timestamps[] = @filemtime("include/version.inc");

// The latest of these modification dates is our real Last-Modified date
$timestamp = max($timestamps);

// Note that this is not a RFC 822 date (the tz is always GMT)
$tsstring = gmdate("D, d M Y H:i:s ", $timestamp) . "GMT";

// Check if the client has the same page cached
if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"]) &&
    ($_SERVER["HTTP_IF_MODIFIED_SINCE"] == $tsstring)) {
    header("HTTP/1.1 304 Not Modified");
    exit();
}
// Inform the user agent what is our last modification date
else {
    header("Last-Modified: " . $tsstring);
}
// }}}

$_SERVER['BASE_PAGE'] = 'index.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/prepend.inc';
include $_SERVER['DOCUMENT_ROOT'] . '/include/pregen-events.inc';
include $_SERVER['DOCUMENT_ROOT'] . '/include/pregen-confs.inc';
include $_SERVER['DOCUMENT_ROOT'] . '/include/pregen-news.inc';
include $_SERVER['DOCUMENT_ROOT'] . '/include/version.inc';

// Generate conference teaser {{{
if (is_array($CONF_TEASER) && count($CONF_TEASER)) {
    $categories = array("conference" => "Upcoming conferences", "cfp" => "Calling for papers");
    $teaser = '  <li id="news-line"><span class="corners-top"><span></span></span><ul>' . "\n";
    foreach($CONF_TEASER as $k => $a) {
        if (is_array($a) && count($a)) {
            $teaser .= "      <li><span>" . $categories[$k] . "</span>\n";
            $teaser .= "      <ul>";
            $count = 0;
            $a = preg_replace("'([A-Za-z0-9])([\s\:\-\,]*?)call for(.*?)$'i", "$1", $a);
            foreach($a as $url => $title) {
                if ($count++ >= 4) {
                    break;
                }
                $teaser .= '       <li class="first last"><a href="' . $url. '">' . $title. '</a></li>' . "\n";
            }
            $teaser .= "      </ul>\n     </li>\n";
        } // if set
    }
    $teaser .= '   </ul><span class="corners-bottom"><span></span></span></li><!-- #news-line -->'."\n";
    $PRE_DATA = $teaser;
} // }}}

// Write out common header {{{
site_header("Hypertext Preprocessor",
    array(
        'onload' => 'boldEvents();',
        'headtags' => '<link rel="alternate" type="application/atom+xml" title="PHP: Hypertext Preprocessor" href="' . $MYSITE . 'feed.atom" />',
        'link' => array(
            array(
                "rel"   => "search",
                "type"  => "application/opensearchdescription+xml",
                "href"  => $MYSITE . "phpnetimprovedsearch.src",
                "title" => "Add PHP.net search"
            ),
            array(
                "rel"   => "alternate",
                "type"  => "application/atom+xml",
                "href"  => $MYSITE . "releases.atom",
                "title" => "PHP Release feed"
            ),

        ),
    )
);
// }}}

// {{{ Left sidebar ("What is PHP" & "Thanks to")

column_box(COLUMN_LEFT);
?>

<h3>What is PHP?</h3>
<p>
 <acronym title="recursive acronym for PHP: Hypertext Preprocessor">PHP</acronym>
 is a widely-used general-purpose scripting language that is
 especially suited for Web development and can be embedded into HTML.
 If you are new to PHP and want to get some idea
 of how it works, try the <a href="/tut.php">introductory tutorial</a>.
 After that, check out the online <a href="/docs.php">manual</a>,
 and the example archive sites and some of the other resources
 available in the <a href="/links.php">links section</a>.
</p>
<?php echo $END_BLOCK_INFO, $START_BLOCK_INFO; ?>

<h3><a href="/thanks.php">Thanks To</a></h3>
<ul class="simple">
 <li><a href="http://www.easydns.com/?V=698570efeb62a6e2" title="DNS Hosting provided by easyDNS">easyDNS</a></li>
 <li><a href="http://www.directi.com/">Directi</a></li>
 <li><a href="http://promote.pair.com/direct.pl?php.net">pair Networks</a></li>
 <li><a href="http://www.servercentral.net/">Server Central</a></li>
 <li><a href="http://www.hostedsolutions.com/">Hosted Solutions</a></li>
 <li><a href="http://www.spry.com/">Spry VPS Hosting</a></li>
 <li><a href="http://ez.no/">eZ Systems</a> / <a href="http://www.hit.no/english">HiT</a></li>
 <li><a href="http://www.osuosl.org">OSU Open Source Lab</a></li>
 <li><a href="http://www.yahoo.com/">Yahoo! Inc.</a></li>
 <li><a href="http://www.binarysec.com/">BinarySEC</a></li>
 <li><a href="http://www.nexcess.net/">NEXCESS.NET</a></li>
 <li><a href="http://www.rackspace.com/">Rackspace</a></li>
 <li><a href="http://www.eukhost.com/">EUKhost</a></li>
</ul>

<h3>Syndication</h3>
<p>
 You can grab our news as an <a href="/feed.atom">Atom feed</a>.
</p>

<?php
column_box();

// }}}

// {{{ News (include/pregen-news.inc)
column(COLUMN_MIDDLE);

// $NEWS_ENTRIES is generated on master (scripts/pregen_news) from archive/*.xml
print_news($NEWS_ENTRIES, "frontpage");
echo '<p class="t-center"><a href="/archive/index.php"><strong>News Archive</strong></a></p>';

column();
// }}}

// Right column (releases/events..) {{{
column_box(COLUMN_RIGHT, true, array("classes" => array("block" => array("releases"))));

$MIRROR_IMAGE = '';

// Try to find a sponsor image in case this is an official mirror {{{
if (is_official_mirror()) {

    // Iterate through possible mirror provider logo types in priority order
    $types = array("gif", "jpg", "png");
    while (list(,$ext) = each($types)) {

        // Check if file exists for this type
        if (file_exists("backend/mirror." . $ext)) {

            // Add text to rigth sidebar
            $MIRROR_IMAGE = "<div align=\"center\"><h3>This mirror sponsored by:</h3>\n";

            // Create image HTML code
            $img = make_image(
                'mirror.' . $ext,
                htmlspecialchars(mirror_provider()),
                FALSE,
                FALSE,
                'backend',
                0
            );

            // Add size information depending on mirror type
            if (is_primary_site() || is_backup_primary()) {
                $img = resize_image($img, 125, 125);
            } else {
                $img = resize_image($img, 120, 60);
            }

            // End mirror specific part
            $MIRROR_IMAGE .= '<a href="' . mirror_provider_url() . '">' .
                             $img . "</a></div><br /><hr />\n";

            // We have found an image
            break;
        }
    }
} // }}}

// {{{ Generate latest release info
list($PHP_5_STABLE, ) = each($RELEASES[5]);
$PHP_5_RC = null;

/* Do we have any release candidates to brag about? */
if (count($RELEASES[5])>1) {
    list($PHP_5_RC, ) = each($RELEASES[5]);
}

?>

        <h3>Stable releases</h3>
        <p class="first">Current PHP 5 Stable: <a href="/ChangeLog-5.php#<?php echo $PHP_5_STABLE ?>"><strong><?php echo $PHP_5_STABLE ?></strong></a></p>
        <p class="download-button"><a href="/downloads.php#v5"><span>Download</span></a></p>
        <p class="top-border">Historical PHP Stable: <a href="/downloads.php#v4"><strong>4.4.9</strong></a></p>
<?php
if ($PHP_5_RC):
?>
        <h4>Release Candidates</h4>
        <p class="top-border"><a href="http://qa.php.net/"><?php echo $PHP_5_RC ?></a></p>
<?php
endif;
?>
        <p><a href="/downloads.php"><strong>Download area &raquo;</strong></a></p>
        <?php echo $END_BLOCK_INFO ?>
<?php
/* }}} */

// Generate the event box {{{
?>
      <?php echo $START_BLOCK_INFO ?>
       <h3 class="upcoming-events">Upcoming Events</h3>
       <div class="calendar">
        <span class="corners-top"><span></span></span>
        <h4>Events Calendar</h4>
        <form method="get" action="/cal.php">
         <p>
          <select class="month" name="cm">
<?php
$months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$current = date("m", $_SERVER["REQUEST_TIME"]);
foreach($months as $n => $month) {
  echo "<option value='$n' ". ($n == $current ? 'selected="selected"' : '') .">$month</option>\n";
}
?>
          </select>
          <span><input type="submit" class="button" value="View" /></span>
         </p>
        </form>
        <span class="corners-bottom"><span></span></span>
       </div><!-- .calendar -->
       <p class="add-event"><a href="/submit-event.php"><strong>Add event &raquo;</strong></a></p>
       <div class="events">
        <?php echo $EVENTS_DATA ?>
       </div>
<?php
// }}}

column_box();
// }}}


site_footer(
    array("atom" => "/feed.atom") // Add a link to the feed at the bottom
);

