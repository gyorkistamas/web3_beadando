<div>
    <!-- TODO: check if there are no polls for the user and display a message -->
    <div class="row d-flex align-items-center">
        <div class="form-floating mb-3 col-12 col-md-5" data-bs-theme="dark">
            <input type="text" class="form-control" id="floatingInput" placeholder="a" wire:model="searchText" wire:change="updateSearch">
            <label for="floatingInput" class="ms-3">{{__('Keresés')}}</label>
        </div>
        <div class="form-check form-switch col-12 col-md-5 ms-3 mb-3 mb-lg-0">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model="onlyRunning" wire:change="updateSearch">
            <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Csak futó kérdőívek megjelenítése')}}</label>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach($polls as $poll)
            <div class="col">
                <x-poll-data-card :poll="$poll" />
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end mt-5">
        {{$polls->links()}}
    </div>
</div>
