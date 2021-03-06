<div>
    <div class="table-responsive">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dt-buttons">
                    <button wire:click.lazy="downloadPDF()" class="btn btn-outline-light buttons-pdf buttons-html5" tabindex="0" aria-controls="example" type="button"><span>PDF</span></button>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="example_filter" class="dataTables_filter"><label>Search:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                </div>
            </div>
        </div>

        <table id="example" class="table table-striped table-bordered second" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Birthdate</th>
                <th>Form</th>
                <th>Class</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($voters as $voter)
                <tr>
                    <td>{{ $voter->name }}</td>
                    <td>{{ $voter->surname }}</td>
                    <td>{{ $voter->birth_year }}</td>
                    @php
                        $formName = App\Form::where('id', $voter->form_id)->get('name');
                    @endphp
                    <td>{{$formName[0]->name}}</td>
                    @php
                        $className = App\Schoolclass::where('id', $voter->schoolclass_id)->get('name');
                    @endphp
                    <td>{{$className[0]->name}}</td>

                    <td>@if($voter->voted_via_email)<span class="badge badge-pill badge-success mx-1">voted directly</span>@elseif ($voter->voted_via_terminal)<span class="badge badge-pill badge-success mx-1">voted via terminal</span>@else<span class="badge badge-pill badge-light mx-1">not voted</span>@endif
                        @if($voter->direct_uuid)<span class="badge badge-pill badge-success mx-1">created directly</span>@else<span class="badge badge-pill badge-light mx-1">created directly</span>@endif
                        @if($voter->got_email == true)<span class="badge badge-pill badge-success mx-1">E-Mail sent</span>@else<span class="badge badge-pill badge-light mx-1">E-Mail sent</span>@endif
                        @if($voter->activated == true)<span class="badge badge-pill badge-success mx-1">activated</span>@else<span class="badge badge-pill badge-warning mx-1">activated</span>@endif
                    </td>
                    <td>
                        @if($state == config('votestates.live.short') OR $state == config('votestates.planned.short')) <button disabled class="btn btn-primary mx-1">Edit</button> @else<button wire:click.lazy="editVoter('{{$voter->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Edit</button>@endif
                        <button wire:click.lazy="viewVoter('{{$voter->uuid}}')" data-toggle="modal" data-target="#viewModal" type="button" class="btn btn-primary mx-1">View</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Birthdate</th>
                <th>Form</th>
                <th>Class</th>
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
                    {{$voters->links('pagination')}}
                </div>
            </div>
        </div>
    </div>




    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$name}} edit</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="surname" class="col-form-label">Surname</label>
                        <input wire:model.defer="surname" id="surname" name="surname" placeholder="z.B. Schmidt" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name</label>
                        <input wire:model.defer="name" id="name" name="name" placeholder="z.B. Peter" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-Mail</label>
                        <input wire:model.defer="email" id="email" name="email" placeholder="E-Mail" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="col-form-label">Birthdate</label>
                        <input wire:model.defer="birth_year" id="birthday" name="birthday" placeholder="Geburtstag" type="date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View for {{$name}}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @if($terminals AND $hasDirectly == true)
                    <div class="form-group">
                        <label for="input-select">E-Mail Terminal</label>
                        <select wire:model="terminal_sel" class="form-control" id="input-select">
                            <option value="">Choose Terminal for E-Mail sending</option>
                            @foreach($terminals as $terminal)
                                <option value="{{$terminal->uuid}}">{{$terminal->name}}</option>
                            @endforeach
                        </select>
                    </div>
                        <button wire:click.lazy="sendEmail()" class="btn btn-light mx-2 my-2" data-dismiss="modal" @if($terminal_sel == null) disabled @endif>Send E-Mail</button>
                        <button wire:click.lazy="downloadSheet()" class="btn btn-light mx-2 my-2" data-dismiss="modal" @if($terminal_sel == null) disabled @endif>Download the Page</button>
                    @endif
                            <button wire:click.lazy="direct()" class="btn btn-light mx-2 my-2" data-dismiss="modal" @if($hasDirectly == true) disabled @endif>Generate directly</button>
                        @if($state == config('votestates.live.short') OR $state == config('votestates.planned.short')) <button class="btn btn-danger mx-2 my-2" disabled>Delete</button> @else <button wire:click.lazy="deleteVoter()" class="btn btn-danger mx-2 my-2" data-dismiss="modal">Delete</button> @endif
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

</div>
