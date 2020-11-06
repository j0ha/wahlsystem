<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Delete Account') }}</div>

                <div class="card-body">
                  <?php // TODO: Route muss noch festgelegt werden ?>
                    <form method="POST" action="{{route('deleteAccount')}}">
                        @csrf

                        @if($step==0)
                        <div class="form-group row">
                            <h3 for="question" class="col-md-4 col-form-label text-md-right">{{ __('Do you want to delete your profile?') }}</h3>
                        </div>
                        @endif


                        @if($step==1)
                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Delete profile with Email:') }}</label>

                            <div class="col-md-6">
                                <label id="email" class="form-control" name="email">{{$user->email}}</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-danger">{{ __('Delete') }}</button>
                            </div>
                        </div>
                        @endif

                        @if($step > 0 && $step <= 1)
                          <!-- Submit Button -->
                          <button type="button" wire:click="decreaseStep" class="btn btn-primary">Backwards</button>
                        @endif
                        @if($step < 1)
                          <!-- Submit Button -->
                          <button type="button" wire:click="increaseStep" class="btn btn-primary">Next</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
