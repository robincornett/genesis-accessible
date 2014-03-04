<?php
/** forms.php
	Description: Adds labels to the search forms
	Version: 1.0
	Author: Rian Rietveld
	Author URI: http://rrwd.nl
	License: GPLv2 or later
*/



//* Replace the search form, function adds a label and an id for the search input field
//* Based on the genesis_search_form with Genesis 2.0.1, keeps the filters
//* seems not to work in a plugin, so in functions.php

remove_filter( 'get_search_form', 'genesis_search_form', 20 );
add_filter( 'get_search_form', 'wpaccgen_search_form', 20 );

function wpaccgen_search_form() {


	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . '&#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	//* $search_text label, by default. Filterable.
	//* Generate ramdom id for the search field (n case there are more than one search form on the page)
	$label = apply_filters( 'genesis_search_form_label', $search_text );
	$label = '<label for="searchform" class="screen-reader-text">' .esc_html( $label ) . "</label>";

	if ( genesis_html5() )
		$form = sprintf( '<form method="get" class="search-form" action="%s" role="search">%s<input type="search" name="s" id="searchform" placeholder="%s" /><input type="submit" value="%s" /></form>', home_url( '/' ), $label , esc_attr( $search_text ), esc_attr( $button_text ) );
	else
		$form = sprintf( '<form method="get" class="searchform search-form" action="%s" role="search" >%s<input type="text" value="%s" name="s"  id="searchform" class="s search-input" onfocus="%s" onblur="%s" /><input type="submit" class="searchsubmit search-submit" value="%s" /></form>', home_url( '/' ), $label, esc_attr( $search_text ), esc_attr( $onfocus ), esc_attr( $onblur ), esc_attr( $button_text ) );

	return apply_filters( 'wpaccgen_search_form', $form, $search_text, $button_text, $label );

}



function wpaccgen_get_search_form_uniqueid() {


	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . '&#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	//* $search_text label, by default. Filterable.
	//* Generate ramdom id for the search field (n case there are more than one search form on the page)
	$id = uniqid( 'searchform' );
	$label = apply_filters( 'genesis_search_form_label', $search_text );
	$label = '<label for="' . $id . '" class="screen-reader-text">' .esc_html( $label ) . "</label>";

	if ( genesis_html5() )
		$form = sprintf( '<form method="get" class="search-form" action="%s" role="search">%s<input type="search" name="s" id="%s" placeholder="%s" /><input type="submit" value="%s" /></form>', home_url( '/' ), $label, $id, esc_attr( $search_text ), esc_attr( $button_text ) );
	else
		$form = sprintf( '<form method="get" class="searchform search-form" action="%s" role="search" >%s<input type="text" value="%s" name="s"  id="%s" class="s search-input" onfocus="%s" onblur="%s" /><input type="submit" class="searchsubmit search-submit" value="%s" /></form>', home_url( '/' ), $label, $id, esc_attr( $search_text ), esc_attr( $onfocus ), esc_attr( $onblur ), esc_attr( $button_text ) );

	return apply_filters( 'wpaccgen_search_form', $form, $search_text, $button_text, $label );
}




?>