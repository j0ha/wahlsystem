
<div class="eao-vote-body">
  @if($state == 'start')
    <div class="d-flex align-items-center justify-content-center h-100">
      <div class="w-50 h-30 d-flex justify-content-center align-items-center">
        <div class="col">
          @if($election->logo)
          <div class="row mb-5">
            <img class="mx-auto" src="{{$election->logo}}" alt="">
          </div>
          @endif
          <div class="row justify-content-center">
            <span class="display-3">{{$election->name}}</span>
          </div>
           <div class="row justify-content-center mt-5 w-100 h-10">
             <button wire:click="nextStep()" type="button" name="button" class="btn btn-primary btn-lg btn-block px-0 mx-0">Start</button>
           </div>
        </div>
      </div>
    </div>
  @endif
  @if($state == 'end')
  <div class="d-flex align-items-center justify-content-center h-100">
    <div class="w-50 h-30 d-flex justify-content-center align-items-center">
      <div class="col">
        @if($election->logo)
        <div class="row mb-5">
          <img class="mx-auto" src="{{$election->logo}}" alt="">
        </div>
        @endif
        <div class="row justify-content-center">
          <span class="display-3">{{$election->name}}</span>
        </div>
         <div class="row justify-content-center">
           <span>Vielen Dank für deine Stimme!</span>
         </div>
         <div class="row justify-content-center">
           @if($election->type == config('electionmodes.spv.short') AND $directUUID == null) <span>Bitte verlasse nun die Wahlkabine!</span>@endif
           @if($directUUID != null)<span>Du kannst diese Seite nun schließen</span>@endif
         </div>
      </div>
    </div>
  </div>
          @if($directUUID == null AND $election->type == config('electionmodes.spv.short'))
              <script type="text/javascript">
                window.setTimeout(function(){
                    window.location.href = "{{$spv_terminal_route}}";
                }, 5000);
              </script>
          @endif
  @endif

      @if(($state == 'forms' AND $spv_forms == null) OR ($state == 'schoolclasses' AND $spv_schoolclasses == null) OR ($state == 'voters' AND $spv_voters == null))
          <div class="d-flex align-items-center justify-content-center h-100">
              <div class="w-50 h-30 d-flex justify-content-center align-items-center">
                  <div class="col">
                      @if($election->logo)
                          <div class="row mb-5">
                              <img class="mx-auto" src="{{$election->logo}}" alt="">
                          </div>
                      @endif
                      <div class="row justify-content-center">
                          <span class="display-3">{{$election->name}}</span>
                      </div>
                      <div class="row justify-content-center">
                          <span><b>Aktuell sind keine Wähler aktiv.</b></span>
                      </div>
                      <div class="row justify-content-center">
                          <span>versuche es später erneut!</span>
                      </div>
                  </div>
              </div>
          </div>
          <script type="text/javascript">
              window.setTimeout(function(){
                  window.location.href = "{{$spv_terminal_route}}";
              }, 5000);
          </script>
      @endif

  @if($state == 'forms' AND $election->type == config('electionmodes.spv.short') AND $spv_forms != null)
  <div class="d-flex eao-vote-header">
    <span class="display-4">Bitte wähle deinen Jahrgang!</span>
  </div>
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_forms as $form)
        <button type="button" wire:click="spvOpenSchoolclasses('{{$form->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$form->name}}</button>
      @endforeach
    </div>
  @endif

  @if($state == 'schoolclasses' AND $election->type == config('electionmodes.spv.short') AND $spv_schoolclasses != null)
  <div class="d-flex eao-vote-header">
    <span class="display-4">Bitte wähle deine Klasse!</span>
  </div>
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_schoolclasses as $schoolclass)
        <button type="button" wire:click="spvOpenVoters('{{$schoolclass->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$schoolclass->name}}</button>
      @endforeach
    </div>
  @endif
  @if($state == 'voters' AND $election->type == config('electionmodes.spv.short') AND $spv_voters != null)
  <div class="d-flex eao-vote-header">
    <span class="display-4">Bitte wähle deinen Namen!</span>
  </div>
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_voters as $voter)
        <button type="button" wire:click="spv_birthVerification('{{$voter->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$voter->name}} {{$voter->surname}}</button>
      @endforeach
    </div>
  @endif

  @if($state == 'birth_verification' AND $election->type == config('electionmodes.spv.short'))
  <div class="d-flex eao-vote-header">
    <span class="display-4">Bitte verifiziere Dich!</span>
  </div>

    <div class="eao-vote-content">
      <div class="container-fluid h-100 w-100 d-inline-block px-0 mx-0">
        <div class="row h-90 w-100 px-0 mx-0">
          <div class="col d-flex">

            <div class="row w-100 h-5 align-self-center">
              <div class="mx-auto">
                <p>Bitte gebe deinen Geburtstag ein um dich zu verifizieren.</p>
                <div class="mx-auto">
                  <form wire:submit.prevent="validation">
                  @error('spv_birthday_day') <span class="error">{{ $message }}</span> @enderror
                  @error('spv_birthday_month') <span class="error">{{ $message }}</span> @enderror
                  @error('spv_birthday_year') <span class="error">{{ $message }}</span> @enderror
                  <input wire:model.lazy="spv_birthday_day" type="number" name="" value="" placeholder="02" class="form-less">.<input wire:model.lazy="spv_birthday_month" type="number" name="" value=""placeholder="12" class="form-less">.<input wire:model.lazy="spv_birthday_year" type="number" name="" value=""placeholder="2002" class="form-less">
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
        <div class="row h-10 w-100 px-0 mx-0">
          <button wire:click="validation" type="button" name="button" class="btn btn-primary btn-lg btn-block px-0 mx-0">Zur Abstimmung</button>
        </div>
      </div>
    </div>


  @endif

  @if($state == 'vote' AND $election->type == config('electionmodes.spv.short'))
  <div class="d-flex eao-vote-header">
    <span class="display-4">Bitte stimme ab!</span>
  </div>
  <div class="h-90 w-100">
    <div class="container-fluid h-100 w-100 d-inline-block px-0 mx-0">
      <div class="row h-90 w-100 px-0 mx-0">
        @foreach($spv_candidates as $candidate)
        <div class="col h-100 px-0">

          <div class="h-90 eao-vote-bg-lite img-cover justify-content-center" style="background-image: url({{$candidate->image}})">
              <div class="align-self-center w-75">
                <h1 class="display-1">
                  {{$candidate->name}}
                </h1>
                <p>{{$candidate->description}}</p>
              </div>
          </div>
          <div class="row h-10 w-100 px-0 mx-0">
            <button wire:click="select('{{$candidate->uuid}}')" type="button" name="button" class="btn eao-vote-btn-select btn-lg btn-block px-0 mx-0 eao-vote-noborder">{{$candidate->name}} auswählen</button>
          </div>
        </div>

        @endforeach
      </div>
      <div class="row h-10 w-100 px-0 mx-0">
        <button wire:click="vote()" type="button" name="button" class="btn btn-primary btn-lg btn-block px-0 mx-0 eao-vote-noborder" @if(!$spv_selected_candidate_uuid) disabled @endif>Für {{$spv_selected_candidate_name ?? '...'}} Abstimmen</button>
      </div>
    </div>
  </div>
  @endif

  @if($state != 'start' AND $state != 'end')
    <div class="d-flex justify-content-between eao-vote-footer">
      <button wire:click="back()" class="btn btn-secondary mx-3" type="button"@if($state == 'vote' OR $state == 'voters') disabled @endif>Schritt zurück</button>
      <span>{{$election->name}}</span>
      <button wire:click="abbort()" class="btn btn-light mx-3" type="button">Abbrechen</button>
    </div>
  @endif

  <div class="eao-vote-modal-show" wire:loading>
    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center eao-vote-alert-bg-light">
        <div class="eao-loader">
        </div>
        <span class="mt-3">Bitte warten. Lade...</span>
    </div>
  </div>

  <div class="eao-vote-modal-show" wire:offline>
    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center eao-vote-alert-bg-danger">
        <div class="eao-loader">
        </div>
        <span class="mt-3">Verbindung zum Server verloren, bitte warten!</span>
        <span class="mt-3">Die Seite zu aktualisieren, behebt das Problem vielleicht.</span>
    </div>
  </div>

</div>
