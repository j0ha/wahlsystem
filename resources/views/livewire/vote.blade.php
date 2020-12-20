
  @if($state == 'start')
    <div class="d-flex align-items-center justify-content-center h-100">
      <div class="w-50 h-30 d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row mb-5">
            <img class="mx-auto" src="https://www.stadtteilschule-walddoerfer.de/fileadmin/stswa/images/theme/logo-stadtteilschule-walddoerfer.png" alt="">
          </div>
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

  @if($state == 'forms' AND $election->type == 'spv')
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_forms as $form)
        <button type="button" wire:click="spvOpenSchoolclasses('{{$form->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$form->name}}</button>
      @endforeach
    </div>
  @endif

  @if($state == 'schoolclasses' AND $election->type == 'spv')
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_schoolclasses as $schoolclass)
        <button type="button" wire:click="spvOpenVoters('{{$schoolclass->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$schoolclass->name}}</button>
      @endforeach
    </div>
  @endif
  @if($state == 'voters' AND $election->type == 'spv')
    <div class="d-flex flex-column eao-vote-btn-list">
      @foreach($spv_voters as $voter)
        <button type="button" wire:click="spv_birthVerification('{{$voter->uuid}}')" class="btn btn-primary eao-vote-btn-list-item">{{$voter->name}} {{$voter->surname}}</button>
      @endforeach
    </div>
  @endif

  @if($state == 'birth_verification' AND $election->type == 'spv')

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
                  <input wire:model.lazy="spv_birthday_day" type="number" name="" value="" placeholder="16" class="form-less">.<input wire:model.lazy="spv_birthday_month" type="number" name="" value=""placeholder="12" class="form-less">.<input wire:model.lazy="spv_birthday_year" type="number" name="" value=""placeholder="2000" class="form-less">
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

  @if($state == 'vote' AND $election->type == 'spv')
  <div class="h-90 w-100">
    <div class="container-fluid h-100 w-100 d-inline-block px-0 mx-0">
      <div class="row h-90 w-100 px-0 mx-0">
        @foreach($spv_candidates as $candidate)
        <div class="col h-100 px-0 bg-secondary img-cover justify-content-center" style="background-image: url({{$candidate->image}});">
            <div class="align-self-center w-75">
              <h1 class="display-1">
                {{$candidate->name}}
              </h1>
              <p>{{$candidate->description}}</p>
            </div>
        </div>
        @endforeach
      </div>
      <div class="row h-10 w-100 px-0 mx-0">
        <button type="button" name="button" class="btn btn-primary btn-lg btn-block px-0 mx-0">Abstimmen</button>
      </div>
    </div>
  </div>
  @endif

  @if($state != 'start' OR $state != 'end')
    <div class="d-flex eao-vote-footer">
      <span>{{$election->name}}</span>
    </div>
  @endif
