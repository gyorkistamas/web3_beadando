<div>
    <div class="row d-flex align-items-center">
        <div class="form-floating mb-3 col-12 col-md-5" data-bs-theme="dark">
            <input type="text" class="form-control" id="floatingInput" placeholder="a" wire:model="searchText" wire:change="updateSearch">
            <label for="floatingInput" class="ms-3">{{__('Keresés')}}</label>
        </div>
        <div class="form-check form-switch col-12 col-md-5 ms-3 mb-3 mb-lg-0">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model="onlyRunning" wire:change="updateSearch">
            <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Csak futó kérdőívek megjelenítése')}}</label>
            <button class="btn btn-primary ms-3" type="button" wire:click="update"><i class="bi bi-arrow-clockwise me-2"></i>{{__('Frissítés')}}</button>
        </div>

        <div class="spinner-border text-primary mb-3 mb-lg-0 ms-5 ms-lg-0" role="status" wire:loading.flex>
            <span class="visually-hidden">Loading...</span>
        </div>

        <div class="d-flex justify-content-center">
            {{$polls->links()}}
        </div>
    </div>

    @if(count($polls) == 0)
        <div class="row">
            <h1>{{__('Nincs találat')}}</h1>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($polls as $poll)
                <div class="col">
                    <livewire:poll-data-wire :poll="$poll" :key="$poll->id"/>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$polls->links()}}
        </div>
    @endif
</div>
