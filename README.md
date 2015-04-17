# ACFC
Advanced Custom Fields Controller


## Introduction
ACF is a great tool for building interfaces for the WordPress administration. But ACF stores all fields and their groups in the database, which can potentially lead to a lot of headaches when working in teams. In spite of features like field syncing it can be harrowing to commit fields to the database. I want to be able to describe my fields in my codebase and not in the database. Here's a simplified example of a flow to create a field group and some fields:
```
// Create field group object
$movie_info_group   = new acfc_field_group('Movie info');

// Describe title field
$title_field        = new acfc_field('title');
$title_field
  ->set('label', 'Movie title')
  ->set('instructions', 'Enter the movie title here')
  ->set('type', 'text')

// Describe genre field
$genre_field     = new acfc_field('genre');
$genre_field
  ->set('type', 'select')
  ->set('label', 'Movie genre')
  ->add_choice('drama', 'Drama')
  ->add_choice('comedy', 'Comedy')

// Attach to field group
$movie_field_group
  ->add_field($title_field)
  ->add_field($genre_field)

// Make sure th
ACFC::include_field_group($movie_field_group);

```
