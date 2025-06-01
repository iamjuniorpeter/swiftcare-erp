@props(['params'])

<div class="signature-field">
    <label>{{ $params['label'] }}</label>
    <input type="file" accept="image/*" name="{{ $params['name'] }}" id="{{ $params['name'] }}">
    <div id="{{ $params['name'] }}Preview" class="signature-preview"></div>
    <button type="button" id="{{ $params['name'] }}Delete" class="signature-delete" style="display: none;">Clear</button>
</div>

<script>
    const fileInput = document.getElementById('{{ $params['name'] }}');
    const previewDiv = document.getElementById('{{ $params['name'] }}Preview');
    const deleteSignatureBtn = document.getElementById('{{ $params['name'] }}Delete');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function() {
                const img = document.createElement('img');
                img.src = reader.result;
                img.style.maxWidth = '{{ $params['maxWidth'] ?? 100 }}%';
                previewDiv.innerHTML = '';
                previewDiv.appendChild(img);
                deleteSignatureBtn.style.display = 'inline-block';
            }

            reader.readAsDataURL(file);
        }
    });

    deleteSignatureBtn.addEventListener('click', function() {
        fileInput.value = null;
        previewDiv.innerHTML = '';
        deleteSignatureBtn.style.display = 'none';
    });
</script>

<style>
    .signature-field {
        margin-bottom: 20px;
    }

    .signature-preview {
        margin-top: 10px;
    }

    .signature-delete {
        display: none;
        border: none;
        background: transparent;
        color: red;
        cursor: pointer;
    }
</style>
