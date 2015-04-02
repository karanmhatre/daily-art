<div class="pagination">
  @if ($paginator->getLastPage() > 1)
  <?php $previousPage = ($paginator->getCurrentPage() > 1) ? $paginator->getCurrentPage() - 1 : 1; ?>
    <ul class="ui pagination menu">

      @if($paginator->getCurrentPage() == 1)
        <a href="javascript:void(0);" class="disabled">
          <i class="fa fa-chevron-left"></i>
        </a>
      @else
        <a href="{{ $paginator->getUrl($previousPage) }}">
          <i class="fa fa-chevron-left"></i>
        </a>
      @endif
      @if($paginator->getCurrentPage() == $paginator->getLastPage() - 1)
        <a href="javascript:void(0);"
          class="disabled">
          <i class="fa fa-chevron-right"></i>
        </a>
      @else
        <a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" style="padding-left: 6px;">
          <i class="fa fa-chevron-right"></i>
        </a>
      @endif
    </ul>
  @endif
</div>