<?php
function june_customize_register($wp_customize)
{
  //display navbar brand
  $wp_customize->add_setting('display_navbar_brand', array(
    'default'     => 'show',
    'transport'   => 'refresh'
  ));
  $wp_customize->add_control('display_navbar_brand', array(
    'label' => 'Site Title Display',
    'section' => 'title_tagline',
    'settings' => 'display_navbar_brand',
    'type' => 'radio',
    'choices' => array(
      'show' => 'Show Site Title',
      'hide' => 'Hide Site Title'
    ),
    'priority'  => 1
  ));

  //display name or logo
  $wp_customize->add_setting('display_navbar_namelogo', array(
    'default'     => 'show',
    'transport'   => 'refresh'
  ));
  $wp_customize->add_control('display_navbar_namelogo', array(
    'label' => 'Title/Logo Display',
    'section' => 'title_tagline',
    'settings' => 'display_navbar_namelogo',
    'type' => 'radio',
    'choices' => array(
      'show' => 'Show Title/Logo',
      'hide' => 'Hide Title/Logo'
    ),
    'priority'  => 2
  ));

  //display tagline
  $wp_customize->add_setting('display_navbar_tagline', array(
    'default'     => 'show',
    'transport'   => 'refresh'
  ));
  $wp_customize->add_control('display_navbar_tagline', array(
    'label' => 'Tagline Display',
    'section' => 'title_tagline',
    'settings' => 'display_navbar_tagline',
    'type' => 'radio',
    'choices' => array(
      'show' => 'Show Tagline',
      'hide' => 'Hide Tagline'
    ),
    'priority'  => 3
  ));
}
add_action('customize_register', 'june_customize_register');
