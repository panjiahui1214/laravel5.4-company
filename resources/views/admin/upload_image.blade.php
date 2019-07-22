<input type="file" name="{{ $name }}" accept="image/*" class="upload-input" onchange="path.value=this.files[0].name" />
<button class="upload-text">{{ $action }}图片</button>
<input name="path" style="border: none; width: 250px;" readonly="readonly" />
&nbsp;&nbsp;&nbsp;
<span class="red">{{ $errors->first($name) ? $errors->first($name) : Session::get('errors_image') }}</span>