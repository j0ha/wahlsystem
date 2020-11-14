<div>
  <div class="table-responsive">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dt-buttons">
          <button class="btn btn-outline-light buttons-export buttons-html5" tabindex="0" aria-controls="example" type="button"><span>Export</span></button>
          <button class="btn btn-outline-light buttons-pdf buttons-html5" tabindex="0" aria-controls="example" type="button"><span>PDF</span></button>
          <button class="btn btn-outline-light buttons-print" tabindex="0" aria-controls="example" type="button"><span>Drucken</span></button>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div id="example_filter" class="dataTables_filter"><label>Suche:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
        </div>
      </div>
    </div>

      <table id="example" class="table table-striped table-bordered second" style="width:100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Jahrgang</th>
                  <th>Aktion</th>
              </tr>
          </thead>
          <tbody>
            @foreach($schoolclasses as $schoolclass)
              <tr>
                  <td>{{$schoolclass->name}}</td>
                  <td>{{$schoolclass->form_id}}</td>
                  <td>
                    <button wire:click.lazy="edit('{{$schoolclass->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Bearbeiten</button>
                    <button wire:click.lazy="delete('{{$schoolclass->uuid}}')" type="button" class="btn btn-danger mx-1">Löschen</button>
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Name</th>
                <th>Jahrgang</th>
                <th>Aktion</th>
              </tr>
          </tfoot>
      </table>
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing {{$perPage}} entries per page.</div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous disabled" id="example_previous">
                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                <li class="paginate_button page-item active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                <li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$name}} bearbeiten</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label for="name" class="col-form-label">Name</label>
                          <input wire:model.defer="name" id="name" name="name" placeholder="z.B. Peter" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Änderung speichern</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
