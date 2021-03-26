<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
        <div class="form-group">
            <div class="image">
                <div class="image__thumbnail">
                   <img src="{{ !empty(@$val->image) ? url('/').@$val->image : __IMAGE_DEFAULT__ }}"  
                   data-init="{{ __IMAGE_DEFAULT__ }}">
                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                   <input type="hidden" value="{{ @$val->image }}" name="content[payment_methods][{{ $id }}][image]"  />
                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>   
    </td>
	<td>
        <div class="form-group">
            <input type="text" class="form-control" required="" name="content[payment_methods][{{$id}}][title]" value="{{ @$val->title }}">
        </div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>