<li>
  <div class="comment-main-level">
    <div class="comment-avatar">
      @if(empty($comment->user->avatar))
        <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar">
      @else
        <img src="{{ URL::asset($comment->user->avatar) }}" alt="{{ $comment->user->name }}">
      @endif
    </div>
    <div class="comment-box">
      <div class="comment-head">
        <h6 class="comment-name
          @if($comment->user->id == $art->user->id)
            by-author
          @endif
        "><a href="{{ URL::route('user.profile', [$comment->user->id, Str::slug($comment->user->name)]) }}">{{ $comment->user->name }}</a></h6>
        <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
      </div>
      <div class="comment-content">
        {{{ $comment->body }}}
      </div>
    </div>
  </div>
</li>