@foreach($fields as $field)
<div class="pure-control-group">
  <label for="{{ $field['name'] }}">{{ Str::title($field['name']) }}</label>

  @if($field['type'] == 'text')
    <textarea name="{{ $field['name'] }}" id="" cols="30" rows="10" placeholder="{{ Str::title($field['name']) }}"></textarea>
  @endif

  @if($field['type'] == 'string')
    <input type="text" name="{{ $field['name'] }}">
  @endif

  @if($field['type'] == 'image')
    <input type="file" name="{{ $field['name'] }}">
  @endif

  @if($field['type'] == 'url')
    <input type="url" name="{{ $field['name'] }}">
  @endif
</div>
@endforeach