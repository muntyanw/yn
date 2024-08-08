<div class="dynamic-field">
    <div class="form-group">
        <label for="text">{{ __('Text') }}</label>
        <textarea class="form-control ckeditor" name="texts[]" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="photo">{{ __('Photo') }}</label>
        <input type="file" class="form-control-file photo-upload" name="photosCK[]">
        @error('photos.*')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="photo-preview mt-2"></div>
    </div>
</div>
