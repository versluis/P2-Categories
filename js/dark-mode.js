( function () {
	'use strict';

	var STORAGE_KEY = 'p2-color-scheme';
	var html        = document.documentElement;
	var mql         = window.matchMedia( '(prefers-color-scheme: dark)' );

	function isDark() {
		return html.classList.contains( 'dark-mode' );
	}

	function applyScheme( dark ) {
		html.classList.toggle( 'dark-mode', dark );
	}

	function syncButton() {
		var btn = document.getElementById( 'p2-color-scheme-toggle' );
		if ( ! btn ) { return; }
		btn.textContent = isDark() ? '☀ Light mode' : '☾ Dark mode';
		btn.setAttribute( 'aria-pressed', isDark() ? 'true' : 'false' );
	}

	function toggle() {
		var next = ! isDark();
		localStorage.setItem( STORAGE_KEY, next ? 'dark' : 'light' );
		applyScheme( next );
		syncButton();
	}

	// React to OS-level changes only when no manual preference is stored
	mql.addEventListener( 'change', function ( e ) {
		if ( ! localStorage.getItem( STORAGE_KEY ) ) {
			applyScheme( e.matches );
			syncButton();
		}
	} );

	// Wire up the button once DOM is ready
	document.addEventListener( 'DOMContentLoaded', function () {
		var btn = document.getElementById( 'p2-color-scheme-toggle' );
		if ( btn ) {
			btn.addEventListener( 'click', toggle );
			syncButton();
		}
	} );
} )();
