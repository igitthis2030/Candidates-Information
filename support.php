<?php
// $Id$
$_SERVER['BASE_PAGE'] = 'support.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/prepend.inc';

site_header("Getting Help");
column_box(COLUMN_MAIN);
?>

<h2>Documentation</h2>

<p>
 A good place to start is by skimming through the ever-growing list of
 <a href="/FAQ.php">frequently asked questions (with answers, of course)</a>.
 Then have a look at the rest of the online manual and other resources in the
 <a href="/docs.php">documentation</a> section.
</p>

<h2>Books</h2>
<p>
 Books are convenient resources to begin exploring or extend your
 PHP knowledge. There are literally thousands of books available in
 English and numerous in other languages. Search at your favourite
 online or offline bookstore. You can search at
 <a href="http://www.amazon.com/exec/obidos/external-search?mode=books&amp;keyword=PHP&amp;tag=wwwphpnet">Amazon.com</a>, or 
 go directly to
 <a href="http://www.amazon.de/exec/obidos/redirect-home/wwwphpnet07">Amazon.de</a>
 or <a href="http://www.amazon.fr/exec/obidos/redirect-home/wwwphpnet0f">Amazon.fr</a>
 and search there.
</p>

<h2>Mailing Lists</h2>

<p>
 There are a number of mailing lists devoted to talking about PHP and related
 projects. <a href="mailing-lists.php">This list</a> describes them all, has
 links to searchable archives for all of the lists, and explains how to
 subscribe to the lists.
</p>

<h2>Newsgroups</h2>

<p>
 The PHP language newsgroup is <tt>comp.lang.php</tt>, available on any
 news server around the globe. In addition to this many of our mailing
 lists are also reflected onto the news server at
 <a href="news://news.php.net">news://news.php.net/</a>. The
 server also has a read only web interface at
 <a href="http://news.php.net/">http://news.php.net/</a>.
</p>

<p>
 Mailing list messages are transfered to newsgroup posts and
 newsgroup posts are sent to the mailing lists. Please note
 that these newsgroups are only available on this server.
</p>

<h2>User Groups</h2>

<p>
 Christopher R. Moewes-Bystrom is running a PHP user group registry at <a
 href="http://www.phpusergroups.org/">http://www.phpusergroups.org/</a>.
 There's also a list of user groups in Germany, as well as news from them,
 and link to other countries user groups at
 <a href="http://www.phpug.de/">http://www.phpug.de/</a>.
 <a href="http://php.meetup.com/">PHP Meetup</a> is another great
 opportunity to get together.
</p>

<h2>Events &amp; Training</h2>

<p>
 A list of upcoming events (such as user group meetings and PHP training
 sessions) is included in the right-hand column of the front page, and
 on the <a href="/cal.php">event calendar page</a>. If you want to list
 an upcoming event, just fill out the form <a
 href="/submit-event.php">on this page</a>.
</p>

<h2>Sample Code</h2>

<p>
 Looking for some more sample PHP scripts? Our <a
 href="/links.php">links page</a> lists some archives of sample PHP code - 
 great places to find many example scripts and useful functions, organized for 
 your searching pleasure!
</p>
<!--
<h2>Knowledge Base</h2>

<p>
 The knowledge base is a growing collection of PHP related information in
 a searchable question and answer format. Anyone can contribute, and
 everyone is encouraged to do so. You can visit the Knowledge Base
 at <a href="http://php.faqts.com/">http://php.faqts.com/</a>.
</p>
-->
<h2>Instant Resource Center</h2>

<p>
 Otherwise known as IRC or Internet Relay Chat. Here you can usually find
 experienced PHP people sitting around doing nothing on various channels with
 php in their names.  Note that there is no official IRC channel.
 Check <a href="http://oftc.net">OFTC</a> or any other major network
 (<a href="http://www.efnet.org/">EFNet</a>,
 <a href="http://www.ircnet.com/">IRCNet</a>,
 <a href="http://www.quakenet.org">QuakeNet</a>,
 <a href="http://www.dal.net/">DALNet</a> and
 <a href="http://www.freenode.net/">freenode</a>).
</p>

<h2>PHP.net webmasters</h2>

<p>
 If you have a problem or suggestion <em>in connection with the PHP.net
 website or mirror sites</em>, <a href="/contact.php">please
 contact the webmasters</a>. If you have problems setting up PHP
 or using some functionality, please ask your question on a support
 channel detailed above, the webmasters will not answer any such
 questions.
</p>

<?php
column_box();

site_footer();

