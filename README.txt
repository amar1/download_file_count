Custom Block
==========
Custom Block module contains article type node.

1. Show only first 5 nodes based on rules
2. Block shows content only of type article
3. Block is displayed only on nodes of type article

Rules:
  1. Display nodes in same category by same author first
  2. Display nodes in same category by different author next
  3. Display nodes in different category by same author next
  4. Display nodes in different category by different author next

4. Sort by title asc, created desc within each rule (So if there are 3 content for rule 1, these
3 should be sorted by title, created and then next 2 should be again sorted based the
group they belong to)

5. Block result should never contain current node

Reference Url
======================
- https://drupal.stackexchange.com/questions/136139/how-to-render-a-template-in-drupal-8
- https://drupal.stackexchange.com/questions/202909/pass-variable-to-custom-block-template-file
- https://drupal.stackexchange.com/questions/171686/how-can-i-programmatically-display-a-block
- https://www.deckfifty.com/blog/2017-01/drupal-8-l-function-creating-link
- http://www.codeexpertz.com/blog/drupal/drupal-8-get-content-owner-or-author-name-node-using-node-id




Note:-
1. Custom block assign in article type node from admin
2. Title AsC order set using query.
3. Display only article content type using with query
4. Display only 5 article using query.
5. Code test with Drupal code sniffer.


When we install custom module then we can enable block in content region i tried in .theme file of bartik but its not working. I think block id is not right so below code is not working.

/**
* Implements hook_preprocess_HOOK() for HTML document templates.
*
* Add block in a region.
*/
function bartik_block_preprocess_html(&$variables) {
  $block = \Drupal\block\Entity\Block::load('block-customblock');
  $block_content = \Drupal::entityManager()
  ->getViewBuilder('block')
  ->view($block);
  $variables['page']['content'][] = $block_content;
}



