$(document).ready(function() {
	/*
		Bootstrap 3: Keep selected tab on page refresh
		source:http://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
	*/
	$('#myTab a').click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	$("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#myTab a[href="' + hash + '"]').tab('show');

	$('#export-tabmenu a').click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul#export-tabmenu > li > a").on("shown.bs.tab", function(e) {
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#export-tabmenu a[href="' + hash + '"]').tab('show');

	// Duplicate of above solution for quarter tabs
	$('#quarter-tabs a').click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul#quarter-tabs > li > a").on("shown.bs.tab", function(e) {
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#quarter-tabs a[href="' + hash + '"]').tab('show');

	// Dropdown issues #quick fix
	$('.dropdown-checkbox').prop('checked',false);

	// Re implimeting the collapse for activity logs
	$('.activity-row').click(function(){
		$(this).children('td.description').children('.body').children('.full').toggleClass('is-showing');
		$(this).children('td.description').children('.body').children('.blurb').toggleClass('is-showing');
	});

	$('.profile-rollup-wrapper').click(function(){
		$(this).children('ul.profile-rollup-content').toggleClass('hidden');
		$(this).children('span.profile-header').children('span.toggle-icon').children('.profile-rollup-toggle-open').toggleClass('show');
		$(this).children('span.profile-header').children('span.toggle-icon').children('.profile-rollup-toggle-closed').toggleClass('hidden');
	});

	// tooltip
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

});
