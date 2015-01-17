<div class="pagination">
  @if ($paginator->getLastPage() > 1)
  <?php $previousPage = ($paginator->getCurrentPage() > 1) ? $paginator->getCurrentPage() - 1 : 1; ?>
  <ul class="ui pagination menu">
    <a href="{{ $paginator->getUrl($previousPage) }}"
      class="item{{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
      <i class="fa fa-chevron-left"></i>
    </a>
    <a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}"
      class="item{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}">
      <i class="fa fa-chevron-right"></i>
    </a>
  </ul>
  @endif
</div>