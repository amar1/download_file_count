<?php

namespace Drupal\custom_block\Services;

use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class CustomService.
 */
class CustomService {

  /**
   * Constructs a new CustomService object.
   */
  public function __construct() {

  }

  /**
   * Get current node id.
   */
  public function currentNodeId()
    {
      $query = \Drupal::entityQuery('node');
      $query->condition('status', 1);
      $query->condition('type', 'article');
      $query->range(0, 1);
      $query->sort('created', 'DESC');
      $nids = $query->execute();
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
      $options = [
        'attributes' => ['class' => ['article-class'], 'rel' => 'nofollow'],
      ];
      $output = array();
      if (!empty($nodes)) {
      $author_array = array();
      $field_tags = array();
      foreach ($nodes as $key => $value) {
        $entity_obj = entity_load('node', $key);
        $author_name = $entity_obj->getOwner()->getDisplayName();
        $author_array[] = $author_name;
        $field_tags[] = $value->field_tags->target_id;
        if (in_array($author_name, $author_array) && in_array($author_name, $author_array)) {
          $result = Link::fromTextAndUrl(t($value->title->value . " Term Id =  ". $value->field_tags->target_id." By author is : ".$author_name), Url::fromUri('internal:/node/'.$value->nid->value, $options))->toString();
          $output[$value->nid->value] .= $result;
        }
      }
    } else {
        $output .= "No record found";
      }
      return $output;
    }

  /**
   * Get service data.
   */
  public function getServiceData() {
    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1);
    $query->condition('type', 'article');

    $query->groupBy('field_tags.target_id');
    $query->groupBy('uid');

    $query->range(0, 5);
    $query->sort('title', 'ASC');
    $query->sort('created', 'DESC');
    $nids = $query->execute();
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
    $options = [
      'attributes' => ['class' => ['article-class'], 'rel' => 'nofollow'],
    ];
    $output = array();
    if (!empty($nodes)) {
      $author_array = array();
      $field_tags = array();
      foreach ($nodes as $key => $value) {
        $entity_obj = entity_load('node', $key);
        $author_name = $entity_obj->getOwner()->getDisplayName();
        $author_array[] = $author_name;
        $field_tags[] = $value->field_tags->target_id;
        if (in_array($author_name, $author_array) && in_array($author_name, $author_array)) {
          $result = Link::fromTextAndUrl(t($value->title->value . " Term Id =  ". $value->field_tags->target_id." By author is : ".$author_name), Url::fromUri('internal:/node/'.$value->nid->value, $options))->toString();
          $output[$value->nid->value] .= $result;
        }
      }
    } else {
      $output .= "No record found";
    }
    return $output;
  }

}
