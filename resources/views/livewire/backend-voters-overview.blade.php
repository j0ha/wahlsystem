<div>
  <div class="table-responsive">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="dt-buttons">
          <button wire:click.lazy="downloadList()" class="btn btn-outline-light buttons-export buttons-html5" tabindex="0" aria-controls="example" type="button"><span>Export</span></button>
          <button wire:click.lazy="downloadPDF()"class="btn btn-outline-light buttons-pdf buttons-html5" tabindex="0" aria-controls="example" type="button"><span>PDF</span></button>
          <button wire:click.lazy="print()"class="btn btn-outline-light buttons-print" tabindex="0" aria-controls="example" type="button"><span>Drucken</span></button>
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
                  <th>Nachname</th>
                  <th>Geburtsdatum</th>
                  <th>Jahrgang</th>
                  <th>Klasse</th>
                  <th>Status</th>
                  <th>Aktionen</th>
              </tr>
          </thead>
          <tbody>
            @foreach($voters as $voter)
              <tr>
                  <td>{{ $voter->name }}</td>
                  <td>{{ $voter->surname }}</td>
                  <td>{{ $voter->birth_year }}</td>
                  <td>{{ $voter->form_id }}</td>
                  <td>{{ $voter->schoolclass_id }}</td>
                  <td>@if($voter->voted_via_email) <span class="badge badge-success mx-1">Direct</span>@elseif ($voter->voted_via_terminal)<span class="badge badge-success mx-1">Terminal</span>@else<span class="badge badge-secondary mx-1">Freigeschalten</span>@endif @if( $voter->got_email )<span class="badge badge-success mx-1">E-Mail</span>@else<span class="badge badge-secondary mx-1">E-Mail</span>@endif</td>
                  <!-- <td><span class="badge badge-pill badge-light mx-1">nicht Abgestimmt</span><span class="badge badge-pill badge-success mx-1">Direkt erzeugt</span><span class="badge badge-pill badge-success mx-1">E-Mail vers.</span></td> -->
                  <td>
                    <button wire:click.lazy="editVoter('{{$voter->uuid}}')" data-toggle="modal" data-target="#editModal" type="button" class="btn btn-primary mx-1">Bearbeiten</button>
                    <button wire:click.lazy="viewVoter('{{$voter->uuid}}')" data-toggle="modal" data-target="#viewModal" type="button" class="btn btn-primary mx-1">Ansicht</button>
                    <!-- <a href="#" class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#editModal">Bearbeiten</a>
                    <a href="#" class="btn btn-primary btn-sm mx-1" data-toggle="modal" data-target="#viewModal">Ansicht</a> -->
                  </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
              <tr>
                <th>Name</th>
                <th>Nachname</th>
                <th>Geburtsdatum</th>
                <th>Jahrgang</th>
                <th>Klasse</th>
                <th>Status</th>
                <th>Aktionen</th>
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
                          <label for="surname" class="col-form-label">Nachname</label>
                          <input wire:model.defer="surname" id="surname" name="surname" placeholder="z.B. Schmidt" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="name" class="col-form-label">Vorname</label>
                          <input wire:model.defer="name" id="name" name="name" placeholder="z.B. Peter" type="text" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="email" class="col-form-label">E-Mail</label>
                          <input wire:model.defer="email" id="email" name="email" placeholder="E-Mail" type="email" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="birthday" class="col-form-label">Geburtsdatum</label>
                          <input wire:model.defer="birth_year" id="birthday" name="birthday" placeholder="Geburtstag" type="date" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                        <button wire:click="update()" class="btn btn-primary" data-dismiss="modal">Änderung speichern</a>
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
                      <button wire:click.lazy="sendEmail()" class="btn btn-light mx-2 my-2" data-dismiss="modal">E-Mail versenden</a>
                      <button wire:click.lazy="downloadSheet()" class="btn btn-light mx-2 my-2" data-dismiss="modal">Zugangsblatt downloaden</a>
                      <button wire:click.lazy="copyDirect()" class="btn btn-light mx-2 my-2" data-dismiss="modal">Direkt-Link kopieren</a>
                      <button wire:click.lazy="deleteVoter()" class="btn btn-danger mx-2 my-2" data-dismiss="modal">Löschen</a>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
