<?php

namespace App\Http\Livewire;

use App\Voter;
use Livewire\Component;
use Livewire\WithPagination;

class VotersTable extends Component
{
  use WithPagination;

  public $perPage = 10;
  public $search = '';
  public $orderBy = 'id';
  public $orderAsc = true;

  public function render()
  {
      return view('livewire.voters-table', [
          'voters' => Voter::search($this->search)
              ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
              ->simplePaginate($this->perPage),
      ]);
  }
}
