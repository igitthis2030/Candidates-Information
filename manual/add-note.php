<?php
// $Id$

$ip_spam_lookup_url = 'http://www.dnsbl.info/dnsbl-database-check.php?IP=';

$_SERVER['BASE_PAGE'] = 'manual/add-note.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/include/prepend.inc';
include_once $_SERVER['DOCUMENT_ROOT'] . '/include/posttohost.inc';
include_once $_SERVER['DOCUMENT_ROOT'] . '/include/shared-manual.inc';
include      $_SERVER['DOCUMENT_ROOT'] . '/manual/spam_challenge.php';

site_header("Add Manual Note");

// Copy over "sect" and "redirect" from GET to POST
if (empty($_POST['sect']) && isset($_GET['sect'])) {
    $_POST['sect'] = $_GET['sect'];
}
if (empty($_POST['redirect']) && isset($_GET['redirect'])) {
    $_POST['redirect'] = $_GET['redirect'];
}

// Decide on whether all vars are present for processing 
$process = TRUE;
$needed_vars = array('note', 'user', 'sect', 'redirect', 'action', 'func', 'arga', 'argb', 'answer');
foreach ($needed_vars as $varname) {
    if (empty($_POST[$varname])) {
        $process = FALSE;
        break;
    }
}

// We have a submitted form to process
if ($process) {

    // Clean off leading and trailing whitespace 
    $user = trim($_POST['user']);
    $note = trim($_POST['note']);
    
    // Convert all line-endings to unix format,
    // and don't allow out-of-control blank lines
    $note = str_replace("\r\n", "\n", $note);
    $note = str_replace("\r", "\n", $note);
    $note = preg_replace("/\n{2,}/", "\n\n", $note);
    
    // Don't pass through example username
    if ($user == "user@example.com") {
        $user = "Anonymous";
    }
    
    // We don't know of any error now
    $error = FALSE;

    // No note specified
    if (strlen($note) == 0) {
        $error = "You have not specified the note text.";
    }

    // SPAM challenge failed
    elseif (!test_answer($_POST['func'], $_POST['arga'], $_POST['argb'], $_POST['answer'])) {
        $error = 'SPAM challenge failed.';
    }

    // The user name contains a malicious character
    elseif (stristr($user, "|")) {
        $error = "You have included bad characters within your username. We appreciate you may want to obfuscate your email further, but we have a system in place to do this for you.";
    }

    // Check if the note is too long
    elseif (strlen($note) >= 4096) {
        $error = "Your note is too long. You'll have to make it shorter before you can post it. Keep in mind that this is not the place for long code examples!";
    }

    // Check if the note is not too short
    elseif (strlen($note) < 32) {
        $error = "Your note is too short. Trying to test the notes system? Save us the trouble of deleting your test, and don't. It works.";
    }

    // Chek if any line is too long
    else {
    
        // Split the note by whitespace, and check length
        foreach (preg_split("/\\s+/", $note) as $chunk) {
            if (strlen($chunk) > 120) {
                $error = "Your note contains a bit of text that will result in a line that is too long, even after using wordwrap().";
                break;
            }
        }
    }

    // No error was found, and the submit action is required
    if (!$error && strtolower($_POST['action']) != "preview") {

        $redirip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ?
                   $_SERVER['HTTP_X_FORWARDED_FOR'] :
                   (isset($_SERVER['HTTP_VIA']) ? $_SERVER['HTTP_VIA'] : '');

        // Post the variables to the central user note script
        // ($MQ is defined in prepend.inc)
        $result = posttohost(
            "http://master.php.net/entry/user-note.php",
            array(
                'user'    => ($MQ ? stripslashes($user) : $user),
                'note'    => ($MQ ? stripslashes($note) : $note),
                'sect'    => ($MQ ? stripslashes($_POST['sect']) : $_POST['sect']),
                'ip'      => $_SERVER['REMOTE_ADDR'],
                'redirip' => $redirip
            )
        );

        // If there is any non-header result, then it is an error
        if ($result) {
            if (strpos($result, '[TOO MANY NOTES]') !== FALSE) {
                print "<p class=\"formerror\">As a security precaution, we only allow a certain number of notes to be submitted per minute. At this time, this number has been exceeded. Please re-submit your note in about a minute.</p>";
            } else if (($pos = strpos($result, '[SPAMMER]')) !== FALSE) {
                $ip       = trim(substr($result, $pos+9));
                $spam_url = $ip_spam_lookup_url . $ip;
                print '<p class="formerror">Your IP is listed in one of the spammers lists we use, which aren\'t controlled by us. More information is available at <a href="'.$spam_url.'">'.$spam_url.'</a>.</p>';
            } else if (strpos($result, '[SPAM WORD]') !== FALSE) {
                echo '<p class="formerror">Your note contains a prohibited (usually SPAM) word. Please remove it and try again.</p>';
            } else if (strpos($result, '[CLOSED]') !== FALSE) {
                echo '<p class="formerror">Due to some technical problems this service isn\'t currently working. Please try again later. Sorry for any inconvenience.</p>';
            } else {
                echo "<!-- $result -->";
                echo "<p class=\"formerror\">There was an internal error processing your submission. Please try to submit again later.</p>";
            }
        }

        // There was no error returned
        else { 
            echo '<p>Your submission was successful -- thanks for contributing! Note ',
                 'that it will not show up for up to a few hours on some of the <a ',
                 'href="/mirrors.php">mirrors</a>, but it will find its way to all of ',
                 'our mirrors in due time.</p>';
        }
        
        // Print out common footer, and end page
        site_footer();
        exit();
    }
    
    // There was an error, or a preview is needed
    else {

        // If there was an error, print out
        if ($error) { echo "<p class=\"formerror\">$error</p>\n"; }
        
        // Print out preview of note
        echo '<p>This is what your entry will look like, roughly:</p>';
        echo '<div id="usernotes">';
        manual_note_display(time(), ($MQ ? stripslashes($user) : $user), ($MQ ? stripslashes($note) : $note), FALSE);
        echo '</div><br /><br />';
    }
}

// Any needed variable was missing => display instructions
else { 
?>
<p>
 <center>
  <h2>Pay Attention Now!</h2>
  <img src="http://imgs.xkcd.com/comics/freedom.png" title="This is how we feel sometimes when obvious violations take place here!"/><br/>
  <b>NOTE:</b> Due to the overwhelming lack of folks who seem to notice
  that there are guidelines for what should <i>not</i> be posted here,
  resulting in the need for us to moderate thousands of submissions,
  consider this our form of grabbing your attention.  BEFORE YOU POST,
  <a href="#whatnottoenter">READ THIS SECTION</a>, PLEASE!
 </center>
</p>

<h3>Welcome to the PHP Manual user note system</h3>
<p>
 You may contribute notes to the PHP manual by adding comments in the
 form below, and, optionally your email address and/or name. And the
 note will appear under the documentation as a part of the manual after
 about an hour.
</p>

<h3>How to enter information</h3>
<p>
 There is no need to obfuscate your email address, as we have a simple
 conversion in place to convert the @ signs and dots in your address. You
 may still want to include a part in the email address only understandable
 by humans, to make it spam protected, as our conversion can be performed
 the other way too. You may submit your email address as
 <tt>user@NOSPAM.example.com</tt> for example (which will be displayed
 as <tt>user at NOSPAM dot example dot com</tt>. Although note that we can
 only inform you of the removal of your note, if you use your real email
 address.
</p>
<p>
 Note that HTML tags are not allowed in the posts, but the note formatting
 is preserved. URLs will be turned into clickable links, PHP code blocks
 enclosed in the PHP tags &lt;?php and ?&gt; will
 be source highlighted automatically. So always enclose PHP snippets in
 these tags. <em>(Double-check that your note appears
 as you want during the preview. That's why it is there!)</em>
</p>
<p>
 The SPAM challenge requires numbers to written out in English, so, an appropriate
 answer may be <em>nine</em> but not <em>9</em>.
</p>

<a name="whatnottoenter"><h3>What not to enter</h3></a>
<p>
 User notes may be edited or deleted, and usually a note is deleted 
 because of the following reasons:
</p>
<ul>
 <li>
  <strong>Bugs</strong>. Instead
  <a href="http://bugs.php.net/report.php?bug_type=Documentation+problem<?php echo isset($_POST['sect']) ? '&amp;manpage=' . clean($_POST['sect']) : ''; ?>">report a bug</a>
  for this manual page to the bug database.
 </li>
 <li>
  <strong>Missing documentation</strong>. Also, report that as a bug.
 </li>
 <li>
  <strong>Support questions</strong>. See the <a href="/support.php">support page</a>
  for available options. In other words, do not ask questions within the user notes.
 </li>
 <li>
  <strong>References to other notes or authors</strong>.  This is not a forum, so we
  neither encourage nor permit discussions here.  Further, if a note is referenced
  directly, and that note is later removed or modified, it can cause confusion.
 </li>
 <li>
  <strong>Code collaboration or improvements</strong>. This is not to suggest that
  your code modification is not good, perhaps even great, but this just isn't the
  place to show it off.  We don't even accept all original code submissions.  Your
  best bet is to publish it on your blog or via another medium.
 </li>
 <li>
  <strong>Links to your website, blog, code, or a third-party website</strong>. We do,
  on occasion, permit the posting of famous websites (such as faqs.org or the MySQL
  manual), but links to other sites, no matter how well-intended, will likely be removed.
 </li>
 <li>
  <strong>Complaints that your notes keep getting deleted</strong>. Sometimes the content
  of your note may be fine, but we might just hate your face for no good reason. (More
  likely, though, you didn't bother to read this page, and you violated one of these
  rules.)
 </li>
 <li>
  <strong>Notes in languages other than English</strong>. 不 gach duine понимает
  el lenguaje जिसमें Sie sprechen.
 </li>
 <li>
  <strong>SPAM</strong>. This should go without saying, but apparently some folks
  out there just don't get it.
 </li>
 <li>
  <strong>Your disdain for PHP and/or its maintainers</strong>. Go learn FORTRAN instead.
 </li>
</ul>

<h3>Additional information</h3>
<p>
 Please note that periodically the developers go through the notes and
 may incorporate information from them into the documentation. This means
 that any note submitted here becomes the property of the PHP Documentation
 Group and will be available under the <a href="/license/index.php#doc-lic">same license</a> as the documentation.
</p>
<p>
 Your IP Address will be logged with the submitted note and made public on the
 PHP manual user notes mailing list. The IP address is logged as part of the
 notes moderation process, and won't be shown within the PHP manual itself.
</p>
<?php
}

// If the user name was not specified, provide a default
if (empty($_POST['user'])) { $_POST['user'] = "user@example.com"; }

// There is no section to add note to
if (!isset($_POST['sect']) || !isset($_POST['redirect'])) {
    echo '<p class="formerror">To add a note, you must click on the "Add Note" button (the plus sign)  ',
         'on the bottom of a manual page so we know where to add the note!</p>';
}

// Everything is in place, so we can display the form
else {?>
<form method="post" action="/manual/add-note.php">
 <p>
  <input type="hidden" name="sect" value="<?php echo clean($_POST['sect']); ?>" />
  <input type="hidden" name="redirect" value="<?php echo clean($_POST['redirect']); ?>" />
 </p>
 <table border="0" cellpadding="3" class="standard">
  <tr>
   <td colspan="2">
    <b>
     <a href="/support.php">Click here to go to the support pages.</a><br />
     <a href="http://bugs.php.net/report.php?bug_type=Documentation+problem&amp;manpage=<?php echo clean($_POST['sect']); ?>">Click here to submit a bug report.</a><br />
     <a href="http://bugs.php.net/report.php?bug_type=Documentation+problem&amp;manpage=<?php echo clean($_POST['sect']); ?>">Click here to request a feature.</a><br />
     (Again, please note, if you ask a question, report a bug, or request a feature,
     your note <i>will be deleted</i>.)
    </b>
   </td>
  </tr>
  <tr>
   <th class="subr">Your email address (or name):</th>
   <td><input type="text" name="user" size="60" maxlength="40" value="<?php echo clean($_POST['user']); ?>" /></td>
  </tr>
  <tr>
   <th class="subr">Your notes:</th>
   <td><textarea name="note" rows="20" cols="60" wrap="virtual"><?php if (isset($_POST['note'])) { echo clean($_POST['note']); } ?></textarea>
   <br />
  </td>
  </tr>
  <tr>
   <th class="subr">Answer to this simple question (SPAM challenge):<br />
   <?php $c = gen_challenge(); echo $c[3]; ?>?</th>
   <td><input type="text" name="answer" size="60" maxlength="10" /> (Example: nine)</td>
  </td>
  </tr>
  <tr>
   <th colspan="2">
    <input type="hidden" name="func" value="<?php echo $c[0]; ?>" />
    <input type="hidden" name="arga" value="<?php echo $c[1]; ?>" />
    <input type="hidden" name="argb" value="<?php echo $c[2]; ?>" />
    <input type="submit" name="action" value="Preview" />
    <input type="submit" name="action" value="Add Note" />
   </th>
  </tr>
 </table>
</form>
<?php
}

// Print out common footer
site_footer();
?>
