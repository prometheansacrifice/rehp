<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Js_of_ocaml__XmlHttpRequest.php
 */

namespace Rehack;

final class Js_of_ocaml__XmlHttpRequest {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Js_of_ocaml__Dom = Js_of_ocaml__Dom::get();
    $Js_of_ocaml__Js = Js_of_ocaml__Js::get();
    $Assert_failure = Assert_failure::get();
    Js_of_ocaml__XmlHttpRequest::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Js_of_ocaml__XmlHttpRequest;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $call1 = $runtime["caml_call1"];
    $caml_get_public_method = $runtime["caml_get_public_method"];
    $string = $runtime["caml_new_string"];
    $global_data = $runtime["caml_get_global_data"]();
    $cst_readystatechange = $string("readystatechange");
    $cst_loadstart = $string("loadstart");
    $cst_progress = $string("progress");
    $cst_abort = $string("abort");
    $cst_error = $string("error");
    $cst_load = $string("load");
    $cst_timeout = $string("timeout");
    $cst_loadend = $string("loadend");
    $Js_of_ocaml_Js = $global_data["Js_of_ocaml__Js"];
    $Assert_failure = $global_data["Assert_failure"];
    $Js_of_ocaml_Dom = $global_data["Js_of_ocaml__Dom"];
    $tC = Vector{0, $string("lib/js_of_ocaml/xmlHttpRequest.ml"), 125, 75};
    $readystatechange = $call1($Js_of_ocaml_Dom[14][1], $cst_readystatechange);
    $loadstart = $call1($Js_of_ocaml_Dom[14][1], $cst_loadstart);
    $progress = $call1($Js_of_ocaml_Dom[14][1], $cst_progress);
    $abort = $call1($Js_of_ocaml_Dom[14][1], $cst_abort);
    $error = $call1($Js_of_ocaml_Dom[14][1], $cst_error);
    $load = $call1($Js_of_ocaml_Dom[14][1], $cst_load);
    $timeout = $call1($Js_of_ocaml_Dom[14][1], $cst_timeout);
    $loadend = $call1($Js_of_ocaml_Dom[14][1], $cst_loadend);
    $Event = Vector{
      0,
      $readystatechange,
      $loadstart,
      $progress,
      $abort,
      $error,
      $load,
      $timeout,
      $loadend
    };
    $create = function(dynamic $param) use ($Assert_failure,$Js_of_ocaml_Js,$call1,$caml_get_public_method,$runtime,$tC) {
      $tD = function(dynamic $x) use ($call1,$caml_get_public_method) {
        return $call1($caml_get_public_method($x, -1035517745, 307), $x);
      };
      $tE = $Js_of_ocaml_Js[50][1];
      $xmlHttpRequest = (function(dynamic $t8, dynamic $param) {return $t8->XMLHttpRequest;
       })($tE, $tD);
      $tF = function(dynamic $x) use ($call1,$caml_get_public_method) {
        return $call1($caml_get_public_method($x, -5445583, 308), $x);
      };
      $tG = $Js_of_ocaml_Js[50][1];
      $activeXObject = (function(dynamic $t7, dynamic $param) {return $t7->activeXObject;
       })($tG, $tF);
      try {
        $tQ = 0;
        $tR = (function(dynamic $t6, dynamic $param) {return new $t6();})($xmlHttpRequest, $tQ);
        return $tR;
      }
      catch(\Throwable $tS) {
        try {
          $tN = 0;
          $tO = "Msxml2.XMLHTTP";
          $tP = (function(dynamic $t5, dynamic $t4, dynamic $param) {return new $t5($t4);
           })($activeXObject, $tO, $tN);
          return $tP;
        }
        catch(\Throwable $tT) {
          try {
            $tK = 0;
            $tL = "Msxml3.XMLHTTP";
            $tM = (function(dynamic $t3, dynamic $t2, dynamic $param) {return new $t3($t2);
             })($activeXObject, $tL, $tK);
            return $tM;
          }
          catch(\Throwable $tU) {
            try {
              $tH = 0;
              $tI = "Microsoft.XMLHTTP";
              $tJ = (function(dynamic $t1, dynamic $t0, dynamic $param) {return new $t1($t0);
               })($activeXObject, $tI, $tH);
              return $tJ;
            }
            catch(\Throwable $tV) {
              throw $runtime["caml_wrap_thrown_exception"](Vector{0, $Assert_failure, $tC}) as \Throwable;
            }
          }
        }
      }
    };
    $Js_of_ocaml_XmlHttpRequest = Vector{0, $create, $Event};
    
    $runtime["caml_register_global"](
      17,
      $Js_of_ocaml_XmlHttpRequest,
      "Js_of_ocaml__XmlHttpRequest"
    );

  }
}