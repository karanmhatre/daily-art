@foreach($fields as $field)
<div class="pure-control-group">
  <label for="{{ $field['name'] }}">{{ Str::title($field['name']) }}</label>

  @if($field['type'] == 'text')
    <textarea name="{{ $field['name'] }}" id="" cols="30" rows="10" placeholder="{{ Str::title($field['name']) }}">{{ $object[$field['name']] }}</textarea>
  @endif

  @if($field['type'] == 'string')
    <input type="text" name="{{ $field['name'] }}" value="{{ $object[$field['name']] }}">
  @endif

  @if($field['type'] == 'image')
    @if(!empty($object[$field['name']]))
      <img src="{{ URL::asset($object[$field['name']]) }}" alt="" class="admin_images">
    @endif
    <input type="file" name="{{ $field['name'] }}">
  @endif

  @if($field['type'] == 'url')
    <input type="url" name="{{ $field['name'] }}" value="{{ $object[$field['name']] }}">
  @endif
</div>
@endforeach