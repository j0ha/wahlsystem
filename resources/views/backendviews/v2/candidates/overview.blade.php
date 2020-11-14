@extends('layouts.backend_v2')

@section('backendcontent')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <div class="card-header">
              <h5 class="mb-0">Nutzer der Wahl</h5>
              <p>Diese Tabelle zeigt alle Nutzer der Wahl an und dient zur Verwaltung dieser.</p>
          </div>
          <div class="card-body">
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
                    <div id="example_filter" class="dataTables_filter"><label>Suche:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                    </div>
                  </div>
                </div>

                  <table id="example" class="table table-striped table-bordered second" style="width:100%">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Beschreibung</th>
                              <th>Typ</th>
                              <th>Level</th>
                              <th>Bild</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Tiger</td>
                              <td>Hawewerwerlt</td>
                              <td>Schulsprecherwahl</td>
                              <td>0</td>
                              <td>hier ein Bild</td>
                          </tr>
                          <tr>
                              <td>Tiger</td>
                              <td>Hawewerwerlt</td>
                              <td>Schulsprecherwahl</td>
                              <td>0</td>
                              <td>hier ein Bild</td>
                          </tr>
                          <tr>
                              <td>Tiger</td>
                              <td>Hawewerwerlt</td>
                              <td>Schulsprecherwahl</td>
                              <td>0</td>
                              <td>hier ein Bild</td>
                          </tr>
                          <tr>
                              <td>Tiger</td>
                              <td>Hawewerwerlt</td>
                              <td>Schulsprecherwahl</td>
                              <td>0</td>
                              <td>hier ein Bild</td>
                          </tr>


                      </tbody>
                      <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Beschreibung</th>
                            <th>Typ</th>
                            <th>Level</th>
                            <th>Bild</th>
                          </tr>
                      </tfoot>
                  </table>
                  <div class="row">
                    <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Bearbeiten</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                      <label for="inputText3" class="col-form-label">Nachname</label>
                                      <input id="inputText3" type="text" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="inputText4" class="col-form-label">Vorname</label>
                                      <input id="inputText4" type="text" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="inputText5" class="col-form-label">E-Mail</label>
                                      <input id="inputText5" type="email" class="form-control">
                                  </div>
                                  <div class="form-group">
                                      <label for="inputText6" class="col-form-label">Geburtsdatum</label>
                                      <input id="inputText6" type="date" class="form-control">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                                    <a href="#" class="btn btn-primary">Änderung speichern</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ansicht für Tiger</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                </div>
                                <div class="modal-body">
                                  <a href="#" class="btn btn-light mx-2 my-2" data-dismiss="modal">E-Mail versenden</a>
                                  <a href="#" class="btn btn-light mx-2 my-2" data-dismiss="modal">Zugangsblatt downloaden</a>
                                  <a href="#" class="btn btn-light mx-2 my-2" data-dismiss="modal">Direkt-Link kopieren</a>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Schießen</a>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
