/**
 * Sort
 * @providesModule Sort
 */
"use strict";
var Invalid_argument = require('Invalid_argument.js');
var runtime = require('runtime.js');

let joo_global_object = global;


var runtime = joo_global_object.jsoo_runtime;

function call2(f, a0, a1) {
  return f.length === 2 ? f(a0, a1) : runtime["caml_call_gen"](f, [a0,a1]);
}

var global_data = runtime["caml_get_global_data"]();
var cst_Sort_array = runtime["caml_new_string"]("Sort.array");
var Invalid_argument = global_data["Invalid_argument"];

function merge(order, l1, l2) {
  if (l1) {
    var t1 = l1[2];
    var h1 = l1[1];
    if (l2) {
      var t2 = l2[2];
      var h2 = l2[1];
      return call2(order, h1, h2) ?
        [0,h1,merge(order, t1, l2)] :
        [0,h2,merge(order, l1, t2)];
    }
    return l1;
  }
  return l2;
}

function list(order, l) {
  function initlist(param) {
    if (param) {
      var cM = param[2];
      var cN = param[1];
      if (cM) {
        var rest = cM[2];
        var e2 = cM[1];
        var cO = initlist(rest);
        var cP = call2(order, cN, e2) ? [0,cN,[0,e2,0]] : [0,e2,[0,cN,0]];
        return [0,cP,cO];
      }
      return [0,[0,cN,0],0];
    }
    return 0;
  }
  function merge2(x) {
    if (x) {
      var cK = x[2];
      if (cK) {
        var rest = cK[2];
        var l2 = cK[1];
        var l1 = x[1];
        var cL = merge2(rest);
        return [0,merge(order, l1, l2),cL];
      }
    }
    return x;
  }
  function mergeall(llist) {
    var llist__0 = llist;
    for (; ; ) {
      if (llist__0) {
        if (llist__0[2]) {
          var llist__1 = merge2(llist__0);
          var llist__0 = llist__1;
          continue;
        }
        var l = llist__0[1];
        return l;
      }
      return 0;
    }
  }
  return mergeall(initlist(l));
}

function swap(arr, i, j) {
  var tmp = arr[i + 1];
  arr[i + 1] = arr[j + 1];
  arr[j + 1] = tmp;
  return 0;
}

function array(cmp, arr) {
  function qsort(lo, hi) {
    var lo__0 = lo;
    var hi__0 = hi;
    a:
    for (; ; ) {
      var cH = 6 <= (hi__0 - lo__0 | 0) ? 1 : 0;
      if (cH) {
        var mid = (lo__0 + hi__0 | 0) >>> 1 | 0;
        if (call2(cmp, arr[mid + 1], arr[lo__0 + 1])) {swap(arr, mid, lo__0);}
        if (call2(cmp, arr[hi__0 + 1], arr[mid + 1])) {
          swap(arr, mid, hi__0);
          if (call2(cmp, arr[mid + 1], arr[lo__0 + 1])) {swap(arr, mid, lo__0);}
        }
        var pivot = arr[mid + 1];
        var i = [0,lo__0 + 1 | 0];
        var j = [0,hi__0 + -1 | 0];
        var cI = 1 - call2(cmp, pivot, arr[hi__0 + 1]);
        var cJ = cI ? cI : 1 - call2(cmp, arr[lo__0 + 1], pivot);
        if (cJ) {
          throw runtime["caml_wrap_thrown_exception"]([0,Invalid_argument,cst_Sort_array]
                );
        }
        b:
        for (; ; ) {
          if (i[1] < j[1]) {
            for (; ; ) {
              if (call2(cmp, pivot, arr[i[1] + 1])) {
                for (; ; ) {
                  if (call2(cmp, arr[j[1] + 1], pivot)) {
                    if (i[1] < j[1]) {swap(arr, i[1], j[1]);}
                    i[1] += 1;
                    j[1] += -1;
                    continue b;
                  }
                  j[1] += -1;
                  continue;
                }
              }
              i[1] += 1;
              continue;
            }
          }
          if ((j[1] - lo__0 | 0) <= (hi__0 - i[1] | 0)) {
            qsort(lo__0, j[1]);
            var lo__1 = i[1];
            var lo__0 = lo__1;
            continue a;
          }
          qsort(i[1], hi__0);
          var hi__1 = j[1];
          var hi__0 = hi__1;
          continue a;
        }
      }
      return cH;
    }
  }
  qsort(0, arr.length - 1 + -1 | 0);
  var cF = arr.length - 1 + -1 | 0;
  var cE = 1;
  if (! (cF < 1)) {
    var i = cE;
    for (; ; ) {
      var val_i = arr[i + 1];
      if (1 - call2(cmp, arr[(i + -1 | 0) + 1], val_i)) {
        arr[i + 1] = arr[(i + -1 | 0) + 1];
        var j = [0,i + -1 | 0];
        for (; ; ) {
          if (1 <= j[1]) {
            if (! call2(cmp, arr[(j[1] + -1 | 0) + 1], val_i)) {
              arr[j[1] + 1] = arr[(j[1] + -1 | 0) + 1];
              j[1] += -1;
              continue;
            }
          }
          arr[j[1] + 1] = val_i;
          break;
        }
      }
      var cG = i + 1 | 0;
      if (cF !== i) {var i = cG;continue;}
      break;
    }
  }
  return 0;
}

var Sort = [0,list,array,merge];

runtime["caml_register_global"](2, Sort, "Sort");


module.exports = global.jsoo_runtime.caml_get_global_data().Sort;