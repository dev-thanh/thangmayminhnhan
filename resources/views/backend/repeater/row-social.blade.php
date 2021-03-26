<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ @$val->name }}"></td>
	<td>
        <div class="image">
            <div class="image__thumbnail">
                <img src="{{ !empty($val->icon) ? url('/').$val->icon : __IMAGE_DEFAULT__ }}"  
                data-init="{{ __IMAGE_DEFAULT__ }}">
                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
                <input type="hidden" value="{{ @$val->icon }}" name="content[social][{{ $id }}][icon]"  />
                <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
            </div>
        </div>
    </td>
	<td>
        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ @$val->link }}">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>