<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	
	<td>
        <textarea name="content[top][{{$id}}][html_icon]" class="form-control" rows="5">{{ @$val->html_icon }}</textarea>
    </td>
	<td>
        <textarea name="content[top][{{$id}}][desc]" class="form-control" rows="5">{{ @$val->desc }}</textarea>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>