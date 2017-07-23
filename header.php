<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
/**
 * Wordpress Head. This is REQUIRED! Never remove the wp_head
 */
wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

<?php get_template_part('templates/header/header'); ?>

<div id="content" class="site-content">
