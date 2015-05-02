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
		'Website Guidelines',
		'my_dashboard_widget_display'
	);
}
function my_dashboard_widget_display() {
	?>
		<p>Howdy Mr. Client, welcome to your website. Here are some quick guidelines to keep in mind when using the site.</p>
		 
		 
		<h4><strong>Beiträge</strong></h4>
		<p>Beiträge sind dynamische Inhalte, daher News und Referenzen.</p>
		 
		<h4><strong>Bilder</strong></h4>
		<p>Die Bilder werden beim hochladen automatisch in der Auflösung angepasst und den Endgeräten passend ausgegeben. Die Bilder werden außerdem automatisch kompromiert, jedoch nur bis 1MB Dateigröße. Daher bitte nur Bilder mit einer Dateigröße unter 1MB hochladen</p>
		 
		<h4><strong>Important Links</strong></h4>
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
	'title' => 'Referenzen Jaegersound Hilfe',
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
	',
	);
	// Add the help tab.
	$screen->add_help_tab( $args );
}
add_action('admin_head', 'my_post_guidelines');

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

add_action('admin_head', 'mytheme_remove_help_tabs');//Help deaktivieren
function mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}

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
