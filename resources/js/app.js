import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
// const feather = require('feather-icons')
import * as FilePond from 'filepond';
// import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
// import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
// import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';
// import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
// import FilePondPluginPdfPreview from 'filepond-plugin-pdf-preview';
// import 'filepond/dist/filepond.min.css';
// import lozad from 'lozad';


// FilePond.registerPlugin(
//     FilePondPluginImagePreview,
//     FilePondPluginFileValidateType,
//     FilePondPluginFileValidateSize,
//     FilePondPluginImageValidateSize,
//     FilePondPluginImageCrop,
//     FilePondPluginPdfPreview
// );


window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

// export { FilePond, lozad };

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     // Additional configurations if needed
// });
