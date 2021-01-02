
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit" method="POST">

                        <input type="hidden" name="electionUUID" value="{{$electionUUID}}">
                        <div class="form-group">
                            <label for="voterName" class="col-form-label">Name</label>
                            <input wire:model="voterName" name="voterName" id="voterName" type="text" placeholder="Mustermann" class="form-control">
                            @error('voterName') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="voterSurame" class="col-form-label">Surname</label>
                            <input wire:model="voterSurname" name="voterSurname" id="voterSurname" type="text" placeholder="Max" class="form-control">
                            @error('voterSurname') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="voterDate" class="col-form-label">Geburtsdatum</label>
                            <input wire:model="voterDate" name="voterDate" id="voterDate" type="date" class="form-control">
                            @error('voterDate') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="voterEmail">E-Mail Adresse</label>
                            <input wire:model="voterEmail" name="voterEmail" id="voterEmail" type="email" placeholder="name@beispiel.de" class="form-control">
                            @error('voterEmail') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="voterForm">Forms</label>
                            <select wire:model="form" name="voterForm" class="form-control" id="voterForm">
                                <option value="">Select a form</option>
                                @foreach($forms as $form)
                                    <option value="{{$form->id}}">{{$form->name}}</option>
                                @endforeach
                            </select>
                            @error('form') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="voterClass">Classes</label>
                            <select wire:model="class" name="voterClass" class="form-control" id="voterClass">
                                <option value="">Select a class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                            @error('class') <span class="error text-danger"> {{ $message }} </span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input wire:model="directly" type="radio" name="radio-inline" class="custom-control-input" value="true"><span class="custom-control-label">Create direct access</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input wire:model="directly" type="radio" name="radio-inline" class="custom-control-input" value="false"><span class="custom-control-label">Do not create direct access</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

