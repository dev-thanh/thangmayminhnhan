<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	{{-- <td class="index">{{ $index }}</td> --}}
	<td>
        <div class="form-group">
			<textarea id="content{{ $key }}" name="content[price][content][{{ $key }}][content]">{!! @$value->content !!}</textarea>
		</div>
	</td>
	<td>
        <div class="form-group">
            <input type="text" name="content[price][content][{{ $key }}][dvt]" class="form-control" value="{{ @$value->dvt }}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" name="content[price][content][{{ $key }}][price]" class="form-control" value="{{ @$value->price }}">
        </div>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>

<script>
	CKEDITOR.replace( 'content{{ $key }}' );
</script>