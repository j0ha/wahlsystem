<div>
  <div class="table-responsive">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dt-buttons">
          <button wire:click.lazy="create()" data-toggle="modal" data-target="#createModal" class="btn btn-outline-primary buttons-print" tabindex="0" aria-controls="example" type="button"><span>Neues Terminal</span></button>
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
                  <th>Beschreibung</th>
                  <th>Typ</th>
                  <th>Position</th>
                  <th>Zeitraum</th>
                  <th>Ip-Beschränkung</th>
                  <th>Status</th>
                  <th>Aktion</th>
              </tr>
          </thead>
          <tbody>
            @foreach($terminals as $terminal)
              <tr>
                  <td>{{$terminal->name}}</td>
                  <td>{{$terminal->description}}</td>
                  <td>{{$terminal->kind}}</td>
                  <td>{{$terminal->position}}</td>
                  <td>@if($terminal->start_time){{$terminal->start_time}}@else unendlich @endif bis @if($terminal->end_time){{$terminal->end_time}}@else unendlich @endif</td>
                  <td>@if($terminal->ip_restriction){{$terminal->ip_restriction}}@else<span class="badge badge-pill badge-light mx-1">Deaktiv</span>@endif</td>
                  <td>@if($terminal->status == 'active')<span class="badge badge-pill badge-success mx-1">Aktiv</span>@else<span class="badge badge-pill badge-danger mx-1">Deaktiv</span>@endif</td>
                  <td>
                    <button wire:click.lazy="edit('{{$terminal->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Bearbeiten</button>
                    <button wire:click.lazy="view('{{$terminal->uuid}}')" data-toggle="modal" data-target="#viewModal" type="button" class="btn btn-primary mx-1">Ansicht</button>
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Name</th>
                <th>Beschreibung</th>
                <th>Typ</th>
                <th>Position</th>
                <th>Zeitraum</th>
                <th>Ip-Beschränkung</th>
                <th>Status</th>
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
                      <div class="form-group">
                          <label for="description" class="col-form-label">Beschreibung</label>
                          <input wire:model.defer="description" id="description" name="description" placeholder="Beschreibung" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="position" class="col-form-label">Position</label>
                          <input wire:model.defer="position" id="position" name="position" placeholder="Position" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="start_time" class="col-form-label">Startzeit</label>
                          <input wire:model.defer="start_time" id="start_time" name="start_time" placeholder="Startzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="end_time" class="col-form-label">Endzeit</label>
                          <input wire:model.defer="end_time" id="end_time" name="end_time" placeholder="Endzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="ip_restriction" class="col-form-label">IP-Beschränkung</label>
                          <input wire:model.defer="ip_restriction" id="ip_restriction" name="ip_restriction" placeholder="IP-Beschränkung" type="text" class="form-control">
                      </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Änderung speichern</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Neues Terminal erstellen</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label for="name" class="col-form-label">Name</label>
                          <input wire:model.defer="name" id="name" name="name" placeholder="z.B. Peter" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="description" class="col-form-label">Beschreibung</label>
                          <input wire:model.defer="description" id="description" name="description" placeholder="Beschreibung" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="position" class="col-form-label">Position</label>
                          <input wire:model.defer="position" id="position" name="position" placeholder="Position" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="kind" class="col-form-label">Art</label>
                          <select wire:model.defer="kind" id="kind" name="kind" class="form-control">
                            <option value="'browser'">Browser</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="start_time" class="col-form-label">Startzeit</label>
                          <input wire:model.defer="start_time" id="start_time" name="start_time" placeholder="Startzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="end_time" class="col-form-label">Endzeit</label>
                          <input wire:model.defer="end_time" id="end_time" name="end_time" placeholder="Endzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="ip_restriction" class="col-form-label">IP-Beschränkung</label>
                          <input wire:model.defer="ip_restriction" id="ip_restriction" name="ip_restriction" placeholder="IP-Beschränkung" type="text" class="form-control">
                      </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                        <button wire:click="createSave()" class="btn btn-primary" data-dismiss="modal">Erstellen</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ansicht für {{$name}}</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                    </div>
                    <div class="modal-body">
                      <button wire:click.lazy="copyDirect()" class="btn btn-light mx-2 my-2" data-dismiss="modal">Link kopieren</a>
                      <button wire:click.lazy="delete()" class="btn btn-danger mx-2 my-2" data-dismiss="modal">Löschen</a>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
