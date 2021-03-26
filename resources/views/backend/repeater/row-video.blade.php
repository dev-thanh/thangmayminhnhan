<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	
	<td>
		<div class="form-group">
			<label for="">Link video</label>
			<input type="text" name="content[video][{{ $key }}][link]" class="form-control" value="{{ @$value->link }}">
		</div>
		<div class="form-group">
			<label for="">Mô tả ngắn</label>
			<textarea class="form-control" name="content[video][{{ $key }}][desc]">{{ @$value->desc }}</textarea>
		</div>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>