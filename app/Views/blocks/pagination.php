<div div="row">
  <ul class="pagination pagination-lg justify-content-end">
    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
        <li class="page-item">
            <a class="page-link <?php echo $page['isCurrent'] ? 'active' : ''; ?> rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="<?php  echo $page['url']; ?>" tabindex="-1"><?php echo $page['num']; ?></a>
        </li>
      <?php else: ?>
        <li class="pagination-link2"><span><?php echo $page['num']; ?></span></li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>
