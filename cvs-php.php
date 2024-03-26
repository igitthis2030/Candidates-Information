<?php
require_once 'prepend.inc';
commonHeader("Using CVS for PHP Development");
?>

<h1>
Using CVS for PHP Development
</h1>

<?php if(empty($fullname)){ ?>
<p>
All PHP development is done through a distributed revision control system called
CVS.  This helps us track changes and it makes it possible for people located
in all corners of the world to collaborate on a project without having to worry
about stepping on each others' toes.
</p>
<p>
Please note that you do <b>not</b> need a CVS account to <b>access</b> the CVS tree.  See
<a href="http://cvs.php.net">cvs.php.net</a> for details.  You only need your
own CVS account if you will be regularly committing things to the CVS tree.
</p>
<p>
And once again since people just don't seem to understand this point:
</p>
<p>
<table>
<tr><td><b>Does <u>Not</u> Require CVS Account</b></td>	<td>&nbsp;</td><td><b>Requires CVS Account</b></td></tr>
<tr><td>Learning PHP</td>								<td>&nbsp;</td><td>Coding PHP source in C</td></tr>
<tr><td>Coding in PHP</td>								<td>&nbsp;</td><td>Creating approved modules in the PHP tree</td></tr>
<tr><td>Reading PHP source</td>							<td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>Learning coding PHP source in C</td>			<td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>Using PHP modules</td>							<td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>Creating experimental PHP modules</td>			<td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>One-time patch contributions</td>				<td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>Adding notes to documentation</td>				<td>&nbsp;</td><td>Authoring PHP documentation</td></tr>
<tr><td>Writing web pages with PHP</td>					<td>&nbsp;</td><td>Authoring www.php.net web pages</td></tr>
</table>
</p>

<p>
If you are contributing a patch, a small fix, or another minor change you
are not required to obtain a CVS account before submitting it. If you are subscribed
to <a href="mailto: php-dev@lists.php.net">php-dev@lists.php.net</a>,
you can simply post your patch and request for it to be added to PHP. Submitting
patches to the PHP-dev list <b>before</b> requesting full CVS access is
suggested, so the PHP development team can develop a working relationship
with you and your code. It is suggested that all PHP developers subscribe
to this list.
</p>
<p>
Ok, if you are still reading, I assume you may actually need a CVS account.
If you are not previously known to the PHP Development Team, then this is not 
an automatic process.  Your best bet is to send mail to <a href="mailto: group@php.net">
group@php.net</a> and explain what you have in mind and perhaps give a bit of
background on yourself.  If you were told by a PHP developer to come here and 
fill out this form, you can skip sending the email to group@php.net.
</p>
<p>
If, you have already established yourself in the above manner you can submit
a CVS account request here: (only the encrypted version of the password is sent)
In the purpose field, put a couple of words describing what you want to work on.
This is mostly to jog our memories and allow us to match the account request with 
whatever previous correspondence that may taken place.
</p>
<p>
Please note:<br>
<b>
You do <i>NOT</i> need a CVS account to study PHP.  You do <i>NOT</i> need
a CVS account to learn PHP, to use PHP or to in any way do anything at all
with PHP.  If you are sitting there wondering if you need a CVS account, then
you don't!
</b>
</p>
<p>
<form action="cvs-php.php" method="POST">
<table>
<tr><th>Full Name: </th><td><input type=text size=50 name=fullname></td></tr>
<tr><th>Email: </th><td><input type=text size=50 name=email></td></tr>
<tr><th>Purpose: </th><td><input type=text size=50 name=purpose></td></tr>
<tr><th>User ID: </th><td><input type=text size=10 name=id></td></tr>
<tr><th>Requested Password: </th><td><input type=password size=10 name=password></td></tr>
<tr><th></th><td>By checking this box you ensure having read <I>all</I> comments above <input type="checkbox" name="checkread" value="1"></td></tr>
<tr><th>&nbsp;</th><td><input type=submit value="Send It"></td></tr>
</table>
</form>
<?php } elseif ($fullname && $email && $password && $purpose && $checkread) {
mail("rasmus@lerdorf.on.ca","CVS Account Request","Full name: $fullname\nEmail: $email\nID: $id\nPassword: ".crypt($password)."\nPurpose: $purpose");
mail("php-dev@lists.php.net", "CVS Account Request",
		"Full name: $fullname\n".
		"Email: $email\n".
		"ID: $id\n".
		"Purpose: $purpose", 
		'From: "CVS Account Request" <donotemail@php.net>');
?>
<p>
Thank you.  Your request has been sent.
</p>
<?php
} elseif ($fullname && $email && $password && $purpose && !$checkread) { 
?>
<p>
<blink><H1><font color="#ff0000">PLEASE, read our comments about applying for CVS accounts.</font></H1></blink>
</p>
<?php
} else {
?>
<p>
<blink><H1><font color="#ff0000">INCOMPLETE FORM. GO BACK AND RESUBMIT.</font></H1></blink>
</p>
<?php
}
?>
<P>
The CVS account, once granted and activated, gives you access to a number of things.  First, and most important it gives you access
to modify the PHP CVS tree.  It also allows you to comment on and close bugs in the PHP bugs interface
as well as modifying the documentation notes in the annotated manual.  The relevant links for these
three things are:
<ul>
<li><a href="http://viewcvs.php.net/">CVS Web Interface for our CVS repository</a>
<li><a href="http://bugs.php.net/">PHP Bugs Database</a>
<li><a href="http://www.php.net/manual/admin-notes.php">Manual Errata Administration</a>
</ul>
</p>
<p>
If you are not familiar with CVS, you should have a look at the various documentation resources available
at <a href="http://www.cvshome.org/">CVShome.org</a>.  This is also where to get the most recent version
of the CVS client.
</p>
<p>
All CVS commit messages get sent to the php-cvs mailing list.  You should subscribe yourself to this mailing
list.  Instructions for subscribing are on the <a href="/support.php">Support</a> page.
</p>
<p>
CVS itself is quite easy to use.  Follow the steps listed on the <a href="anoncvs.php">anonymous CVS</a>
page for checking out your tree.  Substitute your own user name and password for the cvsread/phpfi combination listed there.
You will not be able to do this until you receive confirmation of your account having been created.
</p>

<p>
Next, once you have your CVS tree you need to know the following commands.  They should all be executed from within
the checked out tree.  eg. cd php4
<dl>
<dt><b><tt>cvs update -dP</tt></b>
<dd>This fetches all updates made by others and brings your tree up to date.  Before starting to edit anything
in the tree you should do this.  Generally you would do this whenever you see a CVS commit message on the php-dev
mailing list.

<dt><b><tt>cvs commit</tt></b>
<dd>This commits any changes you have made anywhere in the tree.  A text editor will pop up and you will need to
describe the changes you made.  Please provide a good description here as it may help people in the future when
looking at your code changes.
</dl>
</p>

<p>
It would probably be a good idea to put the following in your ~/.cvsrc file:
<pre>diff -u
cvs -z4
update -d -P
checkout -P</pre>
</p>
<p>
Your CVS account also translates into a foo@php.net email address where <b>foo</b> is your CVS user id.
</p>

<?php commonFooter(); ?>
