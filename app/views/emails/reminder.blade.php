<p>Hi {{$name}},</p>
<p>The topic for today's daily art is <b>{{ $theme }}</b><br>
  Make sure you put in your artwork for today.</p>
<p><a style="padding: 10px 15px;
    background-color: #333;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    text-decoration: none;" href="{{ URL::to('user') }}">Submit your artwork</a></p>
<br><br>
<p>Here's some great art to inspire you:</p>
<table style="width: 100%; margin: auto; border: none">
  <tr>
    @foreach($arts as $art)
      <td>
        <a style="border: 1px solid #ddd;
      padding: 5px;
      border-radius: 3px;
      background-color: #fff; display: block;" href="{{ URL::to('art', $art->id) }}">
          <img src="{{ URL::asset($art->image) }}" alt="{{ $art->caption }}" style="width: 100%"><br> {{ $art->user->name }}
        </a>
      </td>
    @endforeach
  </tr>
</table>
<p>Stay Creative!</p>
<p>Regards,<br>Daily Art</p>