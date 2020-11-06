<div class="" >
  <div class="">
      <div class="">
          <input wire:model.debounce.300ms="search" type="text" class="" placeholder="Search users...">
      </div>
      <div class="">
          <select wire:model="orderBy" class="" id="">
              <option value="id">ID</option>
              <option value="name">Name</option>
              <option value="email">Email</option>
              <option value="created_at">Sign Up Date</option>
          </select>
          
      </div>
      <div class="">
          <select wire:model="orderAsc" class="" id="">
              <option value="1">Ascending</option>
              <option value="0">Descending</option>
          </select>

      </div>
      <div class="">
          <select wire:model="perPage" class="" id="">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
          </select>

      </div>
  </div>
  <table class="">
      <thead>
          <tr>
              <th class="">ID</th>
              <th class="">Name</th>
              <th class="">Email</th>
              <th class="">Created At</th>
          </tr>
      </thead>
      <tbody>
          @foreach($voters as $voter)
              <tr>
                  <td class="">{{ $voter->id }}</td>
                  <td class="">{{ $voter->surname }}</td>
                  <td class="">{{ $voter->email }}</td>

              </tr>
          @endforeach
      </tbody>
  </table>

</div>
