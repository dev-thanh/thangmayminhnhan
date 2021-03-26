<?php $key = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
        <div class="form-group">
            <label for="">Tiêu đề</label>
            <input type="text" class="form-control" name="content[content_5][list][{{$key}}][title]" value="{{ @$value->title }}">
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea id="content{{ $key }}" name="content[content_5][list][{{ $key }}][content]">{!! @$value->content !!}</textarea>
        </div>
    </td>
    <td>
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
	CKEDITOR.replace( 'content{{ $key }}' );
</script>