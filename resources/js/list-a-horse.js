import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#location-select', {
        placeholder: 'Search for a location',
    });
    function previewImage(input, previewElement) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.src = e.target.result;
                previewElement.parentElement.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewMultipleImages(input, previewContainer) {
        if (input.files) {
            previewContainer.innerHTML = '';
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-32', 'object-cover', 'rounded-lg');
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    document.getElementById('main-image').addEventListener('change', function() {
        previewImage(this, document.querySelector('#main-image-preview img'));
    });

    document.getElementById('additional-images').addEventListener('change', function() {
        previewMultipleImages(this, document.getElementById('additional-images-preview'));
    });
});

