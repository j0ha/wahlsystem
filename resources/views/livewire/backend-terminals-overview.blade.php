<div>
  <div class="table-responsive">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dt-buttons">
          <button wire:click.lazy="create()" data-toggle="modal" data-target="#createModal" class="btn btn-outline-primary buttons-print" tabindex="0" aria-controls="example" type="button"><span>New Terminal</span></button>
          <button wire:click="downloadPDF()" class="btn btn-outline-light buttons-pdf buttons-html5" tabindex="0" aria-controls="example" type="button"><span>PDF</span></button>
        </div>

      </div>
      <div class="col-sm-12 col-md-6">
        <div id="example_filter" class="dataTables_filter"><label>Search:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
        </div>
      </div>
    </div>
    @error('name') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
    @error('description') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
    @error('position') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
    @error('start_time') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
    @error('end_time') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
    @error('ip_restriction') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
      @if(session()->has('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div></span>@endif
      {{$terminals}}
      @if($terminals == null)
          <span><div class="alert alert-info" role="alert">There are no existing terminals.</div></span>
      @endif

      <table id="example" class="table table-striped table-bordered second" style="width:100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Typ</th>
                  <th>Position</th>
                  <th>Timeslot</th>
                  <th>IP restriction</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($terminals as $terminal)
              <tr>
                  <td>{{$terminal->name}}</td>
                  <td>{{$terminal->description}}</td>
                  <td>{{$terminal->kind}}</td>
                  <td>{{$terminal->position}}</td>
                  <td>@if($terminal->start_time){{$terminal->start_time}}@else not defined @endif to @if($terminal->end_time){{$terminal->end_time}}@else endless @endif</td>
                  <td>@if($terminal->ip_restriction){{$terminal->ip_restriction}}@else<span class="badge badge-pill badge-light mx-1">Deaktiv</span>@endif</td>
                  <td>@if($terminal->status == 1)<span class="badge badge-pill badge-success mx-1">Active</span>@else<span class="badge badge-pill badge-danger mx-1">Inactive</span>@endif</td>
                  <td>
                    <button wire:click.lazy="edit('{{$terminal->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Edit</button>
                    <button wire:click.lazy="view('{{$terminal->uuid}}')" data-toggle="modal" data-target="#viewModal" type="button" class="btn btn-primary mx-1">Show</button>
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Typ</th>
                  <th>Position</th>
                  <th>Timeslot</th>
                  <th>IP restriction</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </tfoot>
      </table>
      <div class="row mt-3">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing
            <select wire:model="perPage">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select> entries per page.</div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
            {{$terminals->links('pagination')}}
            </div>
          </div>
        </div>

        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{$name}}</h5>
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
                          <label for="description" class="col-form-label">Description</label>
                          <input wire:model.defer="description" id="description" name="description" placeholder="Beschreibung" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="position" class="col-form-label">Position</label>
                          <input wire:model.defer="position" id="position" name="position" placeholder="Position" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="start_time" class="col-form-label">Start time</label>
                          <input wire:model.defer="start_time" id="start_time" name="start_time" placeholder="Startzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="end_time" class="col-form-label">End time</label>
                          <input wire:model.defer="end_time" id="end_time" name="end_time" placeholder="Endzeit" type="datetime" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="ip_restriction" class="col-form-label">IP restriction</label>
                          <input wire:model.defer="ip_restriction" id="ip_restriction" name="ip_restriction" placeholder="IP-Beschränkung" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label class="col-form-label">Status</label>
                          <div class="pt-1">
                              <div class="switch-button switch-button-success">
                                  <input wire:model.defer="status" type="checkbox" name="status" id="status"><span>
                              <label for="status"></label></span>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Clsoe</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new Terminal</h5>
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
                          <label for="description" class="col-form-label">Description</label>
                          <input wire:model.defer="description" id="description" name="description" placeholder="Beschreibung" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="position" class="col-form-label">Position</label>
                          <input wire:model.defer="position" id="position" name="position" placeholder="Position" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="kind" class="col-form-label">Kind</label>
                          <select wire:model.defer="kind" id="kind" name="kind" class="form-control">
                              <option>Please select</option>
                            @foreach(config('terminalkinds') as $kind)
                            <option value="{{$kind['short']}}">{{$kind['name']}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="start_time" class="col-form-label">Start time</label>
                          <input wire:model.defer="start_time" id="start_time" name="start_time" placeholder="Startzeit" type="datetime-local" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="end_time" class="col-form-label">End time</label>
                          <input wire:model.defer="end_time" id="end_time" name="end_time" placeholder="Endzeit" type="datetime-local" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="ip_restriction" class="col-form-label">IP restriction</label>
                          <input wire:model.defer="ip_restriction" id="ip_restriction" name="ip_restriction" placeholder="IP-Beschränkung" type="text" class="form-control">
                      </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button wire:click="createSave()" class="btn btn-primary" data-dismiss="modal">Create</a>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$name}}</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                    </div>
                    <div class="modal-body">
                        @if($url)
                        <input type="hidden" value="{{$url}}">
                        <div class="form-group row">
                            <label for="url" class="col-3 col-lg-2 col-form-label text-right">URL</label>
                            <div class="col-9 col-lg-10">
                                <input id="url" type="text" value="{{$url}}" class="form-control">
                            </div>
                        </div>
                      <button onclick="copyURL()" class="btn btn-light mx-2 my-2" data-dismiss="modal">Copy link</a>
                          @endif
                      <button wire:click.lazy="delete()" class="btn btn-danger mx-2 my-2" data-dismiss="modal">Delete</a>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
