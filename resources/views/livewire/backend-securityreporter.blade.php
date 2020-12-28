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
                <div id="example_filter" class="dataTables_filter"><label>Search:<input wire:model.debounce.300ms="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                </div>
            </div>
        </div>

        <table id="example" class="table table-striped table-bordered second" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Importance</th>
                <th>Description</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{$report->id}}</td>
                    <td>{{$report->importance}}</td>
                    <td>{{$report->description}}</td>
                    <td>{{$report->updated_at}}</td>
                    <td>
                        <button wire:click.lazy="show('{{$report->id}}')" data-toggle="modal" data-target="#showModal" type="button" class="btn btn-primary mx-1">Details</button>
                        <button wire:click.lazy="delete('{{$report->id}}')" type="button" class="btn btn-danger mx-1">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Importance</th>
                <th>Description</th>
                <th>Time</th>
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
                    {{$reports->links('pagination')}}
                </div>
            </div>
        </div>

        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Show #{{$report_id}}</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <span><b>Description</b></span>
                            <p>{{$report_description}}</p>
                            <span><b>File</b></span>
                            <p>{{$report_file}}</p>
                            <span><b>Error</b></span>
                            <p>{{$report_error}}</p>
                            <span><b>Addtional Information</b></span>
                            <p>{{$report_additional}}</p>
                            <span><b>Time</b></span>
                            <p>{{$report_time}}</p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
