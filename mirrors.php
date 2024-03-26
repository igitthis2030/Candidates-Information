<?php
// $Id$
$_SERVER['BASE_PAGE'] = 'mirrors.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/include/prepend.inc';

// If Beta, load the new beta mirrors page.
if(myphpnet_beta()) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/include/layout.inc';
    print_view('mirrors/main.php');
    exit;
}


include_once $_SERVER['DOCUMENT_ROOT'] . '/include/mirrortable.inc';
site_header("Mirror Sites", array("current" => "community"));
?>

<h1>Mirror Sites</h1>

<p>
 Listed below are the official, active, and fully functional PHP.net mirrors.
 Some mirrors might be missing from this list because mirrors are
 automatically deactivated when problems arise.  Mirrors are continuously
 checked and reactivated when appropriate.
</p>
<p>
 We suggest you <a href="my.php">choose</a> a PHP.net mirror that is
 geographically close to you. All mirrors provide identical features and
 services, with the only difference being the increased speed that close
 mirrors provide. Your current mirror is highlighted in the list below.
</p>
<p>
 If you are interested in hosting a mirror of this site,
 <a href="/mirroring.php">read our mirroring page</a>.
</p>

<?php
mirror_list();
site_footer();
