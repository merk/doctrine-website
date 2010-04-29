<?php
function get_features_array()
{
  $latest = ApiReleaseTable::getLatest();
  $sf_user = sfContext::getInstance()->getUser();

  $features = array();
  $features[] = array('DQL (Doctrine Query Language)', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=dql-doctrine-query-language'));
  $features[] = array('Native SQL', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=native-sql'));
  $features[] = array('Hierarchical Data', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=hierarchical-data'));
  $features[] = array('Transactions', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=transactions'));
  $features[] = array('Caching', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=caching'));
  $features[] = array('Search Indexing', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=searching'));
  $features[] = array('Behaviors', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=behaviors'));
  $features[] = array('Migrations', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=migration'));
  $features[] = array('Data Fixtures', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=data-fixtures'));
  $features[] = array('Schema Files', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=schema-files'));
  $features[] = array('Sandbox', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=sandbox'));
  $features[] = array('Command Line Interface', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=utilities#command-line-interface'));
  $features[] = array('Validators', url_for('@documentation_item_release_chapter_lang?sf_culture=' . $sf_user->getCulture() . '&which=manual&release=' . $latest->getSlug() . '&chapter=basic-schema-mapping#constraints-and-validators'));
  foreach ($features as $key => $feature) {
    unset($features[$key]);
    $features[$feature[0]] = $feature;
  }
  asort($features);
  return $features;
}

function get_feature($feature)
{
  $features = get_features_array();

  return $features[$feature];
}