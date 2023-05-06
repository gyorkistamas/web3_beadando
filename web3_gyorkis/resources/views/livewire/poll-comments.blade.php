<div class="mt-5">
    @auth
        <form wire:submit.prevent="saveComment">
            <div class="d-flex justify-content-center align-items-center flex-lg-row flex-column">
                <div class="form-floating" data-bs-theme="dark" style="min-width: 50%">
                    <textarea class="form-control @error('comment') is-invalid @else @if($comment != "") is-valid @endif @enderror" placeholder="Leave a comment here" id="floatingTextarea2"  style="width: 100%; height: 100%;" wire:model="comment" name="comment"></textarea>
                    <label for="floatingTextarea2">{{__('Üzenet')}}</label>
                    @error('comment')
                    <div class="alert alert-danger mt-2" role="alert">
                        Legalább 5 karakter legyen!
                    </div>
                    @enderror
                </div>
                <div class="mt-5 mt-lg-0 ms-0 ms-lg-5 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-send me-2"></i>{{__('Küldés')}}</button>
                </div>

                <div class="spinner-border ms-2" role="status" wire:loading wire:target="saveComment">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>
    @endauth

    <div class="my-2">
        {{$comments->links()}}
    </div>

    <div class="d-flex flex-column justify-content-center align-items-center mt-3">
        @if($poll->comments->count() == 0)
            <h1>{{__('Nincsenek kommentek!')}}</h1>
        @else
            @foreach($comments as $comment)
                <div class="card mt-3 w-100" data-bs-theme="dark">
                    <div class="card-header">
                        <img class="profilPic" src="{{$comment->user->gravatarLink()}}"/>{{$comment->user->name}} írta ekkor: {{$comment->created_at->format('Y.m.d, h:m')}}
                    </div>
                    <div class="card-body">
                        {{$comment->comment_text}}
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="mt-2">
        {{$comments->links()}}
    </div>

</div>
