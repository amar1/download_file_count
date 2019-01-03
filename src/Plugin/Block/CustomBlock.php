<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'custom_block' block.
 *
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom block"),
 *   category = @Translation("Custom block example")
 * )
 */
class CustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $service = \Drupal::service('custom_block.custom_services');
    $node_title = $service->getServiceData();
    $last_node_id = $service->currentNodeId();
    $nids_title =  array_diff(array_merge($node_title,$last_node_id),array_intersect($node_title,$last_node_id));

    return array(
      '#theme' => 'tcdev',
      '#title' => 'Article Block',
      '#description' => "Custom block of article",
      '#list' => $nids_title
    );
  }

}
