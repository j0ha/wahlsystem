@if ($paginator->hasPages())
<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
  <ul class="pagination">
    @if ($paginator->onFirstPage())
      <li class="paginate_button page-item previous disabled" id="example_previous"><button aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
    @else
      <li class="paginate_button page-item previous" id="example_previous"><button aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link" wire:click='previousPage'>Previous</a></li>
    @endif

    @if ($paginator->hasMorePages())
      <li class="paginate_button page-item next" id="example_next"><button aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link" wire:click='nextPage'>Next</a></li>
    @else
      <li class="paginate_button page-item next disabled" id="example_next"><button aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
    @endif
  </ul>
  </div>
@endif
