/**
 * Js_of_ocaml__EventSource
 * @providesModule Js_of_ocaml__EventSource
 */
"use strict";
var Js_of_ocaml__Dom = require('Js_of_ocaml__Dom.js');
var Js_of_ocaml__Js = require('Js_of_ocaml__Js.js');
var runtime = require('runtime.js');

let joo_global_object = global;


var runtime = joo_global_object.jsoo_runtime;
var caml_get_public_method = runtime["caml_get_public_method"];

function call1(f, a0) {
  return f.length === 1 ? f(a0) : runtime["caml_call_gen"](f, [a0]);
}

var global_data = runtime["caml_get_global_data"]();
var Js_of_ocaml_Js = global_data["Js_of_ocaml__Js"];
var Js_of_ocaml_Dom = global_data["Js_of_ocaml__Dom"];

function withCredentials(b) {
  var init = {};
  function lj(x) {
    return call1(caml_get_public_method(x, -893090218, 199), x);
  }
  var lk = ! ! b;
  (function(t1, t0, param) {t1.withCredentials = t0;return 0;}(init, lk, lj));
  return init;
}

function lf(x) {return call1(caml_get_public_method(x, -809811338, 200), x);}

var lg = Js_of_ocaml_Js[50][1];
var eventSource = function(t2, param) {return t2.EventSource;}(lg, lf);

function lh(x) {return call1(caml_get_public_method(x, -809811338, 201), x);}

var li = Js_of_ocaml_Js[50][1];
var eventSource_options = function(t3, param) {return t3.EventSource;}(li, lh);
var addEventListener = Js_of_ocaml_Dom[15];
var Js_of_ocaml_EventSource = [
  0,
  withCredentials,
  eventSource,
  eventSource_options,
  addEventListener
];

runtime["caml_register_global"](
  5,
  Js_of_ocaml_EventSource,
  "Js_of_ocaml__EventSource"
);


module.exports = global.jsoo_runtime.caml_get_global_data().Js_of_ocaml__EventSource;