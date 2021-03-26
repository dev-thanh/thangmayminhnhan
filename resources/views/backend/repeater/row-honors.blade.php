<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Hình ảnh</label>
			<div class="image">
	           	<div class="image__thumbnail">
	               <img src="{{ !empty($value->image) ? $value->image : __IMAGE_DEFAULT__ }}"  
	               data-init="{{ __IMAGE_DEFAULT__ }}">
	               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
	                <i class="fa fa-times"></i></a>
	               <input type="hidden" value="{{ @$value->image }}" name="content[honors][list][{{ $key }}][image]"  />
	               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	           	</div>
	       	</div>
		</div>
	</td>
	<td>
		<div class="col-sm-12">
			<div class="form-group">
				<label for="">Tên Vinh danh</label>
				<input type="text" name="content[honors][list][{{ $key }}][name]" class="form-control" value="{{ @$value->name }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Tiêu đề</label>
				<input type="text" name="content[honors][list][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
			</div>
			<div class="form-group">
				<label for="">Địa chỉ</label>
				<input type="text" name="content[honors][list][{{ $key }}][address]" class="form-control" value="{{ @$value->address }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="">Số điện thoại</label>
				<input type="text" name="content[honors][list][{{ $key }}][phone]" class="form-control" value="{{ @$value->phone }}">
			</div>
			<div class="form-group">
				<label for="">Liên kết</label>
				<input type="text" name="content[honors][list][{{ $key }}][link]" class="form-control" value="{{ @$value->link }}">
			</div>
		</div>
    </td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>