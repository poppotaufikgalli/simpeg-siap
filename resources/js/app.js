import './bootstrap';

// Import our custom CSS
import '../scss/styles.scss'


// Import all of Bootstrap's JS
import { createPopper } from '@popperjs/core';
import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap;

import TomSelect from 'tom-select'
window.TomSelect = TomSelect;

import Dropzone from "dropzone";
window.Dropzone = Dropzone;

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
window.Notyf = Notyf
//import * as Editor from '../ckeditor5-A/build/ckeditor';
//console.log(Editor)
//import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
//window.ClassicEditor = Editor

//import GLightbox from 'glightbox';
import * as GLightbox from 'glightbox/dist/js/glightbox';
window.GLightbox = GLightbox

import DataTable from "datatables.net-bs5"
window.DataTable = DataTable

import IMask from 'imask';
window.IMask = IMask;

//import Chart from 'chart.js/auto';
//window.Chart = Chart;

//import { getRelativePosition } from 'chart.js/helpers';

import "bootstrap-icons/font/bootstrap-icons.css";

import './ckEmbedMedia'