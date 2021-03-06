/**
 * Gc
 * @providesModule Gc
 */
"use strict";
var Printf = require('Printf.js');
var Sys = require('Sys.js');
var runtime = require('runtime.js');

let joo_global_object = global;


var runtime = joo_global_object.jsoo_runtime;
var caml_ml_string_length = runtime["caml_ml_string_length"];
var string = runtime["caml_new_string"];

function call2(f, a0, a1) {
  return f.length === 2 ? f(a0, a1) : runtime["caml_call_gen"](f, [a0,a1]);
}

function call3(f, a0, a1, a2) {
  return f.length === 3 ?
    f(a0, a1, a2) :
    runtime["caml_call_gen"](f, [a0,a1,a2]);
}

function call4(f, a0, a1, a2, a3) {
  return f.length === 4 ?
    f(a0, a1, a2, a3) :
    runtime["caml_call_gen"](f, [a0,a1,a2,a3]);
}

var global_data = runtime["caml_get_global_data"]();
var Sys = global_data["Sys"];
var Printf = global_data["Printf"];
var ps = [
  0,
  [11,string("minor_collections: "),[4,0,0,0,[12,10,0]]],
  string("minor_collections: %d\n")
];
var pt = [
  0,
  [11,string("major_collections: "),[4,0,0,0,[12,10,0]]],
  string("major_collections: %d\n")
];
var pu = [
  0,
  [11,string("compactions:       "),[4,0,0,0,[12,10,0]]],
  string("compactions:       %d\n")
];
var pv = [0,[12,10,0],string("\n")];
var pw = [0,[8,0,0,[0,0],0],string("%.0f")];
var px = [
  0,
  [11,string("minor_words:    "),[8,0,[1,1],[0,0],[12,10,0]]],
  string("minor_words:    %*.0f\n")
];
var py = [
  0,
  [11,string("promoted_words: "),[8,0,[1,1],[0,0],[12,10,0]]],
  string("promoted_words: %*.0f\n")
];
var pz = [
  0,
  [11,string("major_words:    "),[8,0,[1,1],[0,0],[12,10,0]]],
  string("major_words:    %*.0f\n")
];
var pA = [0,[12,10,0],string("\n")];
var pB = [0,[4,0,0,0,0],string("%d")];
var pC = [
  0,
  [11,string("top_heap_words: "),[4,0,[1,1],0,[12,10,0]]],
  string("top_heap_words: %*d\n")
];
var pD = [
  0,
  [11,string("heap_words:     "),[4,0,[1,1],0,[12,10,0]]],
  string("heap_words:     %*d\n")
];
var pE = [
  0,
  [11,string("live_words:     "),[4,0,[1,1],0,[12,10,0]]],
  string("live_words:     %*d\n")
];
var pF = [
  0,
  [11,string("free_words:     "),[4,0,[1,1],0,[12,10,0]]],
  string("free_words:     %*d\n")
];
var pG = [
  0,
  [11,string("largest_free:   "),[4,0,[1,1],0,[12,10,0]]],
  string("largest_free:   %*d\n")
];
var pH = [
  0,
  [11,string("fragments:      "),[4,0,[1,1],0,[12,10,0]]],
  string("fragments:      %*d\n")
];
var pI = [0,[12,10,0],string("\n")];
var pJ = [
  0,
  [11,string("live_blocks: "),[4,0,0,0,[12,10,0]]],
  string("live_blocks: %d\n")
];
var pK = [
  0,
  [11,string("free_blocks: "),[4,0,0,0,[12,10,0]]],
  string("free_blocks: %d\n")
];
var pL = [
  0,
  [11,string("heap_chunks: "),[4,0,0,0,[12,10,0]]],
  string("heap_chunks: %d\n")
];

function print_stat(c) {
  var st = runtime["caml_gc_stat"](0);
  call3(Printf[1], c, ps, st[4]);
  call3(Printf[1], c, pt, st[5]);
  call3(Printf[1], c, pu, st[14]);
  call2(Printf[1], c, pv);
  var l1 = caml_ml_string_length(call2(Printf[4], pw, st[1]));
  call4(Printf[1], c, px, l1, st[1]);
  call4(Printf[1], c, py, l1, st[2]);
  call4(Printf[1], c, pz, l1, st[3]);
  call2(Printf[1], c, pA);
  var l2 = caml_ml_string_length(call2(Printf[4], pB, st[15]));
  call4(Printf[1], c, pC, l2, st[15]);
  call4(Printf[1], c, pD, l2, st[6]);
  call4(Printf[1], c, pE, l2, st[8]);
  call4(Printf[1], c, pF, l2, st[10]);
  call4(Printf[1], c, pG, l2, st[12]);
  call4(Printf[1], c, pH, l2, st[13]);
  call2(Printf[1], c, pI);
  call3(Printf[1], c, pJ, st[9]);
  call3(Printf[1], c, pK, st[11]);
  return call3(Printf[1], c, pL, st[7]);
}

function allocated_bytes(param) {
  var match = runtime["caml_gc_counters"](0);
  var ma = match[3];
  var pro = match[2];
  var mi = match[1];
  return (mi + ma - pro) * (Sys[10] / 8 | 0);
}

function create_alarm(f) {return [0,1];}

function delete_alarm(a) {a[1] = 0;return 0;}

function pM(pS) {return runtime["caml_final_release"](pS);}

function pN(pR, pQ) {
  return runtime["caml_final_register_called_without_value"](pR, pQ);
}

var Gc = [
  0,
  print_stat,
  allocated_bytes,
  function(pP, pO) {return runtime["caml_final_register"](pP, pO);},
  pN,
  pM,
  create_alarm,
  delete_alarm
];

runtime["caml_register_global"](22, Gc, "Gc");


module.exports = global.jsoo_runtime.caml_get_global_data().Gc;