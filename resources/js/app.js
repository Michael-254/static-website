import './bootstrap';

import Alpine from 'alpinejs';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import tinymce from 'tinymce';

 

window.Alpine = Alpine;

Alpine.start();


const inputElement = document.querySelector('input[type="file"].filepond');
 
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
 
FilePond.create(inputElement).setOptions({
    server: {
        url: '/file-upload',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    }
});

tinymce.init({
    selector: '#myTextarea',
    plugins: 'advlist autolink lists link image charmap print preview anchor',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
  });