<?php
function link_changelog($changelog)
{
  $changelog = preg_replace("/r([0-9]+):([0-9]+)/", '<a href="http://trac.doctrine-project.org/changeset/$1">r$1</a>:<a href="http://trac.doctrine-project.org/changeset/$2">$2</a>', $changelog);
  $changelog = preg_replace("/r([0-9]+)/", '<a href="http://trac.doctrine-project.org/changeset/$1">r$1</a>', $changelog);
  $changelog = preg_replace("/\#([0-9]+)/", '<a href="http://trac.doctrine-project.org/ticket/$1">#$1</a>', $changelog);

  return $changelog;
}

function prepare_changelog($changelog)
{
  $changelog = strip_dates($changelog);
  $changelog = link_changelog($changelog);
  $changelog = trim($changelog);
  return $changelog;
}

function strip_dates($changelog)
{
  $changelog = preg_replace("/\n([0-9]+)-([0-9]+)-([0-9]+) ([^\n]+)\n\n/", "", $changelog);
  $changelog = preg_replace("/([0-9]+)-([0-9]+)-([0-9]+) ([^\n]+)\n\n/", "", $changelog);
  
  return $changelog;
}

function get_changelog($changelog)
{
  $changelog = prepare_changelog($changelog);
  $e = explode("* [", $changelog);
  
  return $e;
}