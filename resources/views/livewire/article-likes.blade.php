<div>
    <div class="align-items-center text-center mt-6">
        <p class="mb-6">
            Did this help solve your issue?
        </p>
        <div class="btn-group me-4 mb-6">
            <input type="radio" class="btn-check" name="helpFiveVote" id="helpFiveUp">
            <label wire:click="like" class="btn btn-sm text-dark fs-lg" for="helpFiveUp">
                <i class="fal fa-thumbs-up @if($article->reacted()) {{ $article->isLiked() ? 'text-success' : '' }} @else @endif"></i>
            </label>
            <input type="radio" class="btn-check" name="helpFiveVote" id="helpFiveDown">
            <label wire:click="dislike" class="btn btn-sm text-dark fs-lg" for="helpFiveDown">
                <i class="fal fa-thumbs-down @if($article->reacted()) {{ $article->disLiked() ? 'text-success' : '' }} @else @endif"></i>
            </label>
        </div>
        <p class="fs-sm text-muted">
            {{$article->likes()}} out of {{$article->reactions()}} found this helpful
        </p>

    </div>
</div>