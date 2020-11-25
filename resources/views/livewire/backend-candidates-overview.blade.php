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
                  <th>Description</th>
                  <th>Type</th>
                  <th>Level</th>
                  <th>Image</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($candidates as $candidate)
              <tr>
                  <td>{{$candidate->name}}</td>
                  <td>{{$candidate->description}}</td>
                  <td>{{$candidate->type}}</td>
                  <td>{{$candidate->level}}</td>
                  <td>{{$candidate->image}}</td>
                  <td>
                    <button wire:click.lazy="editCandidate('{{$candidate->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Edit</button>
                    <button wire:click.lazy="deleteCandidate('{{$candidate->uuid}}')" type="button" class="btn btn-danger mx-1">Delete</button>
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>Level</th>
                <th>Image</th>
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
            {{$candidates->links('pagination')}}
            </div>
          </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$name}} Edit</h5>
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
                          <input wire:model.defer="description" id="description" name="description" placeholder="Beschreibung" type="email" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="level" class="col-form-label">Level</label>
                          <input wire:model.defer="level" id="level" name="level" placeholder="Level" type="number" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
