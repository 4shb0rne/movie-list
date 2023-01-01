@forelse ($watchlists as $wl)
    <div class="row watchlist-container mb-3">
        <div class="col-3 image-container">
            <img src="{{ asset('storage/movies/thumbnail/' . $wl->image_url) }}" class="watchlist-image" alt="image">
        </div>
        <div class="col-4">{{ $wl->title }}</div>
        <div
            class="col-3 {{ $wl->status == 'Planning' ? 'color-green' : ($wl->status == 'Watching' ? 'text-warning' : 'text-danger') }}">
            {{ $wl->status }}
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-icon" data-bs-toggle="modal"
                data-bs-target="{{ '#watchlistAction' . $wl->movie_id }}">
                <i class="fa-solid fa-ellipsis fs-3"></i>
            </button>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="{{ 'watchlistAction' . $wl->movie_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-background">
                <div class="modal-header" style="border: none;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('action-watchlist', ['movie'=>$wl->movie_id, 'page'=>$watchlists->currentPage()]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <select class="form-select form-input border-light actionInput" name="status" id="{{ 'action' . $wl->movie_id }}">
                            <option value="Planning">Planning</option>
                            <option value="Watching">Watching</option>
                            <option value="Finished">Finished</option>
                            <option value="Remove">Remove</option>
                        </select>
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-auth fw-bold">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@empty
    <h1>No Watchlist Found...</h1>
@endforelse
