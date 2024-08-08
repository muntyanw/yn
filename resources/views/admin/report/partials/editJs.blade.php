@include('admin.partials.ckeditorjs')

<script>
    let uploadedPhotos = [];

    $(document).ready(function() {
        // Initialize CKEditor for existing textareas
        initCKEditor();

        // Add new block of text and photo
        $('#addField').on('click', function() {
            let newField = `@include('admin.report.partials.oneField')`;
            $('#dynamicFields').append(newField);

            // Initialize CKEditor for new textarea
            initCKEditor();
        });

        // Handle photo uploads
        $(document).on('change', '.photo-upload', function(event) {
            let fileInput = $(this);
            let file = fileInput[0].files[0];
            let formData = new FormData();
            formData.append('photo', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '{{ route('admin_report_upload_photo') }}', // Create a route for photo upload
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        let editorIndex = $('.photo-upload').index(fileInput);
                        let photoPreviewDiv = fileInput.next('.photo-preview');
                        photoPreviewDiv.html(
                            `<img src="${response.url}" class="img-thumbnail" width="150">`
                            );
                        uploadedPhotos[editorIndex] = response.url;
                    } else {
                        alert('Error uploading photo: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });

        // Form submission
        $('#butsub').on('click', function(event) {
            event.preventDefault();

            let formData = new FormData(document.getElementById("reportForm"));
            let combinedContent = '';

            // Synchronize CKEditor instances
            window.editorInstances.forEach((editorInstance, index) => {
                const editorData = editorInstance.getData();
                $(`textarea[name="texts[]"]`).eq(index).val(
                editorData); // Update the textarea with editor data
                combinedContent += editorData;

                if (uploadedPhotos[index]) {
                    combinedContent += `@include('admin.report.partials.onePhoto', ['src' => '${uploadedPhotos[index]}'])`;
                }
            });

            formData.append('combined_content', combinedContent);

            // Add all photos and files to the formData
            $('input[name="photos[]"]').each(function(index, element) {
                let files = element.files;
                for (let i = 0; i < files.length; i++) {
                    formData.append('photos[]', files[i]);
                }
            });

            $('input[name="files[]"]').each(function(index, element) {
                let files = element.files;
                for (let i = 0; i < files.length; i++) {
                    formData.append('files[]', files[i]);
                }
            });

            $('#butsub').prop('disabled', true);
            $('#waitico').show();

            $.ajax({
                url: $('#reportForm').attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == "ok") {
                        //window.location.href = "{{ route('admin_report_list') }}";
                        $('#butsub').prop('disabled', false);
                        $('#waitico').hide();
                    } else {
                        alert('Error: ' + response.message);
                        $('#butsub').prop('disabled', false);
                        $('#waitico').hide();
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + xhr.responseText);
                    $('#butsub').prop('disabled', false);
                    $('#waitico').hide();
                }
            });
        });


        // Delete photo
        window.deletePhoto = function(reportId, photoId) {
            if (confirm('{{ __('Are you sure you want to delete this photo?') }}')) {
                $.ajax({
                    url: `/admin_panel/reports/${reportId}/photo-remove/${photoId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            location.reload();
                        }
                    }
                });
            }
        }

        // Delete file
        window.deleteFile = function(reportId, fileId) {
            if (confirm('{{ __('Are you sure you want to delete this file?') }}')) {
                $.ajax({
                    url: `/admin_panel/reports/${reportId}/file-remove/${fileId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            location.reload();
                        }
                    }
                });
            }
        }
    });

    function previewImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('photoPreviews');
    previewContainer.innerHTML = ''; // Clear previous previews

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.width = 150;

            const link = document.createElement('a');
            link.href = e.target.result;
            link.target = '_blank';
            link.className = 'btn btn-primary btn-sm ml-3';
            link.innerText = 'Посмотреть изображение';

            link.addEventListener('click', function(event) {
                event.preventDefault();
                const newWindow = window.open();
                if (newWindow) {
                    newWindow.document.write('<img src="' + e.target.result + '" />');
                } else {
                    alert('Не удалось открыть новое окно. Разрешите всплывающие окна для этого сайта.');
                }
            });

            const div = document.createElement('div');
            div.className = 'mb-2 d-flex align-items-center';
            div.appendChild(img);
            div.appendChild(link);

            previewContainer.appendChild(div);
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
}


        function previewFiles(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('filePreviews');
            previewContainer.innerHTML = ''; // Clear previous previews

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const link = document.createElement('a');
                    link.href = e.target.result;
                    link.target = '_blank';
                    link.className = 'btn btn-primary btn-sm';
                    link.innerText = '{{ __('View File') }}';

                    const div = document.createElement('div');
                    div.className = 'mb-2 d-flex align-items-center';
                    div.appendChild(link);

                    previewContainer.appendChild(div);
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }

</script>
