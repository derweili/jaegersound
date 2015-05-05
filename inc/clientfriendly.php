<?php
function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
        //remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); Comments are already deaktivated
        //remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta' );


add_action( 'wp_dashboard_setup', 'register_my_dashboard_widget' );
function register_my_dashboard_widget() {
	wp_add_dashboard_widget(
		'my_dashboard_widget',
		'Website Infos',
		'my_dashboard_widget_display'
	);
}
function my_dashboard_widget_display() {
	?>
		<p><h3><strong>Hallo Sascha,</strong></h3>
			Willkommen zu deiner neuen Website. Hier ein paar Infos zur Benutzung:</p>
		 
		 
		<h3><strong>Referenzen/Beiträge</strong></h3>
		<p>Referenzen und (News-Beiträge) sind dynamische Inhalte, sie nutzen daher die in Worpress integrierte Blogfunktion. Um eine neue News oder Referenz anzulegen klicke gehe zu "Beiträge" -> "Erstellen" oder alternativ über die Adminbar (ganz oben) "Neu" -> "Beitrag"</p>
		<p>Ob ein Beitrag nun eine News ist oder eine Referenz, wird durch die Zuweisung einer entsprechenden Kategorie bestimmt. Referenzen, sollten außerdem die verwendete Technik zugewießen bekommen, dadurch sind sie besser auffindbar. Du kannst gerne eine neue Technik hinzufügen.</p>
		<p>Grundsätzlich ist es zusätzlich wichtig Tags für jeden Beitrag/Referenz zu vergeben, diese werden als Keywords für Google gesetzt um eine bessere Suchmaschinenoptimierung zu erreichen. Schreibe hier einfach Wörter hinein, welche den Inhalt beschreiben.</p>
		<p>In einem Archiv (Referenze/Newsübersicht) wird immer der komplette Beitrag angezeigt. Dies ist jedoch nicht empfehlenswert, da der Nutzer unter anderem wegen eingebundener Bildergalerien überfordert wird. Um nur einen Ausschnitt anzuzeigen, sollte im Editor ein Read-more Tag gestezt werden.</p> 
		<h3>Kategorie/Technik</h3>
		<p>Du möchtest eine Kategorie/Technik näher Beschreiben, klicke gehe dazu im linken Menü auf "Beiträge" -> "Kagetorie/Technik". Auf der Rechten Seite werden nun alle bisher angelegten Kategorien/Techniken angezeigt. Klicke hier nun unter dem jeweiligen Punkt auf bearbeiten, anschließend kannst du unter dem Punkt "Beschreibung" diese anlegen.</p>
		<h3>Medien</h3>

		<strong>Bilder</strong>
		<p>Die Bilder werden beim hochladen automatisch in der Auflösung angepasst und den Endgeräten in der passenden Größe ausgegeben. Die Bilder werden außerdem automatisch komprimiert, jedoch nur bis 1MB Dateigröße (es wird hierfür eine Wordpress-Erweiterung verwendet, welche in ihrer kostenlosen Version nur Bilder bis 1MB unterstützt). Bitte lade daher nur Bilder mit einer Dateigröße unter 1MB hoch</p>
		<strong>Videos</strong><br />
		Wenn du Videos <strong>selbst hosten</strong> möchtest, lade diese einfach wie ein Bild hoch und binde sie ein. Auf Grund von der begerenzzen Größe deines Webspace, Traffic und Geschwindigkeit ist das aber nicht empfehlenswert. <br />
		Wenn du Videos von <strong>Youtube</strong> oder <strong>Vimeo</strong> einbetten möchtest, dann füge den Link zum Video in einer neuen Zeile ein und wechsle nach dem Link wieder in eine neue Zeile. Anschließend sollte das Video angezeigt werden. Wenn das aufgrund deines Browsers nicht möglich ist, gehe über den Punk "Datei hinzufügen" -> von URL einfügen. Hier kannst du die Video URL eingeben. Anschließend wird ein Vorschaubild des Videos im WYSIWYG-Editor angezeigt.
		<h3>Slider</h3>
		<p>Auf der Startseite wir ein Bilderslider angezeigt. Im Linken Menü unter "Slides" kannst du diese festlegen. Hierfür wird ein Titel und ein Beitragsbild benötigt.</p>
		<ul>
		<li><a href='<?php echo admin_url("post-new.php") ?>'>New Post</a></li>
		<li><a href='<?php echo admin_url("edit.php?post_type=page") ?>'>Seiten bearbeiten</a></li>
		<li><a href='<?php echo admin_url("profile.php") ?>'>Dein Profil</a></li>
	</ul>
	 
	 
	<?php
}

//Helptext
function my_post_guidelines() {
	$screen = get_current_screen();
	if ( 'post' != $screen->post_type )
	return;
	$args = array(
	'id' => 'my_website_guide',
	'title' => 'Jaegersound Hilfe',
	'content' => '
	<h3>Referenzen Hilfe</h3>
	<h4>Einbetten von Bildern und Videos</h4>
	<p>Einzelne Bilder können per Drag \'n\' in den Text eingefügt werden.<p>
		Eine Bildergallerie kann angelegtwerden, indem nach dem Klick auf "Datei hinzufügen" Mehrere Bilder ausgewählt werden und anschließen der Menüpunkt "Galerie erstellen" -> "Erstelle eine neue Galerie" gewählt wird.	
	</p>
	<p>Youtube Videos können eingebunden werden, indem die URL incl. "http://" in eine eingene Zeile eingefügt wird. Alternativ auch über "Datei hinzufügen" -> "Von URL einfügen".</p>
	<h4>Kategorien und Technik</h4>
	<p>Beim Auswählen der Kategorie "Startseite" wird der Beitrag auf der Startseite angezeigt. Wenn mehr als 3 Beiträge diese Kategorie haben, werden die 3 neuesten gezeigt.</p>
	<p>Um unter einer bestimmten Technik gefunden zu werden, muss dem Beitrag diese zugewiesen werden, diese geht unter dem Punkt "Technik" in der rechten Spalte</p>
	<h4>Formatvorlage</h4>
	<p>Das Theme unterstützt 2 verschiedene Formatvorlagen: Standard und Kurzmitteilung. Standart Beiträge verlinken auf deren einzelne Seiten, während Kurzmitteilungen hervorgehobene Beiträge (mit blauem Hintergrung) sind, jedoch ohne Einzelne Beitragsseite.</p>
	',
	);
	// Add the help tab.
	$screen->add_help_tab( $args );
}
add_action('admin_head', 'my_post_guidelines');


function my_slider_guidelines() {
	$screen = get_current_screen();
	if ( 'slider' != $screen->post_type )
	return;
	$args = array(
	'id' => 'my_website_guide',
	'title' => 'Jaegersound Hilfe',
	'content' => '
	<h3>Slider Hilfe</h3>
	<p>Auf der Startseite befindet sich ein Bilderslider. Die Angezeigen Bilder können hier über das Backend (Menüpunk "Slider") verwaltet werden. Zum Erstellen eines Sliders werden nur 2 Daten benötigt. Zum einen ein Titel, dieser wird jedoch nur Wordpress-Intern zur besseren Verwaltung verwendet und zum anderen das Bild, welches über "Beitragsbild" hinzugefügt wird.</p>
	',
	);
	// Add the help tab.
	$screen->add_help_tab( $args );
}
add_action('admin_head', 'my_slider_guidelines');


//Change Dashboard to "Übersicht"
add_filter(
'gettext', 'change_names' );
add_filter( 'ngettext', 'change_names' );
function change_names( $translated ) { $translated = str_ireplace(
'Dashboard', 'Übersicht', $translated );
// ireplace is PHP5 only
return $translated;}



//Updates only visible for admin user
function hide_update_notice() {
global $user_login , $user_email; get_currentuserinfo();
if ($user_login != "name_des_admin") {
remove_action( 'admin_notices', 'update_nag', 3 ); }
}
add_action( 'admin_notices', 'hide_update_notice', 1 );


//Dashbord Footer Text
function jaegersound_footer_text(){
	echo 'Jaegersound';
}
add_filter('admin_footer_text', 'jaegersound_footer_text');

/*add_action('admin_head', 'mytheme_remove_help_tabs');//Help deaktivieren
function mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}*/

//Custom Editor CSS
add_editor_style();

//Suche Abschalten
function fastwp_filter_query( $query, $error = true ) {

	if ( is_search() ) {
		$query->is_search = false;
		$query->query_vars[s] = false;
		$query->query[s] = false;

		// to error
		if ( $error == true )
			$query->is_404 = true;
	}
}

add_action( 'parse_query', 'fastwp_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );


//Widgetd deaktivieren
// unregister all default WP Widgets 
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);



//Werkzeuglseite
add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

function remove_wp_nodes()
{
    global $wp_admin_bar;  
    $wp_admin_bar->remove_node( 'wp-logo' ); // Entfernt das WordPress-Logo
    //$wp_admin_bar->remove_node( 'site-name' ); // Entfernt den Namen der Seite
    $wp_admin_bar->remove_node( 'comments' ); // Entferne den Abschnitt "Kommentare"
    //$wp_admin_bar->remove_node( 'new-content' ); // Entfernt den Abschnitt "Neu"

    // Es ist auch möglich die Unterpunkte des Abschnitts "Neu" einzeln zu entfernen 
    //$wp_admin_bar->remove_node( 'new-post' ); // Entfernt den Menüpunkt "Neuer Beitrag"
    $wp_admin_bar->remove_node( 'new-link' ); // Entfernt den Menüpunkt "Neuer Link"
    //$wp_admin_bar->remove_node( 'new-media' ); // Entfernt den Menüpunkt "Neue Datei"
    //$wp_admin_bar->remove_node( 'new-page' ); // Entfernt den Menüpunkt "Neue Seite"
    $wp_admin_bar->remove_node( 'new-user' ); // Entfernt den Menüpunkt "Neuer Benutzer"
    $wp_admin_bar->remove_node( 'search' ); // Entfernt den Menüpunkt "Suche"
    $wp_admin_bar->remove_node( 'updates' ); // Entfernt den Menüpunkt "Suche"
}



/* Navigationspunkte aus dem WordPress-Dashboard entfernen */ 
function remove_menus () {
global $menu;
		$restricted = array(
//			__('Beiträge'),
//			__('Medien'),
			__('Links'),
//			__('Seiten'),
			__('Kommentare'),
//			__('Design'),
//			__('Plugins'),
//			__('Benutzer'),
			__('Werkzeuge'));
		end ($menu);
		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		}
}
add_action('admin_menu', 'remove_menus');


//Remove Buttons form WYSIWYG Editor
function myplugin_tinymce_buttons($buttons) {
	//Remove the format dropdown select and text color selector
	$remove = array('forecolor', 'alignjustify', 'italic');

	return array_diff($buttons,$remove);;
}
add_filter('mce_buttons_2','myplugin_tinymce_buttons');