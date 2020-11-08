<div>
  <div class="row justify-content-center">
  <div class="col-md-10">
  <div class="card">
  <div class="card-header">{{ __('Voters-Table') }}</div>
    <div class="card-body">
      <div class="form-group">
          <input wire:model.debounce.300ms="search" type="text" class="" placeholder="Search users...">

          <select wire:model="orderBy" class="" id="">
              <option value="id">ID</option>
              <option value="name">Name</option>
              <option value="email">Email</option>
              <option value="created_at">Sign Up Date</option>
          </select>

          <select wire:model="orderAsc" class="" id="">
              <option value="1">Ascending</option>
              <option value="0">Descending</option>
          </select>

          <select wire:model="perPage" class="" id="">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
          </select>

      </div>
    </div>
  <table class="table col-md-11 table-bordered">
      <thead class="thead-dark">
          <tr>
              <th scope="col" class="">ID</th>
              <th scope="col" class="">Name</th>
              <th scope="col" class="">Email</th>
              <th scope="col" class="">Created At</th>
          </tr>
      </thead>
      <tbody>
          @foreach($voters as $voter)
              <tr>
                  <td scope="col" class="">{{ $voter->id }}</td>
                  <td class="">{{ $voter->surname }}</td>
                  <td class="">{{ $voter->email }}</td>

              </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
