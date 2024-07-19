import Dropzone from 'dropzone';
import CrutchTemplate from './crutch-zone.html';

Dropzone.autoDiscover = false;

const crutchOptions = {
  previewTemplate: CrutchTemplate.replace(/\n*/g, ''),
  headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
  dictRemoveFile: 'Удалить',
  paramName: 'file',
  autoDiscover: false,
  acceptedFiles: 'image/*',
  addRemoveLinks: true,
};

if (typeof jQuery !== 'undefined' && jQuery !== null) {
  jQuery.fn.crutchZone = function (options) {
    options = Dropzone.extend({}, crutchOptions, options != null ? options : {});
    return this.each(function () {
      return new Dropzone(this, options);
    });
  };
}
