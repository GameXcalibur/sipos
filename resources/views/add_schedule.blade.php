@extends('layouts.app')

@section('title', 'Add Schedule')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Add Schedule</li>
    </ol>
@endsection

@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    /*! =========================================================
 *
 Material Bootstrap Wizard - V1.0.1
*
* =========================================================
*
* Copyright 2016 Creative Tim (http://www.creative-tim.com/product/material-bootstrap-wizard)
 *
 *                       _oo0oo_
 *                      o8888888o
 *                      88" . "88
 *                      (| -_- |)
 *                      0\  =  /0
 *                    ___/`---'\___
 *                  .' \|     |// '.
 *                 / \|||  :  |||// \
 *                / _||||| -:- |||||- \
 *               |   | \  -  /// |   |
 *               | \_|  ''\---/''  |_/ |
 *               \  .-\__  '-'  ___/-. /
 *             ___'. .'  /--.--\  `. .'___
 *          ."" '<  `.___\_<|>_/___.' >' "".
 *         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *         \  \ `_.   \_ __\ /__ _/   .-` /  /
 *     =====`-.____`.___ \_____/___.-`___.-'=====
 *                       `=---='
 *
 *     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 *               Buddha Bless:  "No Bugs"
 *
 * ========================================================= */
body {
  background-color: #E5E5E5;
  color: #3C4858;
}
body.inverse {
  background: #333333;
}
body.inverse, body.inverse .form-control {
  color: #ffffff;
}
body.inverse .modal,
body.inverse .modal .form-control,
body.inverse .panel-default,
body.inverse .panel-default .form-control,
body.inverse .card,
body.inverse .card .form-control {
  background-color: initial;
  color: initial;
}

blockquote p {
  font-style: italic;
}

.life-of-material-kit {
  background: #FFFFFF;
}

body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4 {
  font-family: "Roboto", "Helvetica", "Arial", sans-serif;
  font-weight: 300;
  line-height: 1.5em;
}

.serif-font {
  font-family: "Roboto Slab", "Times New Roman", serif;
}

a {
  color: #9c27b0;
}
a:hover, a:focus {
  color: #89229b;
  text-decoration: none;
}
a.text-info:hover, a.text-info:focus {
  color: #00a5bb;
}
a .material-icons {
  vertical-align: middle;
}

legend {
  border-bottom: 0;
}

* {
  -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
  -webkit-tap-highlight-color: transparent;
}
*:focus {
  outline: 0;
}

a:focus, a:active,
button:active, button:focus, button:hover,
button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
select::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner {
  outline: 0 !important;
}

.image-container {
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
  position: relative;
}
.image-container:before {
  content: "";
  display: block;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: #000000;
  opacity: .3;
}

.made-with-mk {
  width: 50px;
  height: 50px;
  display: block;
  position: fixed;
  z-index: 555;
  bottom: 40px;
  right: 40px;
  border-radius: 30px;
  background-color: rgba(16, 16, 16, 0.35);
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #FFFFFF;
  cursor: pointer;
  padding: 10px 12px;
  white-space: nowrap;
  overflow: hidden;
  -webkit-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -moz-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -o-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
}
.made-with-mk:hover, .made-with-mk:active, .made-with-mk:focus {
  width: 218px;
  color: #FFFFFF;
  transition-duration: .55s;
  padding: 10px 19px;
}
.made-with-mk:hover .made-with, .made-with-mk:active .made-with, .made-with-mk:focus .made-with {
  opacity: 1;
}
.made-with-mk:hover .brand, .made-with-mk:active .brand, .made-with-mk:focus .brand {
  left: 0;
}
.made-with-mk .brand,
.made-with-mk .made-with {
  float: left;
}
.made-with-mk .brand {
  position: relative;
  top: 4px;
  left: -1px;
  letter-spacing: 1px;
  vertical-align: middle;
  font-size: 16px;
  font-weight: 600;
}
.made-with-mk .made-with {
  color: rgba(255, 255, 255, 0.6);
  position: absolute;
  left: 58px;
  top: 14px;
  opacity: 0;
  margin: 0;
  -webkit-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -moz-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -o-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
}
.made-with-mk .made-with strong {
  font-weight: 400;
  color: rgba(255, 255, 255, 0.9);
}

.wizard-container {
  padding-top: 100px;
  z-index: 3;
}
.wizard-container .wizard-navigation {
  position: relative;
}

h1, .h1 {
  font-size: 3.8em;
  line-height: 1.15em;
}

h2, .h2 {
  font-size: 2.6em;
}

h3, .h3 {
  font-size: 1.825em;
  line-height: 1.4em;
  margin: 20px 0 10px;
}

h4, .h4 {
  font-size: 1.3em;
  line-height: 1.4em;
}

h5, .h5 {
  font-size: 1.25em;
  line-height: 1.4em;
  margin-bottom: 15px;
}

h6, .h6 {
  font-size: 0.9em;
  text-transform: uppercase;
}

.title,
.card-title,
.wizard-title {
  font-weight: 700;
}
.title,
.title a,
.card-title,
.card-title a,
.wizard-title,
.wizard-title a {
  color: #3C4858;
  text-decoration: none;
}

h2.title {
  margin-bottom: 30px;
}

.description,
.card-description,
.footer-big p {
  color: #999999;
}

.text-warning {
  color: #ff9800;
}

.text-primary {
  color: #9c27b0;
}

.text-danger {
  color: #f44336;
}

.text-success {
  color: #4caf50;
}

.text-info {
  color: #00bcd4;
}

.card {
  background-color: #FFFFFF;
  padding: 10px 0;
  width: 100%;
  border-radius: 6px;
  color: rgba(0,0,0, 0.87);
  background: #fff;
}

.wizard-card {
  min-height: 410px;
  box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.wizard-card .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
.wizard-card .picture {
  width: 106px;
  height: 106px;
  background-color: #999999;
  border: 4px solid #CCCCCC;
  color: #FFFFFF;
  border-radius: 50%;
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.wizard-card .picture:hover {
  border-color: #2ca8ff;
}
.wizard-card[data-color="purple"] .moving-tab {
  position: absolute;
  text-align: center;
  padding: 12px;
  font-size: 12px;
  text-transform: uppercase;
  -webkit-font-smoothing: subpixel-antialiased;
  background-color: #9c27b0;
  top: -4px;
  left: 0px;
  border-radius: 4px;
  color: #FFFFFF;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 16px 26px -10px rgba(156, 39, 176, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(156, 39, 176, 0.2);
}
.wizard-card[data-color="purple"] .picture:hover {
  border-color: #9c27b0;
}
.wizard-card[data-color="purple"] .choice:hover .icon, .wizard-card[data-color="purple"] .choice.active .icon {
  border-color: #9c27b0;
  color: #9c27b0;
}
.wizard-card[data-color="purple"] .form-group .form-control {
  background-image: linear-gradient(#9c27b0, #9c27b0), linear-gradient(#D2D2D2, #D2D2D2);
}
.wizard-card[data-color="purple"] .checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background-color: #9c27b0;
}
.wizard-card[data-color="purple"] .radio input[type=radio]:checked ~ .check {
  background-color: #9c27b0;
}
.wizard-card[data-color="purple"] .radio input[type=radio]:checked ~ .circle {
  border-color: #9c27b0;
}
.wizard-card[data-color="green"] .moving-tab {
  position: absolute;
  text-align: center;
  padding: 12px;
  font-size: 12px;
  text-transform: uppercase;
  -webkit-font-smoothing: subpixel-antialiased;
  background-color: #4caf50;
  top: -4px;
  left: 0px;
  border-radius: 4px;
  color: #FFFFFF;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 16px 26px -10px rgba(76, 175, 80, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(76, 175, 80, 0.2);
}
.wizard-card[data-color="green"] .picture:hover {
  border-color: #4caf50;
}
.wizard-card[data-color="green"] .choice:hover .icon, .wizard-card[data-color="green"] .choice.active .icon {
  border-color: #4caf50;
  color: #4caf50;
}
.wizard-card[data-color="green"] .form-group .form-control {
  background-image: linear-gradient(#4caf50, #4caf50), linear-gradient(#D2D2D2, #D2D2D2);
}
.wizard-card[data-color="green"] .checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background-color: #4caf50;
}
.wizard-card[data-color="green"] .radio input[type=radio]:checked ~ .check {
  background-color: #4caf50;
}
.wizard-card[data-color="green"] .radio input[type=radio]:checked ~ .circle {
  border-color: #4caf50;
}
.wizard-card[data-color="blue"] .moving-tab {
  position: absolute;
  text-align: center;
  padding: 12px;
  font-size: 12px;
  text-transform: uppercase;
  -webkit-font-smoothing: subpixel-antialiased;
  background-color: #00bcd4;
  top: -4px;
  left: 0px;
  border-radius: 4px;
  color: #FFFFFF;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 16px 26px -10px rgba(0, 188, 212, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 188, 212, 0.2);
}
.wizard-card[data-color="blue"] .picture:hover {
  border-color: #00bcd4;
}
.wizard-card[data-color="blue"] .choice:hover .icon, .wizard-card[data-color="blue"] .choice.active .icon {
  border-color: #00bcd4;
  color: #00bcd4;
}
.wizard-card[data-color="blue"] .form-group .form-control {
  background-image: linear-gradient(#00bcd4, #00bcd4), linear-gradient(#D2D2D2, #D2D2D2);
}
.wizard-card[data-color="blue"] .checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background-color: #00bcd4;
}
.wizard-card[data-color="blue"] .radio input[type=radio]:checked ~ .check {
  background-color: #00bcd4;
}
.wizard-card[data-color="blue"] .radio input[type=radio]:checked ~ .circle {
  border-color: #00bcd4;
}
.wizard-card[data-color="orange"] .moving-tab {
  position: absolute;
  text-align: center;
  padding: 12px;
  font-size: 12px;
  text-transform: uppercase;
  -webkit-font-smoothing: subpixel-antialiased;
  background-color: #ff9800;
  top: -4px;
  left: 0px;
  border-radius: 4px;
  color: #FFFFFF;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 16px 26px -10px rgba(255, 152, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(255, 152, 0, 0.2);
}
.wizard-card[data-color="orange"] .picture:hover {
  border-color: #ff9800;
}
.wizard-card[data-color="orange"] .choice:hover .icon, .wizard-card[data-color="orange"] .choice.active .icon {
  border-color: #ff9800;
  color: #ff9800;
}
.wizard-card[data-color="orange"] .form-group .form-control {
  background-image: linear-gradient(#ff9800, #ff9800), linear-gradient(#D2D2D2, #D2D2D2);
}
.wizard-card[data-color="orange"] .checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background-color: #ff9800;
}
.wizard-card[data-color="orange"] .radio input[type=radio]:checked ~ .check {
  background-color: #ff9800;
}
.wizard-card[data-color="orange"] .radio input[type=radio]:checked ~ .circle {
  border-color: #ff9800;
}
.wizard-card[data-color="red"] .moving-tab {
  position: absolute;
  text-align: center;
  padding: 12px;
  font-size: 12px;
  text-transform: uppercase;
  -webkit-font-smoothing: subpixel-antialiased;
  background-color: #f44336;
  top: -4px;
  left: 0px;
  border-radius: 4px;
  color: #FFFFFF;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 16px 26px -10px rgba(244, 67, 54, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(244, 67, 54, 0.2);
}
.wizard-card[data-color="red"] .picture:hover {
  border-color: #f44336;
}
.wizard-card[data-color="red"] .choice:hover .icon, .wizard-card[data-color="red"] .choice.active .icon {
  border-color: #f44336;
  color: #f44336;
}
.wizard-card[data-color="red"] .form-group .form-control {
  background-image: linear-gradient(#f44336, #f44336), linear-gradient(#D2D2D2, #D2D2D2);
}
.wizard-card[data-color="red"] .checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background-color: #f44336;
}
.wizard-card[data-color="red"] .radio input[type=radio]:checked ~ .check {
  background-color: #f44336;
}
.wizard-card[data-color="red"] .radio input[type=radio]:checked ~ .circle {
  border-color: #f44336;
}
.wizard-card .picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.wizard-card .picture-src {
  width: 100%;
}
.wizard-card .tab-content {
  min-height: 340px;
  padding: 20px 15px;
}
.wizard-card .wizard-footer {
  padding: 0 15px;
}
.wizard-card .wizard-footer .checkbox {
  margin-top: 16px;
}
.wizard-card .disabled {
  display: none;
}
.wizard-card .wizard-header {
  text-align: center;
  padding: 25px 0 35px;
}
.wizard-card .wizard-header h5 {
  margin: 5px 0 0;
}
.wizard-card .nav-pills > li {
  text-align: center;
}
.wizard-card .btn {
  text-transform: uppercase;
}
.wizard-card .info-text {
  text-align: center;
  font-weight: 300;
  margin: 10px 0 30px;
}
.wizard-card .choice {
  text-align: center;
  cursor: pointer;
  margin-top: 20px;
}
.wizard-card .choice .icon {
  text-align: center;
  vertical-align: middle;
  height: 116px;
  width: 116px;
  border-radius: 50%;
  color: #999999;
  margin: 0 auto 20px;
  border: 4px solid #CCCCCC;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.wizard-card .choice i {
  font-size: 40px;
  line-height: 111px;
}
.wizard-card .choice:hover .icon, .wizard-card .choice.active .icon {
  border-color: #2ca8ff;
}
.wizard-card .choice input[type="radio"],
.wizard-card .choice input[type="checkbox"] {
  position: absolute;
  left: -10000px;
  z-index: -1;
}
.wizard-card .btn-finish {
  display: none;
}
.wizard-card .description {
  color: #999999;
  font-size: 14px;
}
.wizard-card .wizard-title {
  margin: 0;
}

legend {
  margin-bottom: 20px;
  font-size: 21px;
}

output {
  padding-top: 8px;
  font-size: 14px;
  line-height: 1.42857;
}

.form-control {
  height: 36px;
  padding: 7px 0;
  font-size: 14px;
  line-height: 1.42857;
}

@media screen and (-webkit-min-device-pixel-ratio: 0) {
  input[type="date"].form-control,
  input[type="time"].form-control,
  input[type="datetime-local"].form-control,
  input[type="month"].form-control {
    line-height: 36px;
  }
  input[type="date"].input-sm, .input-group-sm input[type="date"],
  input[type="time"].input-sm, .input-group-sm
  input[type="time"],
  input[type="datetime-local"].input-sm, .input-group-sm
  input[type="datetime-local"],
  input[type="month"].input-sm, .input-group-sm
  input[type="month"] {
    line-height: 24px;
  }
  input[type="date"].input-lg, .input-group-lg input[type="date"],
  input[type="time"].input-lg, .input-group-lg
  input[type="time"],
  input[type="datetime-local"].input-lg, .input-group-lg
  input[type="datetime-local"],
  input[type="month"].input-lg, .input-group-lg
  input[type="month"] {
    line-height: 44px;
  }
}
.radio label,
.checkbox label {
  min-height: 20px;
}

.form-control-static {
  padding-top: 8px;
  padding-bottom: 8px;
  min-height: 34px;
}

.input-sm .input-sm {
  height: 24px;
  padding: 3px 0;
  font-size: 11px;
  line-height: 1.5;
  border-radius: 0;
}
.input-sm select.input-sm {
  height: 24px;
  line-height: 24px;
}
.input-sm textarea.input-sm,
.input-sm select[multiple].input-sm {
  height: auto;
}

.form-group-sm .form-control {
  height: 24px;
  padding: 3px 0;
  font-size: 11px;
  line-height: 1.5;
}
.form-group-sm select.form-control {
  height: 24px;
  line-height: 24px;
}
.form-group-sm textarea.form-control,
.form-group-sm select[multiple].form-control {
  height: auto;
}
.form-group-sm .form-control-static {
  height: 24px;
  min-height: 31px;
  padding: 4px 0;
  font-size: 11px;
  line-height: 1.5;
}

.input-lg .input-lg {
  height: 44px;
  padding: 9px 0;
  font-size: 18px;
  line-height: 1.33333;
  border-radius: 0;
}
.input-lg select.input-lg {
  height: 44px;
  line-height: 44px;
}
.input-lg textarea.input-lg,
.input-lg select[multiple].input-lg {
  height: auto;
}

.form-group-lg .form-control {
  height: 44px;
  padding: 9px 0;
  font-size: 18px;
  line-height: 1.33333;
}
.form-group-lg select.form-control {
  height: 44px;
  line-height: 44px;
}
.form-group-lg textarea.form-control,
.form-group-lg select[multiple].form-control {
  height: auto;
}
.form-group-lg .form-control-static {
  height: 44px;
  min-height: 38px;
  padding: 10px 0;
  font-size: 18px;
  line-height: 1.33333;
}

.form-horizontal .radio,
.form-horizontal .checkbox,
.form-horizontal .radio-inline,
.form-horizontal .checkbox-inline {
  padding-top: 8px;
}
.form-horizontal .radio,
.form-horizontal .checkbox {
  min-height: 28px;
}
@media (min-width: 768px) {
  .form-horizontal .control-label {
    padding-top: 8px;
  }
}
@media (min-width: 768px) {
  .form-horizontal .form-group-lg .control-label {
    padding-top: 13.0px;
    font-size: 18px;
  }
}
@media (min-width: 768px) {
  .form-horizontal .form-group-sm .control-label {
    padding-top: 4px;
    font-size: 11px;
  }
}

.label {
  border-radius: 3px;
}
.label, .label.label-default {
  background-color: #FFFFFF;
}
.label.label-inverse {
  background-color: #212121;
}
.label.label-primary {
  background-color: #9c27b0;
}
.label.label-success {
  background-color: #4caf50;
}
.label.label-info {
  background-color: #00bcd4;
}
.label.label-warning {
  background-color: #ff9800;
}
.label.label-danger {
  background-color: #f44336;
}
.label.label-rose {
  background-color: #e91e63;
}

.form-control,
.form-group .form-control {
  border: 0;
  background-image: linear-gradient(#9c27b0, #9c27b0), linear-gradient(#D2D2D2, #D2D2D2);
  background-size: 0 2px, 100% 1px;
  background-repeat: no-repeat;
  background-position: center bottom, center calc(100% - 1px);
  background-color: transparent;
  transition: background 0s ease-out;
  float: none;
  box-shadow: none;
  border-radius: 0;
  font-weight: 400;
}
.form-control::-moz-placeholder,
.form-group .form-control::-moz-placeholder {
  color: #AAAAAA;
  font-weight: 400;
}
.form-control:-ms-input-placeholder,
.form-group .form-control:-ms-input-placeholder {
  color: #AAAAAA;
  font-weight: 400;
}
.form-control::-webkit-input-placeholder,
.form-group .form-control::-webkit-input-placeholder {
  color: #AAAAAA;
  font-weight: 400;
}
.form-control[readonly], .form-control[disabled], fieldset[disabled] .form-control,
.form-group .form-control[readonly],
.form-group .form-control[disabled], fieldset[disabled]
.form-group .form-control {
  background-color: transparent;
}
.form-control[disabled], fieldset[disabled] .form-control,
.form-group .form-control[disabled], fieldset[disabled]
.form-group .form-control {
  background-image: none;
  border-bottom: 1px dotted #D2D2D2;
}

.form-group {
  position: relative;
}
.form-group.label-static label.control-label, .form-group.label-placeholder label.control-label, .form-group.label-floating label.control-label {
  position: absolute;
  pointer-events: none;
  transition: 0.3s ease all;
}
.form-group.label-floating label.control-label {
  will-change: left, top, contents;
}
.form-group.label-placeholder:not(.is-empty) label.control-label {
  display: none;
}
.form-group .help-block {
  position: absolute;
  display: none;
}
.form-group.is-focused .form-control {
  outline: none;
  background-image: linear-gradient(#9c27b0, #9c27b0), linear-gradient(#D2D2D2, #D2D2D2);
  background-size: 100% 2px, 100% 1px;
  box-shadow: none;
  transition-duration: 0.3s;
}
.form-group.is-focused .form-control .material-input:after {
  background-color: #9c27b0;
}
.form-group.is-focused.form-info .form-control {
  background-image: linear-gradient(#00bcd4, #00bcd4), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.form-success .form-control {
  background-image: linear-gradient(#4caf50, #4caf50), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.form-warning .form-control {
  background-image: linear-gradient(#ff9800, #ff9800), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.form-danger .form-control {
  background-image: linear-gradient(#f44336, #f44336), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.form-rose .form-control {
  background-image: linear-gradient(#e91e63, #e91e63), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.form-white .form-control {
  background-image: linear-gradient(#FFFFFF, #FFFFFF), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.is-focused.label-placeholder label,
.form-group.is-focused.label-placeholder label.control-label {
  color: #AAAAAA;
}
.form-group.is-focused .help-block {
  display: block;
}
.form-group.has-warning .form-control {
  box-shadow: none;
}
.form-group.has-warning.is-focused .form-control {
  background-image: linear-gradient(#ff9800, #ff9800), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.has-warning label.control-label,
.form-group.has-warning .help-block {
  color: #ff9800;
}
.form-group.has-error .form-control {
  box-shadow: none;
}
.form-group.has-error.is-focused .form-control {
  background-image: linear-gradient(#f44336, #f44336), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.has-error label.control-label,
.form-group.has-error .help-block {
  color: #f44336;
}
.form-group.has-success .form-control {
  box-shadow: none;
}
.form-group.has-success.is-focused .form-control {
  background-image: linear-gradient(#4caf50, #4caf50), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.has-success label.control-label,
.form-group.has-success .help-block {
  color: #4caf50;
}
.form-group.has-info .form-control {
  box-shadow: none;
}
.form-group.has-info.is-focused .form-control {
  background-image: linear-gradient(#00bcd4, #00bcd4), linear-gradient(#D2D2D2, #D2D2D2);
}
.form-group.has-info label.control-label,
.form-group.has-info .help-block {
  color: #00bcd4;
}
.form-group textarea {
  resize: none;
}
.form-group textarea ~ .form-control-highlight {
  margin-top: -11px;
}
.form-group select {
  appearance: none;
}
.form-group select ~ .material-input:after {
  display: none;
}

.form-control {
  margin-bottom: 7px;
}
.form-control::-moz-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-control:-ms-input-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-control::-webkit-input-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}

.checkbox label,
.radio label,
label {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}

label.control-label {
  font-size: 11px;
  line-height: 1.07143;
  color: #AAAAAA;
  font-weight: 400;
  margin: 16px 0 0 0;
}

.help-block {
  margin-top: 0;
  font-size: 11px;
}

.form-group {
  padding-bottom: 7px;
  margin: 27px 0 0 0;
}
.form-group .form-control {
  margin-bottom: 7px;
}
.form-group .form-control::-moz-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group .form-control:-ms-input-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group .form-control::-webkit-input-placeholder {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group .checkbox label,
.form-group .radio label,
.form-group label {
  font-size: 14px;
  line-height: 1.42857;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group label.control-label {
  font-size: 11px;
  line-height: 1.07143;
  color: #AAAAAA;
  font-weight: 400;
  margin: 16px 0 0 0;
}
.form-group .help-block {
  margin-top: 0;
  font-size: 11px;
}
.form-group.label-floating label.control-label, .form-group.label-placeholder label.control-label {
  top: -7px;
  font-size: 14px;
  line-height: 1.42857;
}
.form-group.label-static label.control-label, .form-group.label-floating.is-focused label.control-label, .form-group.label-floating:not(.is-empty) label.control-label {
  top: -28px;
  left: 0;
  font-size: 11px;
  line-height: 1.07143;
}
.form-group.label-floating input.form-control:-webkit-autofill ~ label.control-label label.control-label {
  top: -28px;
  left: 0;
  font-size: 11px;
  line-height: 1.07143;
}

.form-group.form-group-sm {
  padding-bottom: 3px;
  margin: 21px 0 0 0;
}
.form-group.form-group-sm .form-control {
  margin-bottom: 3px;
}
.form-group.form-group-sm .form-control::-moz-placeholder {
  font-size: 11px;
  line-height: 1.5;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-sm .form-control:-ms-input-placeholder {
  font-size: 11px;
  line-height: 1.5;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-sm .form-control::-webkit-input-placeholder {
  font-size: 11px;
  line-height: 1.5;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-sm .checkbox label,
.form-group.form-group-sm .radio label,
.form-group.form-group-sm label {
  font-size: 11px;
  line-height: 1.5;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-sm label.control-label {
  font-size: 9px;
  line-height: 1.125;
  color: #AAAAAA;
  font-weight: 400;
  margin: 16px 0 0 0;
}
.form-group.form-group-sm .help-block {
  margin-top: 0;
  font-size: 9px;
}
.form-group.form-group-sm.label-floating label.control-label, .form-group.form-group-sm.label-placeholder label.control-label {
  top: -11px;
  font-size: 11px;
  line-height: 1.5;
}
.form-group.form-group-sm.label-static label.control-label, .form-group.form-group-sm.label-floating.is-focused label.control-label, .form-group.form-group-sm.label-floating:not(.is-empty) label.control-label {
  top: -25px;
  left: 0;
  font-size: 9px;
  line-height: 1.125;
}
.form-group.form-group-sm.label-floating input.form-control:-webkit-autofill ~ label.control-label label.control-label {
  top: -25px;
  left: 0;
  font-size: 9px;
  line-height: 1.125;
}

.form-group.form-group-lg {
  padding-bottom: 9px;
  margin: 30px 0 0 0;
}
.form-group.form-group-lg .form-control {
  margin-bottom: 9px;
}
.form-group.form-group-lg .form-control::-moz-placeholder {
  font-size: 18px;
  line-height: 1.33333;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-lg .form-control:-ms-input-placeholder {
  font-size: 18px;
  line-height: 1.33333;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-lg .form-control::-webkit-input-placeholder {
  font-size: 18px;
  line-height: 1.33333;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-lg .checkbox label,
.form-group.form-group-lg .radio label,
.form-group.form-group-lg label {
  font-size: 18px;
  line-height: 1.33333;
  color: #AAAAAA;
  font-weight: 400;
}
.form-group.form-group-lg label.control-label {
  font-size: 14px;
  line-height: 1.0;
  color: #AAAAAA;
  font-weight: 400;
  margin: 16px 0 0 0;
}
.form-group.form-group-lg .help-block {
  margin-top: 0;
  font-size: 14px;
}
.form-group.form-group-lg.label-floating label.control-label, .form-group.form-group-lg.label-placeholder label.control-label {
  top: -5px;
  font-size: 18px;
  line-height: 1.33333;
}
.form-group.form-group-lg.label-static label.control-label, .form-group.form-group-lg.label-floating.is-focused label.control-label, .form-group.form-group-lg.label-floating:not(.is-empty) label.control-label {
  top: -32px;
  left: 0;
  font-size: 14px;
  line-height: 1.0;
}
.form-group.form-group-lg.label-floating input.form-control:-webkit-autofill ~ label.control-label label.control-label {
  top: -32px;
  left: 0;
  font-size: 14px;
  line-height: 1.0;
}

select.form-control {
  border: 0;
  box-shadow: none;
  border-radius: 0;
}
.form-group.is-focused select.form-control {
  box-shadow: none;
  border-color: #D2D2D2;
}
select.form-control[multiple], .form-group.is-focused select.form-control[multiple] {
  height: 85px;
}

.input-group-btn .btn {
  margin: 0 0 7px 0;
}

.form-group.form-group-sm .input-group-btn .btn {
  margin: 0 0 3px 0;
}
.form-group.form-group-lg .input-group-btn .btn {
  margin: 0 0 9px 0;
}

.input-group .input-group-btn {
  padding: 0 12px;
}
.input-group .input-group-addon {
  border: 0;
  background: transparent;
  padding: 6px 15px 0px;
}

.form-group input[type=file] {
  opacity: 0;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 100;
}

.form-control-feedback {
  opacity: 0;
}
.has-success .form-control-feedback {
  color: #4caf50;
  opacity: 1;
}
.has-error .form-control-feedback {
  color: #f44336;
  opacity: 1;
}

.btn {
  border: none;
  border-radius: 3px;
  position: relative;
  padding: 12px 30px;
  margin: 10px 1px;
  font-size: 12px;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 0;
  will-change: box-shadow, transform;
  transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.btn::-moz-focus-inner {
  border: 0;
}
.btn, .btn.btn-default {
  box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
}
.btn, .btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .btn.active:focus, .btn.active:hover, .open > .btn.dropdown-toggle, .open > .btn.dropdown-toggle:focus, .open > .btn.dropdown-toggle:hover, .btn.btn-default, .btn.btn-default:hover, .btn.btn-default:focus, .btn.btn-default:active, .btn.btn-default.active, .btn.btn-default:active:focus, .btn.btn-default:active:hover, .btn.btn-default.active:focus, .btn.btn-default.active:hover, .open > .btn.btn-default.dropdown-toggle, .open > .btn.btn-default.dropdown-toggle:focus, .open > .btn.btn-default.dropdown-toggle:hover {
  background-color: #999999;
  color: #FFFFFF;
}
.btn:focus, .btn:active, .btn:hover, .btn.btn-default:focus, .btn.btn-default:active, .btn.btn-default:hover {
  box-shadow: 0 14px 26px -12px rgba(153, 153, 153, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(153, 153, 153, 0.2);
}
.btn.disabled, .btn.disabled:hover, .btn.disabled:focus, .btn.disabled.focus, .btn.disabled:active, .btn.disabled.active, .btn:disabled, .btn:disabled:hover, .btn:disabled:focus, .btn:disabled.focus, .btn:disabled:active, .btn:disabled.active, .btn[disabled], .btn[disabled]:hover, .btn[disabled]:focus, .btn[disabled].focus, .btn[disabled]:active, .btn[disabled].active, fieldset[disabled] .btn, fieldset[disabled] .btn:hover, fieldset[disabled] .btn:focus, fieldset[disabled] .btn.focus, fieldset[disabled] .btn:active, fieldset[disabled] .btn.active, .btn.btn-default.disabled, .btn.btn-default.disabled:hover, .btn.btn-default.disabled:focus, .btn.btn-default.disabled.focus, .btn.btn-default.disabled:active, .btn.btn-default.disabled.active, .btn.btn-default:disabled, .btn.btn-default:disabled:hover, .btn.btn-default:disabled:focus, .btn.btn-default:disabled.focus, .btn.btn-default:disabled:active, .btn.btn-default:disabled.active, .btn.btn-default[disabled], .btn.btn-default[disabled]:hover, .btn.btn-default[disabled]:focus, .btn.btn-default[disabled].focus, .btn.btn-default[disabled]:active, .btn.btn-default[disabled].active, fieldset[disabled] .btn.btn-default, fieldset[disabled] .btn.btn-default:hover, fieldset[disabled] .btn.btn-default:focus, fieldset[disabled] .btn.btn-default.focus, fieldset[disabled] .btn.btn-default:active, fieldset[disabled] .btn.btn-default.active {
  box-shadow: none;
}
.btn.btn-simple, .btn.btn-default.btn-simple {
  background-color: transparent;
  color: #999999;
  box-shadow: none;
}
.btn.btn-simple:hover, .btn.btn-simple:focus, .btn.btn-simple:active, .btn.btn-default.btn-simple:hover, .btn.btn-default.btn-simple:focus, .btn.btn-default.btn-simple:active {
  background-color: transparent;
  color: #999999;
}
.btn.btn-primary {
  box-shadow: 0 2px 2px 0 rgba(156, 39, 176, 0.14), 0 3px 1px -2px rgba(156, 39, 176, 0.2), 0 1px 5px 0 rgba(156, 39, 176, 0.12);
}
.btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover, .open > .btn.btn-primary.dropdown-toggle, .open > .btn.btn-primary.dropdown-toggle:focus, .open > .btn.btn-primary.dropdown-toggle:hover {
  background-color: #9c27b0;
  color: #FFFFFF;
}
.btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary:hover {
  box-shadow: 0 14px 26px -12px rgba(156, 39, 176, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(156, 39, 176, 0.2);
}
.btn.btn-primary.disabled, .btn.btn-primary.disabled:hover, .btn.btn-primary.disabled:focus, .btn.btn-primary.disabled.focus, .btn.btn-primary.disabled:active, .btn.btn-primary.disabled.active, .btn.btn-primary:disabled, .btn.btn-primary:disabled:hover, .btn.btn-primary:disabled:focus, .btn.btn-primary:disabled.focus, .btn.btn-primary:disabled:active, .btn.btn-primary:disabled.active, .btn.btn-primary[disabled], .btn.btn-primary[disabled]:hover, .btn.btn-primary[disabled]:focus, .btn.btn-primary[disabled].focus, .btn.btn-primary[disabled]:active, .btn.btn-primary[disabled].active, fieldset[disabled] .btn.btn-primary, fieldset[disabled] .btn.btn-primary:hover, fieldset[disabled] .btn.btn-primary:focus, fieldset[disabled] .btn.btn-primary.focus, fieldset[disabled] .btn.btn-primary:active, fieldset[disabled] .btn.btn-primary.active {
  box-shadow: none;
}
.btn.btn-primary.btn-simple {
  background-color: transparent;
  color: #9c27b0;
  box-shadow: none;
}
.btn.btn-primary.btn-simple:hover, .btn.btn-primary.btn-simple:focus, .btn.btn-primary.btn-simple:active {
  background-color: transparent;
  color: #9c27b0;
}
.btn.btn-info {
  box-shadow: 0 2px 2px 0 rgba(0, 188, 212, 0.14), 0 3px 1px -2px rgba(0, 188, 212, 0.2), 0 1px 5px 0 rgba(0, 188, 212, 0.12);
}
.btn.btn-info, .btn.btn-info:hover, .btn.btn-info:focus, .btn.btn-info:active, .btn.btn-info.active, .btn.btn-info:active:focus, .btn.btn-info:active:hover, .btn.btn-info.active:focus, .btn.btn-info.active:hover, .open > .btn.btn-info.dropdown-toggle, .open > .btn.btn-info.dropdown-toggle:focus, .open > .btn.btn-info.dropdown-toggle:hover {
  background-color: #00bcd4;
  color: #FFFFFF;
}
.btn.btn-info:focus, .btn.btn-info:active, .btn.btn-info:hover {
  box-shadow: 0 14px 26px -12px rgba(0, 188, 212, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 188, 212, 0.2);
}
.btn.btn-info.disabled, .btn.btn-info.disabled:hover, .btn.btn-info.disabled:focus, .btn.btn-info.disabled.focus, .btn.btn-info.disabled:active, .btn.btn-info.disabled.active, .btn.btn-info:disabled, .btn.btn-info:disabled:hover, .btn.btn-info:disabled:focus, .btn.btn-info:disabled.focus, .btn.btn-info:disabled:active, .btn.btn-info:disabled.active, .btn.btn-info[disabled], .btn.btn-info[disabled]:hover, .btn.btn-info[disabled]:focus, .btn.btn-info[disabled].focus, .btn.btn-info[disabled]:active, .btn.btn-info[disabled].active, fieldset[disabled] .btn.btn-info, fieldset[disabled] .btn.btn-info:hover, fieldset[disabled] .btn.btn-info:focus, fieldset[disabled] .btn.btn-info.focus, fieldset[disabled] .btn.btn-info:active, fieldset[disabled] .btn.btn-info.active {
  box-shadow: none;
}
.btn.btn-info.btn-simple {
  background-color: transparent;
  color: #00bcd4;
  box-shadow: none;
}
.btn.btn-info.btn-simple:hover, .btn.btn-info.btn-simple:focus, .btn.btn-info.btn-simple:active {
  background-color: transparent;
  color: #00bcd4;
}
.btn.btn-success {
  box-shadow: 0 2px 2px 0 rgba(76, 175, 80, 0.14), 0 3px 1px -2px rgba(76, 175, 80, 0.2), 0 1px 5px 0 rgba(76, 175, 80, 0.12);
}
.btn.btn-success, .btn.btn-success:hover, .btn.btn-success:focus, .btn.btn-success:active, .btn.btn-success.active, .btn.btn-success:active:focus, .btn.btn-success:active:hover, .btn.btn-success.active:focus, .btn.btn-success.active:hover, .open > .btn.btn-success.dropdown-toggle, .open > .btn.btn-success.dropdown-toggle:focus, .open > .btn.btn-success.dropdown-toggle:hover {
  background-color: #4caf50;
  color: #FFFFFF;
}
.btn.btn-success:focus, .btn.btn-success:active, .btn.btn-success:hover {
  box-shadow: 0 14px 26px -12px rgba(76, 175, 80, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(76, 175, 80, 0.2);
}
.btn.btn-success.disabled, .btn.btn-success.disabled:hover, .btn.btn-success.disabled:focus, .btn.btn-success.disabled.focus, .btn.btn-success.disabled:active, .btn.btn-success.disabled.active, .btn.btn-success:disabled, .btn.btn-success:disabled:hover, .btn.btn-success:disabled:focus, .btn.btn-success:disabled.focus, .btn.btn-success:disabled:active, .btn.btn-success:disabled.active, .btn.btn-success[disabled], .btn.btn-success[disabled]:hover, .btn.btn-success[disabled]:focus, .btn.btn-success[disabled].focus, .btn.btn-success[disabled]:active, .btn.btn-success[disabled].active, fieldset[disabled] .btn.btn-success, fieldset[disabled] .btn.btn-success:hover, fieldset[disabled] .btn.btn-success:focus, fieldset[disabled] .btn.btn-success.focus, fieldset[disabled] .btn.btn-success:active, fieldset[disabled] .btn.btn-success.active {
  box-shadow: none;
}
.btn.btn-success.btn-simple {
  background-color: transparent;
  color: #4caf50;
  box-shadow: none;
}
.btn.btn-success.btn-simple:hover, .btn.btn-success.btn-simple:focus, .btn.btn-success.btn-simple:active {
  background-color: transparent;
  color: #4caf50;
}
.btn.btn-warning {
  box-shadow: 0 2px 2px 0 rgba(255, 152, 0, 0.14), 0 3px 1px -2px rgba(255, 152, 0, 0.2), 0 1px 5px 0 rgba(255, 152, 0, 0.12);
}
.btn.btn-warning, .btn.btn-warning:hover, .btn.btn-warning:focus, .btn.btn-warning:active, .btn.btn-warning.active, .btn.btn-warning:active:focus, .btn.btn-warning:active:hover, .btn.btn-warning.active:focus, .btn.btn-warning.active:hover, .open > .btn.btn-warning.dropdown-toggle, .open > .btn.btn-warning.dropdown-toggle:focus, .open > .btn.btn-warning.dropdown-toggle:hover {
  background-color: #ff9800;
  color: #FFFFFF;
}
.btn.btn-warning:focus, .btn.btn-warning:active, .btn.btn-warning:hover {
  box-shadow: 0 14px 26px -12px rgba(255, 152, 0, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(255, 152, 0, 0.2);
}
.btn.btn-warning.disabled, .btn.btn-warning.disabled:hover, .btn.btn-warning.disabled:focus, .btn.btn-warning.disabled.focus, .btn.btn-warning.disabled:active, .btn.btn-warning.disabled.active, .btn.btn-warning:disabled, .btn.btn-warning:disabled:hover, .btn.btn-warning:disabled:focus, .btn.btn-warning:disabled.focus, .btn.btn-warning:disabled:active, .btn.btn-warning:disabled.active, .btn.btn-warning[disabled], .btn.btn-warning[disabled]:hover, .btn.btn-warning[disabled]:focus, .btn.btn-warning[disabled].focus, .btn.btn-warning[disabled]:active, .btn.btn-warning[disabled].active, fieldset[disabled] .btn.btn-warning, fieldset[disabled] .btn.btn-warning:hover, fieldset[disabled] .btn.btn-warning:focus, fieldset[disabled] .btn.btn-warning.focus, fieldset[disabled] .btn.btn-warning:active, fieldset[disabled] .btn.btn-warning.active {
  box-shadow: none;
}
.btn.btn-warning.btn-simple {
  background-color: transparent;
  color: #ff9800;
  box-shadow: none;
}
.btn.btn-warning.btn-simple:hover, .btn.btn-warning.btn-simple:focus, .btn.btn-warning.btn-simple:active {
  background-color: transparent;
  color: #ff9800;
}
.btn.btn-danger {
  box-shadow: 0 2px 2px 0 rgba(244, 67, 54, 0.14), 0 3px 1px -2px rgba(244, 67, 54, 0.2), 0 1px 5px 0 rgba(244, 67, 54, 0.12);
}
.btn.btn-danger, .btn.btn-danger:hover, .btn.btn-danger:focus, .btn.btn-danger:active, .btn.btn-danger.active, .btn.btn-danger:active:focus, .btn.btn-danger:active:hover, .btn.btn-danger.active:focus, .btn.btn-danger.active:hover, .open > .btn.btn-danger.dropdown-toggle, .open > .btn.btn-danger.dropdown-toggle:focus, .open > .btn.btn-danger.dropdown-toggle:hover {
  background-color: #f44336;
  color: #FFFFFF;
}
.btn.btn-danger:focus, .btn.btn-danger:active, .btn.btn-danger:hover {
  box-shadow: 0 14px 26px -12px rgba(244, 67, 54, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(244, 67, 54, 0.2);
}
.btn.btn-danger.disabled, .btn.btn-danger.disabled:hover, .btn.btn-danger.disabled:focus, .btn.btn-danger.disabled.focus, .btn.btn-danger.disabled:active, .btn.btn-danger.disabled.active, .btn.btn-danger:disabled, .btn.btn-danger:disabled:hover, .btn.btn-danger:disabled:focus, .btn.btn-danger:disabled.focus, .btn.btn-danger:disabled:active, .btn.btn-danger:disabled.active, .btn.btn-danger[disabled], .btn.btn-danger[disabled]:hover, .btn.btn-danger[disabled]:focus, .btn.btn-danger[disabled].focus, .btn.btn-danger[disabled]:active, .btn.btn-danger[disabled].active, fieldset[disabled] .btn.btn-danger, fieldset[disabled] .btn.btn-danger:hover, fieldset[disabled] .btn.btn-danger:focus, fieldset[disabled] .btn.btn-danger.focus, fieldset[disabled] .btn.btn-danger:active, fieldset[disabled] .btn.btn-danger.active {
  box-shadow: none;
}
.btn.btn-danger.btn-simple {
  background-color: transparent;
  color: #f44336;
  box-shadow: none;
}
.btn.btn-danger.btn-simple:hover, .btn.btn-danger.btn-simple:focus, .btn.btn-danger.btn-simple:active {
  background-color: transparent;
  color: #f44336;
}
.btn:focus, .btn:active, .btn:active:focus {
  outline: 0;
}
.btn.btn-round {
  border-radius: 30px;
}
.btn:not(.btn-just-icon):not(.btn-fab) .fa {
  font-size: 18px;
  margin-top: -2px;
  position: relative;
  top: 2px;
}
.btn.btn-fab {
  border-radius: 50%;
  font-size: 24px;
  height: 56px;
  margin: auto;
  min-width: 56px;
  width: 56px;
  padding: 0;
  overflow: hidden;
  position: relative;
  line-height: normal;
}
.btn.btn-fab .ripple-container {
  border-radius: 50%;
}
.btn.btn-fab.btn-fab-mini, .btn-group-sm .btn.btn-fab {
  height: 40px;
  min-width: 40px;
  width: 40px;
}
.btn.btn-fab.btn-fab-mini.material-icons, .btn-group-sm .btn.btn-fab.material-icons {
  top: -3.5px;
  left: -3.5px;
}
.btn.btn-fab.btn-fab-mini .material-icons, .btn-group-sm .btn.btn-fab .material-icons {
  font-size: 17px;
}
.btn.btn-fab i.material-icons {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-12px, -12px);
  line-height: 24px;
  width: 24px;
  font-size: 24px;
}
.btn.btn-lg, .btn-group-lg .btn {
  font-size: 14px;
  padding: 18px 36px;
}
.btn.btn-sm, .btn-group-sm .btn {
  padding: 5px 20px;
  font-size: 11px;
}
.btn.btn-xs, .btn-group-xs .btn {
  padding: 4px 15px;
  font-size: 10px;
}
.btn.btn-just-icon {
  font-size: 18px;
  padding: 10px 10px;
  line-height: 1em;
}
.btn.btn-just-icon i {
  width: 20px;
}
.btn.btn-just-icon.btn-lg {
  font-size: 22px;
  padding: 13px 18px;
}

.btn .material-icons {
  vertical-align: middle;
  font-size: 17px;
  top: -1px;
  position: relative;
}

/*            Navigation menu                */
.nav-pills {
  background-color: rgba(200, 200, 200, 0.2);
}
.nav-pills > li + li {
  margin-left: 0;
}
.nav-pills > li > a {
  border: 0 !important;
  border-radius: 0;
  line-height: 18px;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: 500;
  min-width: 100px;
  text-align: center;
  color: #555555 !important;
}
.nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus,
.nav-pills > li > a:hover,
.nav-pills > li > a:focus {
  background-color: inherit;
}
.nav-pills > li i {
  display: block;
  font-size: 30px;
  padding: 15px 0;
}

.popover, .tooltip-inner {
  color: #555555;
  line-height: 1.5em;
  background: #FFFFFF;
  border: none;
  border-radius: 3px;
  box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
}

.popover {
  padding: 0;
  box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.popover.left > .arrow, .popover.right > .arrow, .popover.top > .arrow, .popover.bottom > .arrow {
  border: none;
}

.popover-title {
  background-color: #FFFFFF;
  border: none;
  padding: 15px 15px 5px;
  font-size: 1.3em;
}

.popover-content {
  padding: 10px 15px 15px;
  line-height: 1.4;
}

.tooltip.in {
  opacity: 1;
  -webkit-transform: translate3d(0, 0px, 0);
  -moz-transform: translate3d(0, 0px, 0);
  -o-transform: translate3d(0, 0px, 0);
  -ms-transform: translate3d(0, 0px, 0);
  transform: translate3d(0, 0px, 0);
}

.tooltip {
  opacity: 0;
  transition: opacity, transform .2s ease;
  -webkit-transform: translate3d(0, 5px, 0);
  -moz-transform: translate3d(0, 5px, 0);
  -o-transform: translate3d(0, 5px, 0);
  -ms-transform: translate3d(0, 5px, 0);
  transform: translate3d(0, 5px, 0);
}
.tooltip.left .tooltip-arrow {
  border-left-color: #FFFFFF;
}
.tooltip.right .tooltip-arrow {
  border-right-color: #FFFFFF;
}
.tooltip.top .tooltip-arrow {
  border-top-color: #FFFFFF;
}
.tooltip.bottom .tooltip-arrow {
  border-bottom-color: #FFFFFF;
}

.tooltip-inner {
  padding: 10px 15px;
  min-width: 130px;
}

.footer {
  position: relative;
  bottom: 20px;
  right: 0px;
  width: 100%;
  color: #FFFFFF;
  z-index: 4;
  text-align: right;
  margin-top: 60px;
  text-shadow: 0 0px 1px black;
}
.footer a {
  color: #FFFFFF;
}
.footer .heart {
  color: #FF3B30;
}

.withripple {
  position: relative;
}

.ripple-container {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  width: 100%;
  height: 100%;
  overflow: hidden;
  border-radius: inherit;
  pointer-events: none;
}
.disabled .ripple-container {
  display: none;
}

.ripple {
  position: absolute;
  width: 20px;
  height: 20px;
  margin-left: -10px;
  margin-top: -10px;
  border-radius: 100%;
  background-color: #000;
  background-color: rgba(0, 0, 0, 0.05);
  transform: scale(1);
  transform-origin: 50%;
  opacity: 0;
  pointer-events: none;
}

.ripple.ripple-on {
  transition: opacity 0.15s ease-in 0s, transform 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.1s;
  opacity: 0.1;
}

.ripple.ripple-out {
  transition: opacity 0.1s linear 0s !important;
  opacity: 0;
}

.radio label {
  cursor: pointer;
  padding-left: 35px;
  position: relative;
  color: rgba(0,0,0, 0.26);
}
.form-group.is-focused .radio label {
  color: rgba(0,0,0, 0.26);
}
.form-group.is-focused .radio label:hover, .form-group.is-focused .radio label:focus {
  color: rgba(0,0,0, .54);
}
fieldset[disabled] .form-group.is-focused .radio label {
  color: rgba(0,0,0, 0.26);
}
.radio label span {
  display: block;
  position: absolute;
  left: 10px;
  top: 2px;
  transition-duration: 0.2s;
}
.radio label .circle {
  border: 1px solid rgba(0,0,0, .54);
  height: 15px;
  width: 15px;
  border-radius: 100%;
}
.radio label .check {
  height: 15px;
  width: 15px;
  border-radius: 100%;
  background-color: #9c27b0;
  transform: scale3d(0, 0, 0);
}
.radio label .check:after {
  display: block;
  position: absolute;
  content: "";
  background-color: rgba(0,0,0, 0.87);
  left: -18px;
  top: -18px;
  height: 50px;
  width: 50px;
  border-radius: 100%;
  z-index: 1;
  opacity: 0;
  margin: 0;
  transform: scale3d(1.5, 1.5, 1);
}
.radio label input[type=radio]:not(:checked) ~ .check:after {
  animation: rippleOff 500ms;
}
.radio label input[type=radio]:checked ~ .check:after {
  animation: rippleOn 500ms;
}
.radio input[type=radio] {
  opacity: 0;
  height: 0;
  width: 0;
  overflow: hidden;
}
.radio input[type=radio]:checked ~ .check, .radio input[type=radio]:checked ~ .circle {
  opacity: 1;
}
.radio input[type=radio]:checked ~ .check {
  background-color: #9c27b0;
}
.radio input[type=radio]:checked ~ .circle {
  border-color: #9c27b0;
}
.radio input[type=radio]:checked ~ .check {
  transform: scale3d(0.65, 0.65, 1);
}
.radio input[type=radio][disabled] ~ .check, .radio input[type=radio][disabled] ~ .circle {
  opacity: 0.26;
}
.radio input[type=radio][disabled] ~ .check {
  background-color: #000000;
}
.radio input[type=radio][disabled] ~ .circle {
  border-color: #000000;
}

@keyframes rippleOn {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
  }
}
@keyframes rippleOff {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
  }
}
.checkbox label {
  cursor: pointer;
  padding-left: 0;
  color: rgba(0,0,0, 0.26);
}
.form-group.is-focused .checkbox label {
  color: rgba(0,0,0, 0.26);
}
.form-group.is-focused .checkbox label:hover, .form-group.is-focused .checkbox label:focus {
  color: rgba(0,0,0, .54);
}
fieldset[disabled] .form-group.is-focused .checkbox label {
  color: rgba(0,0,0, 0.26);
}
.checkbox input[type=checkbox] {
  opacity: 0;
  position: absolute;
  margin: 0;
  z-index: -1;
  width: 0;
  height: 0;
  overflow: hidden;
  left: 0;
  pointer-events: none;
}
.checkbox .checkbox-material {
  vertical-align: middle;
  position: relative;
  top: 3px;
  padding-right: 5px;
}
.checkbox .checkbox-material:before {
  display: block;
  position: absolute;
  left: 0;
  content: "";
  background-color: rgba(0, 0, 0, 0.84);
  height: 20px;
  width: 20px;
  border-radius: 100%;
  z-index: 1;
  opacity: 0;
  margin: 0;
  transform: scale3d(2.3, 2.3, 1);
}
.checkbox .checkbox-material .check {
  position: relative;
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 1px solid rgba(0,0,0, .54);
  overflow: hidden;
  z-index: 1;
  border-radius: 3px;
}
.checkbox .checkbox-material .check:before {
  position: absolute;
  content: "";
  transform: rotate(45deg);
  display: block;
  margin-top: -3px;
  margin-left: 7px;
  width: 0;
  height: 0;
  background: red;
  box-shadow: 0 0 0 0, 0 0 0 0, 0 0 0 0, 0 0 0 0, 0 0 0 0, 0 0 0 0, 0 0 0 0 inset;
  animation: checkbox-off 0.3s forwards;
}
.checkbox input[type=checkbox]:focus + .checkbox-material .check:after {
  opacity: 0.2;
}
.checkbox input[type=checkbox]:checked + .checkbox-material .check {
  background: #9c27b0;
}
.checkbox input[type=checkbox]:checked + .checkbox-material .check:before {
  color: #FFFFFF;
  box-shadow: 0 0 0 10px, 10px -10px 0 10px, 32px 0 0 20px, 0px 32px 0 20px, -5px 5px 0 10px, 20px -12px 0 11px;
  animation: checkbox-on 0.3s forwards;
}
.checkbox input[type=checkbox]:checked + .checkbox-material:before {
  animation: rippleOn 500ms;
}
.checkbox input[type=checkbox]:checked + .checkbox-material .check:after {
  animation: rippleOn 500ms forwards;
}
.checkbox input[type=checkbox]:not(:checked) + .checkbox-material:before {
  animation: rippleOff 500ms;
}
.checkbox input[type=checkbox]:not(:checked) + .checkbox-material .check:after {
  animation: rippleOff 500ms;
}
fieldset[disabled] .checkbox, fieldset[disabled] .checkbox input[type=checkbox],
.checkbox input[type=checkbox][disabled] ~ .checkbox-material .check,
.checkbox input[type=checkbox][disabled] + .circle {
  opacity: 0.5;
}
.checkbox input[type=checkbox][disabled] ~ .checkbox-material .check {
  border-color: #000000;
  opacity: .26;
}
.checkbox input[type=checkbox][disabled] + .checkbox-material .check:after {
  background-color: rgba(0,0,0, 0.87);
  transform: rotate(-45deg);
}

@keyframes checkbox-on {
  0% {
    box-shadow: 0 0 0 10px, 10px -10px 0 10px, 32px 0 0 20px, 0px 32px 0 20px, -5px 5px 0 10px, 15px 2px 0 11px;
  }
  50% {
    box-shadow: 0 0 0 10px, 10px -10px 0 10px, 32px 0 0 20px, 0px 32px 0 20px, -5px 5px 0 10px, 20px 2px 0 11px;
  }
  100% {
    box-shadow: 0 0 0 10px, 10px -10px 0 10px, 32px 0 0 20px, 0px 32px 0 20px, -5px 5px 0 10px, 20px -12px 0 11px;
  }
}
@keyframes rippleOn {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
  }
}
@keyframes rippleOff {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.2;
  }
  100% {
    opacity: 0;
  }
}
@media (max-width: 768px) {
  .main .container {
    margin-bottom: 50px;
  }
}
@media (min-width: 768px) {
  .navbar-form {
    margin-top: 21px;
    margin-bottom: 21px;
    padding-left: 5px;
    padding-right: 5px;
  }

  .btn-wd {
    min-width: 140px;
  }
}





.logo-container{
    left: 50px;
    position: absolute;
    top: 20px;
    z-index: 3;
}
.logo-container .logo{
    overflow: hidden;
    border-radius: 50%;
    border: 1px solid #333333;
    width: 60px;
    float: left;
}
.logo-container .brand{
    font-size: 18px;
    color: #FFF;
    line-height: 20px;
    float: left;
    margin-left: 10px;
    margin-top: 10px;
    width: 60px
}

body{
    background-color: #CCCCCC;
}

.section .wizard-card{
    min-height: inherit;
}

.tim-row{
    margin-bottom: 20px;
}

.tim-white-buttons {
    background-color: #777777;
}
.title{
    margin-top: 30px;
    margin-bottom: 25px;
    min-height: 32px;
    font-weight: 500;
}



.title.text-center{
    margin-bottom: 50px;
}
.tim-typo{
    padding-left: 25%;
    margin-bottom: 40px;
    position: relative;
}
.tim-typo .tim-note{
    bottom: 10px;
    color: #c0c1c2;
    display: block;
    font-weight: 400;
    font-size: 13px;
    line-height: 13px;
    left: 0;
    margin-left: 20px;
    position: absolute;
    width: 260px;
}
.tim-row{
    padding-top: 50px;
}
.tim-row h3{
    margin-top: 0;
}
.switch{
    margin-right: 20px;
}
#navbar-full .navbar{
    border-radius: 0 !important;
    margin-bottom: 15px;
    z-index: 2;
}
.space{
    height: 130px;
    display: block;
}
.space-110{
    height: 110px;
    display: block;
}
.space-50{
    height: 50px;
    display: block;
}
.space-70{
    height: 70px;
    display: block;
}
.navigation-example .img-src{
    background-attachment: scroll;
}

.navigation-example{
    background-image: url('../img/bg.jpg');
    background-position: center center;
    background-size: cover;
    margin-top:0;
    min-height: 740px;
}
#notifications{
    background-color: #FFFFFF;
    display: block;
    width: 100%;
    position: relative;
}
#notifications .alert-danger{
    margin-bottom: 0px;
}
.tim-note{
    text-transform: capitalize;
}

#buttons .btn{
    margin: 0 0px 15px;
}
.space-100{
    height: 100px;
    display: block;
    width: 100%;
}

.be-social{
    padding-bottom: 20px;
/*     border-bottom: 1px solid #aaa; */
    margin: 0 auto 40px;
}
.txt-white{
    color: #FFFFFF;
}
.txt-gray{
    color: #ddd !important;
}


.parallax{
  width:100%;
  height:570px;

  display: block;
  background-attachment: fixed;
    background-repeat:no-repeat;
    background-size:cover;
    background-position: center center;

}

.logo-container.logo-documentation{
    position: relative;
    top: 0;
    left: 0;
}

.logo-container .logo{
    overflow: hidden;
    border-radius: 50%;
    border: 1px solid #333333;
    width: 50px;
    float: left;
}

.logo-container .brand{
    font-size: 16px;
    line-height: 18px;
    float: left;
    margin-left: 10px;
    margin-top: 7px;
    width: 70px;
    height: 40px;
    text-align: left;
}


.navbar-default .logo-container .brand{
    color: #999999;
}
.navbar-transparent .logo-container .brand{
    color: #FFFFFF;
}

.logo-container .brand-material{
    font-size: 18px;
    margin-top: 15px;
    height: 25px;
    width: auto;
}

.logo-container .logo img{
    width: 100%;
}
.navbar-small .logo-container .brand{
    color: #333333;
}

.fixed-section{
    top: 90px;
    max-height: 80vh;
    overflow: scroll;
}
.fixed-section ul li{
    list-style: none;
}
.fixed-section li a{
    font-size: 14px;
    padding: 2px;
    display: block;
    color: #666666;
}
.fixed-section li a.active{
    color: #00bbff;
}
.fixed-section.float{
    position: fixed;
    top: 100px;
    width: 200px;
    margin-top: 0;
}


.parallax .parallax-image{
    width: 100%;
    overflow: hidden;
    position: absolute;
}
.parallax .parallax-image img{
    width: 100%;
}

@media (max-width: 768px){
    .parallax .parallax-image{
         width: 100%;
         height: 640px;
         overflow: hidden;
     }
    .parallax .parallax-image img{
       height: 100%;
       width: auto;
   }
}

.separator{
    content: "Separator";
    color: #FFFFFF;
    display: block;
    width: 100%;
    padding: 20px;
}
.separator-line{
    background-color: #EEE;
    height: 1px;
    width: 100%;
    display: block;
}
.separator.separator-gray{
    background-color: #EEEEEE;
}
.social-buttons-demo .btn{
    margin-right: 5px;
    margin-bottom: 7px;
}

.img-container{
    width: 100%;
    overflow: hidden;
}
.img-container img{
    width: 100%;
}

.lightbox img{
    width: 100%;
}
.lightbox .modal-content{
    overflow: hidden;
}
.lightbox .modal-body{
    padding: 0;
}
@media screen and (min-width: 991px){
    .lightbox .modal-dialog{
        width: 960px;
    }
}

@media (max-width: 768px){
    .btn, .btn-morphing{
        margin-bottom: 10px;
    }
    .parallax .motto{
        top: 170px;
        margin-top: 0;
        font-size: 60px;
        width: 270px;
    }
}

/*       Loading dots  */

/*      transitions */
.presentation .front, .presentation .front:after, .presentation .front .btn, .logo-container .logo, .logo-container .brand{
     -webkit-transition: all .2s;
    -moz-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;
}


#images h4{
    margin-bottom: 30px;
}
#javascriptComponents{
    padding-bottom: 0;
}
#javascriptComponents .btn-raised{
    margin: 10px 5px;
}


/*      layer animation          */

.layers-container{
    display: block;
    margin-top: 50px;
    position: relative;
}
.layers-container img {
  position: absolute;
  width: 100%;
  height: auto;
  top: 0;
  left: 0;
  text-align: center;
}

.section-black {
  background-color: #333;
}

.animate {
  transition: 1.5s ease-in-out;
  -moz-transition: 1.5s ease-in-out;
  -webkit-transition: 1.5s ease-in-out;
}

.navbar-default.navbar-small .logo-container .brand{
    color: #333333;
}
.navbar-transparent.navbar-small .logo-container .brand{
    color: #FFFFFF;
}
.navbar-default.navbar-small .logo-container .brand{
    color: #333333;
}

.sharing-area{
    margin-top: 80px;
}
.sharing-area .btn{
    margin: 15px 4px 0;
    color: #FFFFFF;
}
.sharing-area .btn i{
    font-size: 18px;
    position: relative;
    top: 2px;
    margin-right: 5px;
}
.sharing-area .btn-twitter{
    background-color: #55acee;
}
.sharing-area .btn-facebook{
    background-color: #3b5998;
}
.sharing-area .btn-google-plus{
    background-color: #dd4b39;
}
.sharing-area .btn-github{
    background-color: #333333;
}
.section-thin,
.section-notifications{
    padding: 0;
}
.section-navbars{
    padding-top: 0;
}
#navbar .navbar{
    border-radius: 0;
}
.section-tabs{
    background: #EEEEEE;
}
.section-pagination{
    padding-bottom: 0;
}
.section-download h4{
    margin-bottom: 50px;
}
.section-examples a{
    text-decoration: none;
}
.section-examples h5{
    margin-top: 30px;
}
.components-page .wrapper > .header,
.tutorial-page .wrapper > .header{
    height: 400px;
    padding-top: 100px;
    background-size: cover;
    background-position: center center;
}
.components-page .title,
.tutorial-page .title{
    color: #FFFFFF;
}

.main {
  background: #FFFFFF;
  position: relative;
  z-index: 3;
}

.main-raised {
    margin: -60px 30px 0px;
    border-radius: 6px;
    box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

.header-filter {
  position: relative;
}
.header-filter:before, .header-filter:after {
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 100%;
  display: block;
  left: 0;
  top: 0;
  content: "";
}
.header-filter::before {
  background-color: rgba(0, 0, 0, 0.4);
}
.header-filter .container {
  z-index: 2;
  position: relative;
}

.section {
  padding: 70px 0;
  background-position: center center;
  background-size: cover;
}



.navbar {
  border: 0;
  border-radius: 3px;
  box-shadow: 0 10px 20px -12px rgba(0, 0, 0, 0.42), 0 3px 20px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
  padding: 10px 0;

  -webkit-transition: all 150ms ease 0s;
 -moz-transition: all 150ms ease 0s;
 -o-transition: all 150ms ease 0s;
 -ms-transition: all 150ms ease 0s;
 transition: all 150ms ease 0s;
}
.navbar .navbar-brand {
  position: relative;
  height: 50px;
  line-height: 30px;
  color: inherit;
  padding: 10px 15px;
}
.navbar .navbar-brand:hover, .navbar .navbar-brand:focus {
  color: inherit;
  background-color: transparent;
}

.navbar.navbar-transparent {
  background-color: transparent;
  box-shadow: none;
  color: #fff;
  padding-top: 25px;
}

.navbar-fixed-top {
  border-radius: 0;
}

.navbar .navbar-nav > li > a .material-icons,
.navbar .navbar-nav > li > a .fa {
  font-size: 20px;
  max-width: 20px;
}
.navbar .navbar-nav > li > a:hover,
.navbar .navbar-nav > li > a:focus {
    color: inherit;
    background-color: transparent;
}

.navbar .navbar-nav > li > a:not(.btn) .material-icons {
  margin-top: -3px;
  top: 0px;
  position: relative;
  margin-right: 3px;
}

.navbar, .navbar.navbar-default {
  background-color: #9c27b0;
  color: #FFFFFF;
}

.navbar .navbar-nav > li > a {
  color: inherit;
  padding-top: 15px;
  padding-bottom: 15px;
  font-weight: 400;
  font-size: 12px;
  text-transform: uppercase;
  border-radius: 3px;
}
@media (max-width: 1199px) {

  .navbar .navbar-brand {
    height: 50px;
    padding: 10px 15px;
  }
  .navbar .navbar-nav > li > a {
    padding-top: 15px;
    padding-bottom: 15px;
  }
}

footer {
  padding: 15px 0;
  text-align: center;

}
.footer a{
    font-weight: bold;
}

footer.footer-documentation{
    margin-top: 0;
    bottom: 0;
    text-shadow: none;
    color: inherit;
}

footer.footer-documentation li a{
    color: inherit;
}

footer.footer-documentation li a:hover,
footer.footer-documentation li a:focus{
    color: #89229b;
}

footer ul {
  margin-bottom: 0;
  padding: 0;
  list-style: none;
}
footer ul li {
  display: inline-block;
}
footer ul li a {
  color: inherit;
  padding: 15px;
  font-weight: 500;
  font-size: 12px;
  text-transform: uppercase;
  border-radius: 3px;
  text-decoration: none;
  position: relative;
  display: block;
}
footer ul li a:hover {
  text-decoration: none;
}
footer ul li .btn {
  margin: 0;
}
footer ul.links-horizontal:first-child a {
  padding-left: 0;
}
footer ul.links-horizontal:last-child a {
  padding-right: 0;
}
footer ul.links-vertical li {
  display: block;
}
footer ul.links-vertical li a {
  padding: 5px 0;
}
footer .social-buttons a,
footer .social-buttons .btn {
  margin-top: 5px;
  margin-bottom: 5px;
}
footer .footer-brand {
  float: left;
  height: 50px;
  padding: 15px 15px;
  font-size: 18px;
  line-height: 20px;
  margin-left: -15px;
}
footer .footer-brand:hover, footer .footer-brand:focus {
  color: #3C4858;
}
footer .copyright {
  padding: 15px 0;
  text-align: center;
}
footer .copyright .material-icons {
  font-size: 18px;
  position: relative;
  top: 3px;
}
footer .pull-center {
  display: inline-block;
  float: none;
}

@media (max-width: 768px) {
  .footer .copyright {
    display: inline-block;
    text-align: center;
    padding: 10px 0;
    float: none !important;
    width: 100%;
  }
}
    </style>
    <div class="container-fluid">
       
	    <!--   Creative Tim Branding   -->


		<!--  Made With Material Kit  -->


	    <!--   Big container   -->
	        <div class="row justify-content-center">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!-- Wizard container -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <form action="" method="">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Create A Test Schedule
		                        	</h3>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#details" data-toggle="tab">Test Type</a></li>
			                            <li><a href="#captain" data-toggle="tab">Date & Time</a></li>
			                            <li><a href="#description" data-toggle="tab">Confirmation</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Let's start with the type.</h4>
			                            	</div>

		                            	</div>
                                        <div class="row">
		                                        <div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This test runs weekly for 10 minutes.">
		                                                <input type="radio" name="job" value="Design">
		                                                <div class="icon">
		                                                    <i class="material-icons">W</i>
		                                                </div>
		                                                <h6>Weekly</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This test runs monthly for 30 minutes.">
		                                                <input type="radio" name="job" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">M</i>
		                                                </div>
		                                                <h6>Monthly</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This test runs twice a year for 1.5 hours.">
		                                                <input type="radio" name="job" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">BA</i>
		                                                </div>
		                                                <h6>Bi-Annual</h6>
		                                            </div>
		                                        </div>
                                                <div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This test runs once a year for 3 hours.">
		                                                <input type="radio" name="job" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">A</i>
		                                                </div>
		                                                <h6>Annual</h6>
		                                            </div>
		                                        </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="captain">
		                                <h4 class="info-text">What type of room would you want? </h4>
		                                <div class="row">
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This is good if you travel alone.">
		                                                <input type="radio" name="job" value="Design">
		                                                <div class="icon">
		                                                    <i class="material-icons">weekend</i>
		                                                </div>
		                                                <h6>Single</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this room if you're traveling with your family.">
		                                                <input type="radio" name="job" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">home</i>
		                                                </div>
		                                                <h6>Family</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this option if you are coming with your team.">
		                                                <input type="radio" name="job" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">business</i>
		                                                </div>
		                                                <h6>Business</h6>
		                                            </div>
		                                        </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="description">
		                                <div class="row">
		                                    <h4 class="info-text"> Drop us a small description.</h4>
		                                    <div class="col-sm-6 col-sm-offset-1">
	                                    		<div class="form-group">
		                                            <label>Room description</label>
		                                            <textarea class="form-control" placeholder="" rows="6"></textarea>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-4">
		                                    	<div class="form-group">
		                                            <label class="control-label">Example</label>
		                                            <p class="description">"The room really nice name is recognized as being a really awesome room. We use it every sunday when we go fishing and we catch a lot. It has some kind of magic shield around it."</p>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
	                                </div>

	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->






    </div>
@endsection


@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
   <script>
/*!
 * jQuery twitter bootstrap wizard plugin
 * Examples and documentation at: https://github.com/VinceG/twitter-bootstrap-wizard
 * version 1.0
 * Requires jQuery v1.3.2 or later
 * Supports Bootstrap 2.2.x, 2.3.x, 3.0
 * Dual licensed under the MIT and GPL licenses:
 * https://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Authors: Vadim Vincent Gabriel (http://vadimg.com), Jason Gill (www.gilluminate.com)
 */
;(function($) {
var bootstrapWizardCreate = function(element, options) {
	var element = $(element);
	var obj = this;

	// selector skips any 'li' elements that do not contain a child with a tab data-toggle
	var baseItemSelector = 'li:has([data-toggle="tab"])';

	// Merge options with defaults
	var $settings = $.extend({}, $.fn.bootstrapWizard.defaults, options);
	var $activeTab = null;
	var $navigation = null;

	this.rebindClick = function(selector, fn)
	{
		selector.unbind('click', fn).bind('click', fn);
	}

	this.fixNavigationButtons = function() {
		// Get the current active tab
		if(!$activeTab.length) {
			// Select first one
			$navigation.find('a:first').tab('show');
			$activeTab = $navigation.find(baseItemSelector + ':first');
		}

		// See if we're currently in the first/last then disable the previous and last buttons
		$($settings.previousSelector, element).toggleClass('disabled', (obj.firstIndex() >= obj.currentIndex()));
		$($settings.nextSelector, element).toggleClass('disabled', (obj.currentIndex() >= obj.navigationLength()));

		// We are unbinding and rebinding to ensure single firing and no double-click errors
		obj.rebindClick($($settings.nextSelector, element), obj.next);
		obj.rebindClick($($settings.previousSelector, element), obj.previous);
		obj.rebindClick($($settings.lastSelector, element), obj.last);
		obj.rebindClick($($settings.firstSelector, element), obj.first);

		if($settings.onTabShow && typeof $settings.onTabShow === 'function' && $settings.onTabShow($activeTab, $navigation, obj.currentIndex())===false){
			return false;
		}
	};

	this.next = function(e) {

		// If we clicked the last then dont activate this
		if(element.hasClass('last')) {
			return false;
		}

		if($settings.onNext && typeof $settings.onNext === 'function' && $settings.onNext($activeTab, $navigation, obj.nextIndex())===false){
			return false;
		}

		// Did we click the last button
		$index = obj.nextIndex();
		if($index > obj.navigationLength()) {
		} else {
			$navigation.find(baseItemSelector + ':eq('+$index+') a').tab('show');
		}
	};

	this.previous = function(e) {

		// If we clicked the first then dont activate this
		if(element.hasClass('first')) {
			return false;
		}

		if($settings.onPrevious && typeof $settings.onPrevious === 'function' && $settings.onPrevious($activeTab, $navigation, obj.previousIndex())===false){
			return false;
		}

		$index = obj.previousIndex();
		if($index < 0) {
		} else {
			$navigation.find(baseItemSelector + ':eq('+$index+') a').tab('show');
		}
	};

	this.first = function(e) {
		if($settings.onFirst && typeof $settings.onFirst === 'function' && $settings.onFirst($activeTab, $navigation, obj.firstIndex())===false){
			return false;
		}

		// If the element is disabled then we won't do anything
		if(element.hasClass('disabled')) {
			return false;
		}
		$navigation.find(baseItemSelector + ':eq(0) a').tab('show');

	};
	this.last = function(e) {
		if($settings.onLast && typeof $settings.onLast === 'function' && $settings.onLast($activeTab, $navigation, obj.lastIndex())===false){
			return false;
		}

		// If the element is disabled then we won't do anything
		if(element.hasClass('disabled')) {
			return false;
		}
		$navigation.find(baseItemSelector + ':eq('+obj.navigationLength()+') a').tab('show');
	};
	this.currentIndex = function() {
		return $navigation.find(baseItemSelector).index($activeTab);
	};
	this.firstIndex = function() {
		return 0;
	};
	this.lastIndex = function() {
		return obj.navigationLength();
	};
	this.getIndex = function(e) {
		return $navigation.find(baseItemSelector).index(e);
	};
	this.nextIndex = function() {
		return $navigation.find(baseItemSelector).index($activeTab) + 1;
	};
	this.previousIndex = function() {
		return $navigation.find(baseItemSelector).index($activeTab) - 1;
	};
	this.navigationLength = function() {
		return $navigation.find(baseItemSelector).length - 1;
	};
	this.activeTab = function() {
		return $activeTab;
	};
	this.nextTab = function() {
		return $navigation.find(baseItemSelector + ':eq('+(obj.currentIndex()+1)+')').length ? $navigation.find(baseItemSelector + ':eq('+(obj.currentIndex()+1)+')') : null;
	};
	this.previousTab = function() {
		if(obj.currentIndex() <= 0) {
			return null;
		}
		return $navigation.find(baseItemSelector + ':eq('+parseInt(obj.currentIndex()-1)+')');
	};
	this.show = function(index) {
		if (isNaN(index)) {
			return element.find(baseItemSelector + ' a[href=#' + index + ']').tab('show');
		}
		else {
			return element.find(baseItemSelector + ':eq(' + index + ') a').tab('show');
		}
	};
	this.disable = function(index) {
		$navigation.find(baseItemSelector + ':eq('+index+')').addClass('disabled');
	};
	this.enable = function(index) {
		$navigation.find(baseItemSelector + ':eq('+index+')').removeClass('disabled');
	};
	this.hide = function(index) {
		$navigation.find(baseItemSelector + ':eq('+index+')').hide();
	};
	this.display = function(index) {
		$navigation.find(baseItemSelector + ':eq('+index+')').show();
	};
	this.remove = function(args) {
		var $index = args[0];
		var $removeTabPane = typeof args[1] != 'undefined' ? args[1] : false;
		var $item = $navigation.find(baseItemSelector + ':eq('+$index+')');

		// Remove the tab pane first if needed
		if($removeTabPane) {
			var $href = $item.find('a').attr('href');
			$($href).remove();
		}

		// Remove menu item
		$item.remove();
	};

	var innerTabClick = function (e) {
		// Get the index of the clicked tab
		var clickedIndex = $navigation.find(baseItemSelector).index($(e.currentTarget).parent(baseItemSelector));
		if($settings.onTabClick && typeof $settings.onTabClick === 'function' && $settings.onTabClick($activeTab, $navigation, obj.currentIndex(), clickedIndex)===false){
			return false;
		}
	};

	var innerTabShown = function (e) {  // use shown instead of show to help prevent double firing
		$element = $(e.target).parent();
		var nextTab = $navigation.find(baseItemSelector).index($element);

		// If it's disabled then do not change
		if($element.hasClass('disabled')) {
			return false;
		}

		if($settings.onTabChange && typeof $settings.onTabChange === 'function' && $settings.onTabChange($activeTab, $navigation, obj.currentIndex(), nextTab)===false){
				return false;
		}

		$activeTab = $element; // activated tab
		obj.fixNavigationButtons();
	};

	this.resetWizard = function() {

		// remove the existing handlers
		$('a[data-toggle="tab"]', $navigation).off('click', innerTabClick);
		$('a[data-toggle="tab"]', $navigation).off('shown shown.bs.tab', innerTabShown);

		// reset elements based on current state of the DOM
		$navigation = element.find('ul:first', element);
		$activeTab = $navigation.find(baseItemSelector + '.active', element);

		// re-add handlers
		$('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);
		$('a[data-toggle="tab"]', $navigation).on('shown shown.bs.tab', innerTabShown);

		obj.fixNavigationButtons();
	};

	$navigation = element.find('ul:first', element);
	$activeTab = $navigation.find(baseItemSelector + '.active', element);

	if(!$navigation.hasClass($settings.tabClass)) {
		$navigation.addClass($settings.tabClass);
	}

	// Load onInit
	if($settings.onInit && typeof $settings.onInit === 'function'){
		$settings.onInit($activeTab, $navigation, 0);
	}

	// Load onShow
	if($settings.onShow && typeof $settings.onShow === 'function'){
		$settings.onShow($activeTab, $navigation, obj.nextIndex());
	}

	$('a[data-toggle="tab"]', $navigation).on('click', innerTabClick);

	// attach to both shown and shown.bs.tab to support Bootstrap versions 2.3.2 and 3.0.0
	$('a[data-toggle="tab"]', $navigation).on('shown shown.bs.tab', innerTabShown);
};
$.fn.bootstrapWizard = function(options) {
	//expose methods
	if (typeof options == 'string') {
		var args = Array.prototype.slice.call(arguments, 1)
		if(args.length === 1) {
			args.toString();
		}
		return this.data('bootstrapWizard')[options](args);
	}
	return this.each(function(index){
		var element = $(this);
		// Return early if this element already has a plugin instance
		if (element.data('bootstrapWizard')) return;
		// pass options to plugin constructor
		var wizard = new bootstrapWizardCreate(element, options);
		// Store plugin object in this element's data
		element.data('bootstrapWizard', wizard);
		// and then trigger initial change
		wizard.fixNavigationButtons();
	});
};

// expose options
$.fn.bootstrapWizard.defaults = {
	tabClass:         'nav nav-pills',
	nextSelector:     '.wizard li.next',
	previousSelector: '.wizard li.previous',
	firstSelector:    '.wizard li.first',
	lastSelector:     '.wizard li.last',
	onShow:           null,
	onInit:           null,
	onNext:           null,
	onPrevious:       null,
	onLast:           null,
	onFirst:          null,
	onTabChange:      null,
	onTabClick:       null,
	onTabShow:        null
};

})(jQuery);


//  Material Design Core Functions

 !function(t){function o(t){return"undefined"==typeof t.which?!0:"number"==typeof t.which&&t.which>0?!t.ctrlKey&&!t.metaKey&&!t.altKey&&8!=t.which&&9!=t.which&&13!=t.which&&16!=t.which&&17!=t.which&&20!=t.which&&27!=t.which:!1}function i(o){var i=t(o);i.prop("disabled")||i.closest(".form-group").addClass("is-focused")}function n(o){o.closest("label").hover(function(){var o=t(this).find("input");o.prop("disabled")||i(o)},function(){e(t(this).find("input"))})}function e(o){t(o).closest(".form-group").removeClass("is-focused")}t.expr[":"].notmdproc=function(o){return t(o).data("mdproc")?!1:!0},t.material={options:{validate:!0,input:!0,ripples:!0,checkbox:!0,togglebutton:!0,radio:!0,arrive:!0,autofill:!1,withRipples:[".btn:not(.btn-link)",".card-image",".navbar a:not(.withoutripple)",".footer a:not(.withoutripple)",".dropdown-menu a",".nav-tabs a:not(.withoutripple)",".withripple",".pagination li:not(.active):not(.disabled) a:not(.withoutripple)"].join(","),inputElements:"input.form-control, textarea.form-control, select.form-control",checkboxElements:".checkbox > label > input[type=checkbox]",togglebuttonElements:".togglebutton > label > input[type=checkbox]",radioElements:".radio > label > input[type=radio]"},checkbox:function(o){var i=t(o?o:this.options.checkboxElements).filter(":notmdproc").data("mdproc",!0).after("<span class='checkbox-material'><span class='check'></span></span>");n(i)},togglebutton:function(o){var i=t(o?o:this.options.togglebuttonElements).filter(":notmdproc").data("mdproc",!0).after("<span class='toggle'></span>");n(i)},radio:function(o){var i=t(o?o:this.options.radioElements).filter(":notmdproc").data("mdproc",!0).after("<span class='circle'></span><span class='check'></span>");n(i)},input:function(o){t(o?o:this.options.inputElements).filter(":notmdproc").data("mdproc",!0).each(function(){var o=t(this),i=o.closest(".form-group");0===i.length&&(o.wrap("<div class='form-group'></div>"),i=o.closest(".form-group")),o.attr("data-hint")&&(o.after("<p class='help-block'>"+o.attr("data-hint")+"</p>"),o.removeAttr("data-hint"));var n={"input-lg":"form-group-lg","input-sm":"form-group-sm"};if(t.each(n,function(t,n){o.hasClass(t)&&(o.removeClass(t),i.addClass(n))}),o.hasClass("floating-label")){var e=o.attr("placeholder");o.attr("placeholder",null).removeClass("floating-label");var a=o.attr("id"),r="";a&&(r="for='"+a+"'"),i.addClass("label-floating"),o.after("<label "+r+"class='control-label'>"+e+"</label>")}(null===o.val()||"undefined"==o.val()||""===o.val())&&i.addClass("is-empty"),i.append("<span class='material-input'></span>"),i.find("input[type=file]").length>0&&i.addClass("is-fileinput")})},attachInputEventHandlers:function(){var n=this.options.validate;t(document).on("change",".checkbox input[type=checkbox]",function(){t(this).blur()}).on("keydown paste",".form-control",function(i){o(i)&&t(this).closest(".form-group").removeClass("is-empty")}).on("keyup change",".form-control",function(){var o=t(this),i=o.closest(".form-group"),e="undefined"==typeof o[0].checkValidity||o[0].checkValidity();""===o.val()?i.addClass("is-empty"):i.removeClass("is-empty"),n&&(e?i.removeClass("has-error"):i.addClass("has-error"))}).on("focus",".form-control, .form-group.is-fileinput",function(){i(this)}).on("blur",".form-control, .form-group.is-fileinput",function(){e(this)}).on("change",".form-group input",function(){var o=t(this);if("file"!=o.attr("type")){var i=o.closest(".form-group"),n=o.val();n?i.removeClass("is-empty"):i.addClass("is-empty")}}).on("change",".form-group.is-fileinput input[type='file']",function(){var o=t(this),i=o.closest(".form-group"),n="";t.each(this.files,function(t,o){n+=o.name+", "}),n=n.substring(0,n.length-2),n?i.removeClass("is-empty"):i.addClass("is-empty"),i.find("input.form-control[readonly]").val(n)})},ripples:function(o){t(o?o:this.options.withRipples).ripples()},autofill:function(){var o=setInterval(function(){t("input[type!=checkbox]").each(function(){var o=t(this);o.val()&&o.val()!==o.attr("value")&&o.trigger("change")})},100);setTimeout(function(){clearInterval(o)},1e4)},attachAutofillEventHandlers:function(){var o;t(document).on("focus","input",function(){var i=t(this).parents("form").find("input").not("[type=file]");o=setInterval(function(){i.each(function(){var o=t(this);o.val()!==o.attr("value")&&o.trigger("change")})},100)}).on("blur",".form-group input",function(){clearInterval(o)})},init:function(o){this.options=t.extend({},this.options,o);var i=t(document);t.fn.ripples&&this.options.ripples&&this.ripples(),this.options.input&&(this.input(),this.attachInputEventHandlers()),this.options.checkbox&&this.checkbox(),this.options.togglebutton&&this.togglebutton(),this.options.radio&&this.radio(),this.options.autofill&&(this.autofill(),this.attachAutofillEventHandlers()),document.arrive&&this.options.arrive&&(t.fn.ripples&&this.options.ripples&&i.arrive(this.options.withRipples,function(){t.material.ripples(t(this))}),this.options.input&&i.arrive(this.options.inputElements,function(){t.material.input(t(this))}),this.options.checkbox&&i.arrive(this.options.checkboxElements,function(){t.material.checkbox(t(this))}),this.options.radio&&i.arrive(this.options.radioElements,function(){t.material.radio(t(this))}),this.options.togglebutton&&i.arrive(this.options.togglebuttonElements,function(){t.material.togglebutton(t(this))}))}}}(jQuery),function(t,o,i,n){"use strict";function e(o,i){r=this,this.element=t(o),this.options=t.extend({},s,i),this._defaults=s,this._name=a,this.init()}var a="ripples",r=null,s={};e.prototype.init=function(){var i=this.element;i.on("mousedown touchstart",function(n){if(!r.isTouch()||"mousedown"!==n.type){i.find(".ripple-container").length||i.append('<div class="ripple-container"></div>');var e=i.children(".ripple-container"),a=r.getRelY(e,n),s=r.getRelX(e,n);if(a||s){var l=r.getRipplesColor(i),p=t("<div></div>");p.addClass("ripple").css({left:s,top:a,"background-color":l}),e.append(p),function(){return o.getComputedStyle(p[0]).opacity}(),r.rippleOn(i,p),setTimeout(function(){r.rippleEnd(p)},500),i.on("mouseup mouseleave touchend",function(){p.data("mousedown","off"),"off"===p.data("animating")&&r.rippleOut(p)})}}})},e.prototype.getNewSize=function(t,o){return Math.max(t.outerWidth(),t.outerHeight())/o.outerWidth()*2.5},e.prototype.getRelX=function(t,o){var i=t.offset();return r.isTouch()?(o=o.originalEvent,1===o.touches.length?o.touches[0].pageX-i.left:!1):o.pageX-i.left},e.prototype.getRelY=function(t,o){var i=t.offset();return r.isTouch()?(o=o.originalEvent,1===o.touches.length?o.touches[0].pageY-i.top:!1):o.pageY-i.top},e.prototype.getRipplesColor=function(t){var i=t.data("ripple-color")?t.data("ripple-color"):o.getComputedStyle(t[0]).color;return i},e.prototype.hasTransitionSupport=function(){var t=i.body||i.documentElement,o=t.style,e=o.transition!==n||o.WebkitTransition!==n||o.MozTransition!==n||o.MsTransition!==n||o.OTransition!==n;return e},e.prototype.isTouch=function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)},e.prototype.rippleEnd=function(t){t.data("animating","off"),"off"===t.data("mousedown")&&r.rippleOut(t)},e.prototype.rippleOut=function(t){t.off(),r.hasTransitionSupport()?t.addClass("ripple-out"):t.animate({opacity:0},100,function(){t.trigger("transitionend")}),t.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){t.remove()})},e.prototype.rippleOn=function(t,o){var i=r.getNewSize(t,o);r.hasTransitionSupport()?o.css({"-ms-transform":"scale("+i+")","-moz-transform":"scale("+i+")","-webkit-transform":"scale("+i+")",transform:"scale("+i+")"}).addClass("ripple-on").data("animating","on").data("mousedown","on"):o.animate({width:2*Math.max(t.outerWidth(),t.outerHeight()),height:2*Math.max(t.outerWidth(),t.outerHeight()),"margin-left":-1*Math.max(t.outerWidth(),t.outerHeight()),"margin-top":-1*Math.max(t.outerWidth(),t.outerHeight()),opacity:.2},500,function(){o.trigger("transitionend")})},t.fn.ripples=function(o){return this.each(function(){t.data(this,"plugin_"+a)||t.data(this,"plugin_"+a,new e(this,o))})}}(jQuery,window,document);






/*! =========================================================
 *
 * Material Bootstrap Wizard - V1.0.1
 *
 * =========================================================
 *
 * Copyright 2016 Creative Tim (http://www.creative-tim.com/product/material-bootstrap-wizard)
 *
 *
 *                       _oo0oo_
 *                      o8888888o
 *                      88" . "88
 *                      (| -_- |)
 *                      0\  =  /0
 *                    ___/`---'\___
 *                  .' \|     |// '.
 *                 / \|||  :  |||// \
 *                / _||||| -:- |||||- \
 *               |   | \\  -  /// |   |
 *               | \_|  ''\---/''  |_/ |
 *               \  .-\__  '-'  ___/-. /
 *             ___'. .'  /--.--\  `. .'___
 *          ."" '<  `.___\_<|>_/___.' >' "".
 *         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *         \  \ `_.   \_ __\ /__ _/   .-` /  /
 *     =====`-.____`.___ \_____/___.-`___.-'=====
 *                       `=---='
 *
 *     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 *               Buddha Bless:  "No Bugs"
 *
 * ========================================================= */

// Material Bootstrap Wizard Functions

searchVisible = 0;
transparent = true;

$(document).ready(function(){

    $.material.init();

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
		  rules: {
		    firstname: {
		      required: true,
		      minlength: 3
		    },
		    lastname: {
		      required: true,
		      minlength: 3
		    },
		    email: {
		      required: true,
		      minlength: 3,
		    }
        },

        errorPlacement: function(error, element) {
            $(element).parent('div').addClass('has-error');
         }
	});

    // Wizard Initialization
  	$('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
        	var $valid = $('.wizard-card form').valid();
        	if(!$valid) {
        		$validator.focusInvalid();
        		return false;
        	}
        },

        onInit : function(tab, navigation, index){

          //check number of tabs and fill the entire row
          var $total = navigation.find('li').length;
          $width = 100/$total;
          var $wizard = navigation.closest('.wizard-card');

          $display_width = $(document).width();

          if($display_width < 600 && $total > 3){
              $width = 50;
          }

           navigation.find('li').css('width',$width + '%');
           $first_li = navigation.find('li:first-child a').html();
           $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
           $('.wizard-card .wizard-navigation').append($moving_div);
           refreshAnimation($wizard, index);
           $('.moving-tab').css('transition','transform 0s');
       },

        onTabClick : function(tab, navigation, index){
            var $valid = $('.wizard-card form').valid();

            if(!$valid){
                return false;
            } else{
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        }
  	});


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });

    $('.set-full-height').css('height', 'auto');

});



 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function(){
    $('.wizard-card').each(function(){
        $wizard = $(this);
        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s'
        });
    });
});

function refreshAnimation($wizard, index){
    total_steps = $wizard.find('li').length;
    move_distance = $wizard.width() / total_steps;
    step_width = move_distance;
    move_distance *= index;

    $current = index + 1;

    if($current == 1){
        move_distance -= 8;
    } else if($current == total_steps){
        move_distance += 8;
    }

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform':'translate3d(' + move_distance + 'px, 0, 0)',
        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

    });
}

materialDesign = {

    checkScrollForTransparentNavbar: debounce(function() {
                if($(document).scrollTop() > 260 ) {
                    if(transparent) {
                        transparent = false;
                        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                    }
                } else {
                    if( !transparent ) {
                        transparent = true;
                        $('.navbar-color-on-scroll').addClass('navbar-transparent');
                    }
                }
        }, 17)

}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};







/*! jQuery Validation Plugin - v1.14.0 - 6/30/2015
 * https://jqueryvalidation.org/
 * Copyright (c) 2015 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){a.extend(a.fn,{validate:function(b){if(!this.length)return void(b&&b.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing."));var c=a.data(this[0],"validator");return c?c:(this.attr("novalidate","novalidate"),c=new a.validator(b,this[0]),a.data(this[0],"validator",c),c.settings.onsubmit&&(this.on("click.validate",":submit",function(b){c.settings.submitHandler&&(c.submitButton=b.target),a(this).hasClass("cancel")&&(c.cancelSubmit=!0),void 0!==a(this).attr("formnovalidate")&&(c.cancelSubmit=!0)}),this.on("submit.validate",function(b){function d(){var d,e;return c.settings.submitHandler?(c.submitButton&&(d=a("<input type='hidden'/>").attr("name",c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)),e=c.settings.submitHandler.call(c,c.currentForm,b),c.submitButton&&d.remove(),void 0!==e?e:!1):!0}return c.settings.debug&&b.preventDefault(),c.cancelSubmit?(c.cancelSubmit=!1,d()):c.form()?c.pendingRequest?(c.formSubmitted=!0,!1):d():(c.focusInvalid(),!1)})),c)},valid:function(){var b,c,d;return a(this[0]).is("form")?b=this.validate().form():(d=[],b=!0,c=a(this[0].form).validate(),this.each(function(){b=c.element(this)&&b,d=d.concat(c.errorList)}),c.errorList=d),b},rules:function(b,c){var d,e,f,g,h,i,j=this[0];if(b)switch(d=a.data(j.form,"validator").settings,e=d.rules,f=a.validator.staticRules(j),b){case"add":a.extend(f,a.validator.normalizeRule(c)),delete f.messages,e[j.name]=f,c.messages&&(d.messages[j.name]=a.extend(d.messages[j.name],c.messages));break;case"remove":return c?(i={},a.each(c.split(/\s/),function(b,c){i[c]=f[c],delete f[c],"required"===c&&a(j).removeAttr("aria-required")}),i):(delete e[j.name],f)}return g=a.validator.normalizeRules(a.extend({},a.validator.classRules(j),a.validator.attributeRules(j),a.validator.dataRules(j),a.validator.staticRules(j)),j),g.required&&(h=g.required,delete g.required,g=a.extend({required:h},g),a(j).attr("aria-required","true")),g.remote&&(h=g.remote,delete g.remote,g=a.extend(g,{remote:h})),g}}),a.extend(a.expr[":"],{blank:function(b){return!a.trim(""+a(b).val())},filled:function(b){return!!a.trim(""+a(b).val())},unchecked:function(b){return!a(b).prop("checked")}}),a.validator=function(b,c){this.settings=a.extend(!0,{},a.validator.defaults,b),this.currentForm=c,this.init()},a.validator.format=function(b,c){return 1===arguments.length?function(){var c=a.makeArray(arguments);return c.unshift(b),a.validator.format.apply(this,c)}:(arguments.length>2&&c.constructor!==Array&&(c=a.makeArray(arguments).slice(1)),c.constructor!==Array&&(c=[c]),a.each(c,function(a,c){b=b.replace(new RegExp("\\{"+a+"\\}","g"),function(){return c})}),b)},a.extend(a.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",validClass:"valid",errorElement:"label",focusCleanup:!1,focusInvalid:!0,errorContainer:a([]),errorLabelContainer:a([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(a){this.lastActive=a,this.settings.focusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass),this.hideThese(this.errorsFor(a)))},onfocusout:function(a){this.checkable(a)||!(a.name in this.submitted)&&this.optional(a)||this.element(a)},onkeyup:function(b,c){var d=[16,17,18,20,35,36,37,38,39,40,45,144,225];9===c.which&&""===this.elementValue(b)||-1!==a.inArray(c.keyCode,d)||(b.name in this.submitted||b===this.lastElement)&&this.element(b)},onclick:function(a){a.name in this.submitted?this.element(a):a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).addClass(c).removeClass(d):a(b).addClass(c).removeClass(d)},unhighlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).removeClass(c).addClass(d):a(b).removeClass(c).addClass(d)}},setDefaults:function(b){a.extend(a.validator.defaults,b)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date ( ISO ).",number:"Please enter a valid number.",digits:"Please enter only digits.",creditcard:"Please enter a valid credit card number.",equalTo:"Please enter the same value again.",maxlength:a.validator.format("Please enter no more than {0} characters."),minlength:a.validator.format("Please enter at least {0} characters."),rangelength:a.validator.format("Please enter a value between {0} and {1} characters long."),range:a.validator.format("Please enter a value between {0} and {1}."),max:a.validator.format("Please enter a value less than or equal to {0}."),min:a.validator.format("Please enter a value greater than or equal to {0}.")},autoCreateRanges:!1,prototype:{init:function(){function b(b){var c=a.data(this.form,"validator"),d="on"+b.type.replace(/^validate/,""),e=c.settings;e[d]&&!a(this).is(e.ignore)&&e[d].call(c,this,b)}this.labelContainer=a(this.settings.errorLabelContainer),this.errorContext=this.labelContainer.length&&this.labelContainer||a(this.currentForm),this.containers=a(this.settings.errorContainer).add(this.settings.errorLabelContainer),this.submitted={},this.valueCache={},this.pendingRequest=0,this.pending={},this.invalid={},this.reset();var c,d=this.groups={};a.each(this.settings.groups,function(b,c){"string"==typeof c&&(c=c.split(/\s/)),a.each(c,function(a,c){d[c]=b})}),c=this.settings.rules,a.each(c,function(b,d){c[b]=a.validator.normalizeRule(d)}),a(this.currentForm).on("focusin.validate focusout.validate keyup.validate",":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']",b).on("click.validate","select, option, [type='radio'], [type='checkbox']",b),this.settings.invalidHandler&&a(this.currentForm).on("invalid-form.validate",this.settings.invalidHandler),a(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required","true")},form:function(){return this.checkForm(),a.extend(this.submitted,this.errorMap),this.invalid=a.extend({},this.errorMap),this.valid()||a(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(b){var c=this.clean(b),d=this.validationTargetFor(c),e=!0;return this.lastElement=d,void 0===d?delete this.invalid[c.name]:(this.prepareElement(d),this.currentElements=a(d),e=this.check(d)!==!1,e?delete this.invalid[d.name]:this.invalid[d.name]=!0),a(b).attr("aria-invalid",!e),this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),e},showErrors:function(b){if(b){a.extend(this.errorMap,b),this.errorList=[];for(var c in b)this.errorList.push({message:b[c],element:this.findByName(c)[0]});this.successList=a.grep(this.successList,function(a){return!(a.name in b)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){a.fn.resetForm&&a(this.currentForm).resetForm(),this.submitted={},this.lastElement=null,this.prepareForm(),this.hideErrors();var b,c=this.elements().removeData("previousValue").removeAttr("aria-invalid");if(this.settings.unhighlight)for(b=0;c[b];b++)this.settings.unhighlight.call(this,c[b],this.settings.errorClass,"");else c.removeClass(this.settings.errorClass)},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b,c=0;for(b in a)c++;return c},hideErrors:function(){this.hideThese(this.toHide)},hideThese:function(a){a.not(this.containers).text(""),this.addWrapper(a).hide()},valid:function(){return 0===this.size()},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{a(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(b){}},findLastActive:function(){var b=this.lastActive;return b&&1===a.grep(this.errorList,function(a){return a.element.name===b.name}).length&&b},elements:function(){var b=this,c={};return a(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function(){return!this.name&&b.settings.debug&&window.console&&console.error("%o has no name assigned",this),this.name in c||!b.objectLength(a(this).rules())?!1:(c[this.name]=!0,!0)})},clean:function(b){return a(b)[0]},errors:function(){var b=this.settings.errorClass.split(" ").join(".");return a(this.settings.errorElement+"."+b,this.errorContext)},reset:function(){this.successList=[],this.errorList=[],this.errorMap={},this.toShow=a([]),this.toHide=a([]),this.currentElements=a([])},prepareForm:function(){this.reset(),this.toHide=this.errors().add(this.containers)},prepareElement:function(a){this.reset(),this.toHide=this.errorsFor(a)},elementValue:function(b){var c,d=a(b),e=b.type;return"radio"===e||"checkbox"===e?this.findByName(b.name).filter(":checked").val():"number"===e&&"undefined"!=typeof b.validity?b.validity.badInput?!1:d.val():(c=d.val(),"string"==typeof c?c.replace(/\r/g,""):c)},check:function(b){b=this.validationTargetFor(this.clean(b));var c,d,e,f=a(b).rules(),g=a.map(f,function(a,b){return b}).length,h=!1,i=this.elementValue(b);for(d in f){e={method:d,parameters:f[d]};try{if(c=a.validator.methods[d].call(this,i,b,e.parameters),"dependency-mismatch"===c&&1===g){h=!0;continue}if(h=!1,"pending"===c)return void(this.toHide=this.toHide.not(this.errorsFor(b)));if(!c)return this.formatAndAdd(b,e),!1}catch(j){throw this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+b.id+", check the '"+e.method+"' method.",j),j instanceof TypeError&&(j.message+=".  Exception occurred when checking element "+b.id+", check the '"+e.method+"' method."),j}}if(!h)return this.objectLength(f)&&this.successList.push(b),!0},customDataMessage:function(b,c){return a(b).data("msg"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase())||a(b).data("msg")},customMessage:function(a,b){var c=this.settings.messages[a];return c&&(c.constructor===String?c:c[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(void 0!==arguments[a])return arguments[a];return void 0},defaultMessage:function(b,c){return this.findDefined(this.customMessage(b.name,c),this.customDataMessage(b,c),!this.settings.ignoreTitle&&b.title||void 0,a.validator.messages[c],"<strong>Warning: No message defined for "+b.name+"</strong>")},formatAndAdd:function(b,c){var d=this.defaultMessage(b,c.method),e=/\$?\{(\d+)\}/g;"function"==typeof d?d=d.call(this,c.parameters,b):e.test(d)&&(d=a.validator.format(d.replace(e,"{$1}"),c.parameters)),this.errorList.push({message:d,element:b,method:c.method}),this.errorMap[b.name]=d,this.submitted[b.name]=d},addWrapper:function(a){return this.settings.wrapper&&(a=a.add(a.parent(this.settings.wrapper))),a},defaultShowErrors:function(){var a,b,c;for(a=0;this.errorList[a];a++)c=this.errorList[a],this.settings.highlight&&this.settings.highlight.call(this,c.element,this.settings.errorClass,this.settings.validClass),this.showLabel(c.element,c.message);if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);if(this.settings.unhighlight)for(a=0,b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow),this.hideErrors(),this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return a(this.errorList).map(function(){return this.element})},showLabel:function(b,c){var d,e,f,g=this.errorsFor(b),h=this.idOrName(b),i=a(b).attr("aria-describedby");g.length?(g.removeClass(this.settings.validClass).addClass(this.settings.errorClass),g.html(c)):(g=a("<"+this.settings.errorElement+">").attr("id",h+"-error").addClass(this.settings.errorClass).html(c||""),d=g,this.settings.wrapper&&(d=g.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.length?this.labelContainer.append(d):this.settings.errorPlacement?this.settings.errorPlacement(d,a(b)):d.insertAfter(b),g.is("label")?g.attr("for",h):0===g.parents("label[for='"+h+"']").length&&(f=g.attr("id").replace(/(:|\.|\[|\]|\$)/g,"\\$1"),i?i.match(new RegExp("\\b"+f+"\\b"))||(i+=" "+f):i=f,a(b).attr("aria-describedby",i),e=this.groups[b.name],e&&a.each(this.groups,function(b,c){c===e&&a("[name='"+b+"']",this.currentForm).attr("aria-describedby",g.attr("id"))}))),!c&&this.settings.success&&(g.text(""),"string"==typeof this.settings.success?g.addClass(this.settings.success):this.settings.success(g,b)),this.toShow=this.toShow.add(g)},errorsFor:function(b){var c=this.idOrName(b),d=a(b).attr("aria-describedby"),e="label[for='"+c+"'], label[for='"+c+"'] *";return d&&(e=e+", #"+d.replace(/\s+/g,", #")),this.errors().filter(e)},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(b){return this.checkable(b)&&(b=this.findByName(b.name)),a(b).not(this.settings.ignore)[0]},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(b){return a(this.currentForm).find("[name='"+b+"']")},getLength:function(b,c){switch(c.nodeName.toLowerCase()){case"select":return a("option:selected",c).length;case"input":if(this.checkable(c))return this.findByName(c.name).filter(":checked").length}return b.length},depend:function(a,b){return this.dependTypes[typeof a]?this.dependTypes[typeof a](a,b):!0},dependTypes:{"boolean":function(a){return a},string:function(b,c){return!!a(b,c.form).length},"function":function(a,b){return a(b)}},optional:function(b){var c=this.elementValue(b);return!a.validator.methods.required.call(this,c,b)&&"dependency-mismatch"},startRequest:function(a){this.pending[a.name]||(this.pendingRequest++,this.pending[a.name]=!0)},stopRequest:function(b,c){this.pendingRequest--,this.pendingRequest<0&&(this.pendingRequest=0),delete this.pending[b.name],c&&0===this.pendingRequest&&this.formSubmitted&&this.form()?(a(this.currentForm).submit(),this.formSubmitted=!1):!c&&0===this.pendingRequest&&this.formSubmitted&&(a(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)},previousValue:function(b){return a.data(b,"previousValue")||a.data(b,"previousValue",{old:null,valid:!0,message:this.defaultMessage(b,"remote")})},destroy:function(){this.resetForm(),a(this.currentForm).off(".validate").removeData("validator")}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(b,c){b.constructor===String?this.classRuleSettings[b]=c:a.extend(this.classRuleSettings,b)},classRules:function(b){var c={},d=a(b).attr("class");return d&&a.each(d.split(" "),function(){this in a.validator.classRuleSettings&&a.extend(c,a.validator.classRuleSettings[this])}),c},normalizeAttributeRule:function(a,b,c,d){/min|max/.test(c)&&(null===b||/number|range|text/.test(b))&&(d=Number(d),isNaN(d)&&(d=void 0)),d||0===d?a[c]=d:b===c&&"range"!==b&&(a[c]=!0)},attributeRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)"required"===c?(d=b.getAttribute(c),""===d&&(d=!0),d=!!d):d=f.attr(c),this.normalizeAttributeRule(e,g,c,d);return e.maxlength&&/-1|2147483647|524288/.test(e.maxlength)&&delete e.maxlength,e},dataRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)d=f.data("rule"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase()),this.normalizeAttributeRule(e,g,c,d);return e},staticRules:function(b){var c={},d=a.data(b.form,"validator");return d.settings.rules&&(c=a.validator.normalizeRule(d.settings.rules[b.name])||{}),c},normalizeRules:function(b,c){return a.each(b,function(d,e){if(e===!1)return void delete b[d];if(e.param||e.depends){var f=!0;switch(typeof e.depends){case"string":f=!!a(e.depends,c.form).length;break;case"function":f=e.depends.call(c,c)}f?b[d]=void 0!==e.param?e.param:!0:delete b[d]}}),a.each(b,function(d,e){b[d]=a.isFunction(e)?e(c):e}),a.each(["minlength","maxlength"],function(){b[this]&&(b[this]=Number(b[this]))}),a.each(["rangelength","range"],function(){var c;b[this]&&(a.isArray(b[this])?b[this]=[Number(b[this][0]),Number(b[this][1])]:"string"==typeof b[this]&&(c=b[this].replace(/[\[\]]/g,"").split(/[\s,]+/),b[this]=[Number(c[0]),Number(c[1])]))}),a.validator.autoCreateRanges&&(null!=b.min&&null!=b.max&&(b.range=[b.min,b.max],delete b.min,delete b.max),null!=b.minlength&&null!=b.maxlength&&(b.rangelength=[b.minlength,b.maxlength],delete b.minlength,delete b.maxlength)),b},normalizeRule:function(b){if("string"==typeof b){var c={};a.each(b.split(/\s/),function(){c[this]=!0}),b=c}return b},addMethod:function(b,c,d){a.validator.methods[b]=c,a.validator.messages[b]=void 0!==d?d:a.validator.messages[b],c.length<3&&a.validator.addClassRules(b,a.validator.normalizeRule(b))},methods:{required:function(b,c,d){if(!this.depend(d,c))return"dependency-mismatch";if("select"===c.nodeName.toLowerCase()){var e=a(c).val();return e&&e.length>0}return this.checkable(c)?this.getLength(b,c)>0:b.length>0},email:function(a,b){return this.optional(b)||/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)},url:function(a,b){return this.optional(b)||/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(a)},date:function(a,b){return this.optional(b)||!/Invalid|NaN/.test(new Date(a).toString())},dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)},number:function(a,b){return this.optional(b)||/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},creditcard:function(a,b){if(this.optional(b))return"dependency-mismatch";if(/[^0-9 \-]+/.test(a))return!1;var c,d,e=0,f=0,g=!1;if(a=a.replace(/\D/g,""),a.length<13||a.length>19)return!1;for(c=a.length-1;c>=0;c--)d=a.charAt(c),f=parseInt(d,10),g&&(f*=2)>9&&(f-=9),e+=f,g=!g;return e%10===0},minlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d},maxlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||d>=e},rangelength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d[0]&&e<=d[1]},min:function(a,b,c){return this.optional(b)||a>=c},max:function(a,b,c){return this.optional(b)||c>=a},range:function(a,b,c){return this.optional(b)||a>=c[0]&&a<=c[1]},equalTo:function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.off(".validate-equalTo").on("blur.validate-equalTo",function(){a(c).valid()}),b===e.val()},remote:function(b,c,d){if(this.optional(c))return"dependency-mismatch";var e,f,g=this.previousValue(c);return this.settings.messages[c.name]||(this.settings.messages[c.name]={}),g.originalMessage=this.settings.messages[c.name].remote,this.settings.messages[c.name].remote=g.message,d="string"==typeof d&&{url:d}||d,g.old===b?g.valid:(g.old=b,e=this,this.startRequest(c),f={},f[c.name]=b,a.ajax(a.extend(!0,{mode:"abort",port:"validate"+c.name,dataType:"json",data:f,context:e.currentForm,success:function(d){var f,h,i,j=d===!0||"true"===d;e.settings.messages[c.name].remote=g.originalMessage,j?(i=e.formSubmitted,e.prepareElement(c),e.formSubmitted=i,e.successList.push(c),delete e.invalid[c.name],e.showErrors()):(f={},h=d||e.defaultMessage(c,"remote"),f[c.name]=g.message=a.isFunction(h)?h(b):h,e.invalid[c.name]=!0,e.showErrors(f)),g.valid=j,e.stopRequest(c,j)}},d)),"pending")}}});var b,c={};a.ajaxPrefilter?a.ajaxPrefilter(function(a,b,d){var e=a.port;"abort"===a.mode&&(c[e]&&c[e].abort(),c[e]=d)}):(b=a.ajax,a.ajax=function(d){var e=("mode"in d?d:a.ajaxSettings).mode,f=("port"in d?d:a.ajaxSettings).port;return"abort"===e?(c[f]&&c[f].abort(),c[f]=b.apply(this,arguments),c[f]):b.apply(this,arguments)})});


    </script>
@endpush
