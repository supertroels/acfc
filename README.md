# ACFC
Advanced Custom Fields Controller


## Introduction

ACF is a great tool for building interfaces for the WordPress administration. While the ACF GUI is great for projects with only one developer, the fact that all fields and their groups are stored in the database, can potentially lead to a lot of headaches when working in teams. In spite of new features, like local JSON and field syncing, a safer and more maintainable solution for bigger projects is needed. One where the fields are described in the **code**base - not in the **data**base.

Here's a simplified example of what I am trying to build. This is a flow to create a field group and attach some fields to it:

```PHP

// Describe title field
$title_field        = new acfc_field('title');
$title_field
  ->set('label', 'Movie title')
  ->set('instructions', 'Enter the movie title here')
  ->set('type', 'text');

// Describe genre field
$genre_field     = new acfc_field('genre');
$genre_field
  ->set('type', 'select')
  ->set('label', 'Movie genre')
  ->add_choice('drama', 'Drama')
  ->add_choice('comedy', 'Comedy');

// Create field group object and attach fields
$movie_info_group   = new acfc_field_group('Movie info');
$movie_info_group
  ->add_field($title_field)
  ->add_field($genre_field);

// Include the field group
ACFC::include_field_group($movie_info_group);

```
