<div>
  <div class="table-responsive">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dt-buttons">
          <button wire:click.lazy="create()" data-toggle="modal" data-target="#createModal" class="btn btn-outline-primary buttons-print" tabindex="0" aria-controls="example" type="button"><span>New Class</span></button>
          <button wire:click.lazy="downloadPDF()" class="btn btn-outline-light buttons-pdf buttons-html5" tabindex="0" aria-controls="example" type="button"><span>PDF</span></button>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div id="example_filter" class="dataTables_filter"><label>Search:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
        </div>
      </div>
    </div>
      @error('name') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
      @error('form_id') <div class="alert alert-danger" role="alert">{{$message}}</div></span> @enderror
      @if(session()->has('error'))<div class="alert alert-danger" role="alert">{{session('error')}}</div></span>@endif
      <table id="example" class="table table-striped table-bordered second" style="width:100%">
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Grade</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($schoolclasses as $schoolclass)
              <tr>
                  <td>{{$schoolclass->name}}</td>
                  @php
                  $formName = App\Form::where('id', $schoolclass->form_id)->get('name');
                  @endphp
                  <td>{{$formName[0]->name}}</td>
                  <td>
                    <button wire:click.lazy="edit('{{$schoolclass->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Edit</button>
                    <button wire:click.lazy="delete('{{$schoolclass->uuid}}')" type="button" class="btn btn-danger mx-1">Delete</button>
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Name</th>
                <th>Grade</th>
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
            {{$schoolclasses->links('pagination')}}
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
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new class</h5>
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
                          <label for="form_id" class="col-form-label">Grade</label>

                          <select wire:model.defer="form_id" id="form_id" name="form_id" class="form-control">
                            <option>Preselect Form</option>
                          @foreach($forms as $form)
                            <option value="{{$form->id}}">{{$form->name}}</option>
                          @endforeach

                          </select>
                      </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button wire:click="createSave()" class="btn btn-primary" data-dismiss="modal">Create</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
